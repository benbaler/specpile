<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'libraries/REST_Controller.php';

$post = json_decode(file_get_contents('php://input'), TRUE);

if (count($_POST) == 0 && count($post) > 0) {
    $_POST = $post;
}

class Api extends REST_Controller {

    /**
     * [user_get description]
     *
     * @return [type] [description]
     */


    public function user_get() {
        var_dump('get');
        var_dump(apache_request_headers());
        var_dump($this->put());
        var_dump($this->get());
        var_dump($this->input->post());
        var_dump($this->post());
        var_dump($this->delete());
        die();

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

    /**
     * [user_post description]
     *
     * @return [type] [description]
     */
    public function user_post($action) {
        $this->load->model(array('users_m'));
        $this->load->library('form_validation');

        if ($this->form_validation->run('register') == TRUE) {
            $first = trim(ucfirst($this->post('first')));
            $last = trim(ucfirst($this->post('last')));
            $email = trim(strtolower($this->post('email')));
            $pass = $this->post('pass');

            $success = $this->users_m->register($first, $last, $email, $pass);

            if ($success) {
                $this->response(array('success' => true), 200);

            } else {
                $this->response($this->error('Email is already exists'), 404);
            }
        }

        $this->response($this->error('Fields are not valid'), 404);
    }

    public function user_put(){
        var_dump('put');
        var_dump($this->input->post());
        var_dump($this->put());
        var_dump($this->get());
        var_dump($this->post());
        var_dump($this->delete());
        die();

        $this->load->model(array('users_m'));
        $this->load->library('form_validation');

        if ($this->form_validation->run('register') == TRUE) {
            $first = trim(ucfirst($this->post('first')));
            $last = trim(ucfirst($this->post('last')));
            $email = trim(strtolower($this->post('email')));
            $pass = $this->post('pass');

            $success = $this->users_m->register($first, $last, $email, $pass);

            if ($success) {
                $this->response(array('success' => true), 200);

            } else {
                $this->response($this->error('Email is already exists'), 404);
            }
        }

        $this->response($this->error('Fields are not valid'), 404);
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

    private function error($p_msg) {
        return array(
            'error' => array(
                'message' => $p_msg
            )
        );
    }

    private function userLogin() {
        $this->load->model(array('users_m'));
        $this->load->library('form_validation');

        if ($this->form_validation->run('login') == TRUE) {
            $email = trim(strtolower($this->post('email')));
            $pass = $this->post('pass');

            $user = $this->users_m->login($email, $pass);

            if ($user) {
                $data = array(
                    'id' => (string)$user['_id'],
                    'first' => $user['first'],
                    'last' => $user['last'],
                    'email' => $user['email'],
                    'role' => $user['role'],
                    'picture_url' => $user['picture_url'],
                    'logged_in' => TRUE
                );

                $this->session->set_userdata($data);
                $this->response($data, 200);

            } else {
                $this->response($this->error('Email and password combination are not match'), 404);
            }
        }

        $this->response($this->error('Fields are not valid'), 404);
    }
}

?>
