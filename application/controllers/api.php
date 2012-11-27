<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'libraries/REST_Controller.php';

$post = json_decode(file_get_contents('php://input'), TRUE);

if (count($_POST) == 0 && count($post) > 0) {
    $_POST = $post;
}

class Api extends REST_Controller {
    public function brand_get(){
        var_dump($this->get('name'));
        $this->load->model('brands_m');
        $brand = $this->brands_m->getBrandIdByName($this->get('name'));
        var_dump($brand);
    }

    public function user_get() {
        if (!$this->get('id')) {
            $this->response(NULL, 400);
        }
        $user = $this->user_model->get( $this->get('id') );
        if ($user) {
            $this->response($user, 200); // 200 being the HTTP response code
        }
        else {
            $this->response(NULL, 404);
        }
    }
    public function user_post() {
        $result = $this->user_model->update( $this->post('id'), array(
                'name' => $this->post('name'),
                'email' => $this->post('email')
            ));
        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        }
        else {
            $this->response(array('status' => 'success'));
        }
    }
    public function users_get() {
        $users = $this->user_model->get_all();
        if ($users) {
            $this->response($users, 200);
        }
        else {
            $this->response(NULL, 404);
        }
    }

    public function categories_get() {
        $this->load->model('categories_m');
        $categories = $this->categories_m->get_all();
        if ($categories) {
            $this->response($categories, 200);
        }
        else {
            $this->response(NULL, 404);
        }
    }

    public function product_post() {
        // TODO: user must be logged in to add a product
        // TODO: user authorizations for adding categories, brands etc.
        
        $this->load->library('form_validation');

        if ($this->form_validation->run('addProduct') == TRUE) {

            $this->load->model(array('categories_m', 'brands_m', 'products_m'));
            $userId = $this->session->userdata('id');
            
            $categoryId = $this->categories_m->addCategoryByName(trim($this->post('category')), $userId);
            $brandId = $this->brands_m->addBrandByName(trim($this->post('brand')), $userId);
            $productId = $this->products_m->addProductByName(trim($this->post('product')), $categoryId, $brandId, $userId);

            $this->response(array('id' => $productId), 200);
        }

        $this->response($this->error('Fields are not valid'), 404);
    }

    public function products_get() {
        $this->load->model('products_m');

        $products = $this->products_m->get_all();

        if ($products) {
            $this->response($products, 200);
        }
        else {
            $this->response(NULL, 404);
        }
    }

    public function search_get() {
        $this->load->model('products_m');
        if ($this->get('query')) {
            $results = $this->products_m->getProductsByQuery($this->get('query'));
            // foreach ($results as $i => &$arr) {
            //     foreach ($arr as $j => &$value) {
            //         if ($j == '_id') {
            //             $arr['id'] = (string)$value;
            //         }
            //     }
            // }
            //$results = array(array('id' => 1, 'name' => 'iPhone', 'category_id' => 1, 'brand_id' => 1),array('id' => 2, 'name' => 'iPhone', 'category_id' => 1, 'brand_id' => 1));
            
            if (is_array($results)) {
                $this->response($results, 200);
            }
            else {
                $data = array(
                    'error' => array(
                        'message' => 'no results for your query',
                        'type' => 'search',
                        'code' => '1'
                    )
                );

                $this->response($data, 404);
            }
        } else {
            $data = array(
                'error' => array(
                    'message' => 'query is not valid',
                    'type' => 'search',
                    'code' => '2'
                )
            );

            $this->response($data, 404);
        }
    }

    private function error($p_msg){
        return array(
            'error' => array(
                'message' => $p_msg
                )
            );
    }
}

?>
