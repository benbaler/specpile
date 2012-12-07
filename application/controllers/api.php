<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

$post = json_decode(file_get_contents('php://input'), TRUE);

if (count($_POST) == 0 && count($post) > 0) {
    $_POST = $post;
}

require APPPATH.'libraries/REST_Controller.php';


class Api extends REST_Controller {

    /**
     * [user_get description]
     *
     * @return [type] [description]
     */


    public function user_get() {
        if (!$this->get('id')) {
            $this->response($this->_error('User is not valid'), 400);
        }
        $this->load->model('users_m');
        $user = $this->users_m->getUserById( $this->get('id') );
        if ($user) {
            $this->response($user, 200); // 200 being the HTTP response code
        }
        else {
            $this->response($this->_error('User not exists'), 404);
        }
    }

    /**
     * [user_post description]
     *
     * @return [type] [description]
     */
    public function user_post($p_action) {
        switch ($p_action) {
        case 'login' :  $this->_userLogin();
            break;
        case 'signup' :  $this->_userSignup();
            break;
        }

        $this->response($this->_error('Action is not valid'), 404);
    }

    public function user_put() {
    }

    public function users_get() {
        $this->load->model('users_m');
        $users = $this->users_m->getAll();
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

    // add product
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

        $this->response($this->_error('Fields are not valid'), 404);
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

    public function option_post() {
        if ($this->get('action') == 'product') {
            $this->load->library('form_validation');

            if ($this->form_validation->run('addOptionProduct') == TRUE) {
                $this->load->model(array('products_m', 'options_m'));

                $userId = $this->session->userdata('id');

                $specId = $this->post('spec_id');
                $productId = $this->post('product_id');

                $product = $this->products_m->getProductById($productId);

                if (!$product) {
                    $this->response($this->_error('Product is not valid'), 404);
                }

                $optionId = $this->options_m->addOptionByName(trim($this->post('name')), $specId, $userId);

                $this->products_m->addOptionById($optionId, $productId, $userId);

                $this->response(array('_id' => $optionId), 200);
            }

            $this->response($this->_error('Fields are not valid'), 404);
        }

        if ($this->get('action') == 'spec') {
            $this->response('success', 200);
        }

        $this->response($this->_error('Action is not valid'), 404);

    }




    public function option_put() {
        if ($this->get('action') == 'product') {
            // TODO: fix put!!!

            $this->load->library('form_validation');

            if ($this->form_validation->run('addOptionProduct') == TRUE) {
                $this->load->model(array('products_m', 'options_m'));

                $userId = $this->session->userdata('id');

                $specId = $this->input->post('spec_id');
                $productId = $this->input->post('product_id');
                $optionId = $this->get('id');

                $product = $this->products_m->getProductById($productId);

                if (!$product) {
                    $this->response($this->_error('Product is not valid'), 404);
                }

                $option = $this->options_m->getOptionById($optionId);

                if (!$option) {
                    $this->response($this->_error('Option is not valid'), 404);
                }

                $this->products_m->addOptionById($optionId, $productId, $userId);

                $this->response(array('_id' => $optionId), 200);
            }

            $this->response($this->_error('Fields are not valid'), 404);
        }

        if ($this->get('action') == 'spec') {
            $this->response('success', 200);
        }

        $this->response($this->_error('Action is not valid'), 404);
    }










    public function spec_post() {
        $this->load->library('form_validation');

        if ($this->form_validation->run('addSpec') == TRUE) {
            $this->load->model(array('specs_m', 'categories_m'));

            $userId = $this->session->userdata('id');
            $categoryId = $this->post('category_id');

            $category = $this->categories_m->getCategoryById($categoryId);

            if (!$category) {
                $this->response($this->_error('Category is not valid'), 404);
            }

            $specId = $this->specs_m->addSpecByName(trim($this->post('name')), $categoryId, $userId);

            $this->categories_m->addSpecById($specId, $categoryId, $userId);

            $this->response(array('_id' => $specId), 200);
        }

        $this->response($this->_error('Fields are not valid'), 404);

    }







    public function spec_put() {
        if ($this->get('action') == 'product') {
            $this->load->library('form_validation');

            if ($this->form_validation->run('updateSpecProduct') == TRUE) {
                $this->load->model(array('specs_m', 'categories_m'));

                $userId = $this->session->userdata('id');
                $categoryId = $this->input->post('category_id');
                $specId = $this->get('id');

                $category = $this->categories_m->getCategoryById($categoryId);

                if (!$category) {
                    $this->response($this->_error('Category is not valid'), 404);
                }

                $spec = $this->specs_m->getSpecByIdAndCategoryId($specId, $categoryId);

                if (!$spec) {
                    $this->response($this->_error('Specification is not valid'), 404);
                }

                $this->specs_m->updateSpecName(trim($this->input->post('name')), $specId, $userId);

                $this->response(array('_id' => $specId), 200);
            }

            $this->response($this->_error('Fields are not valid'), 404);
        }

        $this->response($this->_error('Action is not valid'), 404);
    }











    private function _productNewOption() {
        $this->response('success', 200);
    }




    private function _error($p_msg) {
        return array(
            'error' => array(
                'message' => $p_msg
            )
        );
    }

    private function _userLogin() {
        $this->load->model(array('users_m'));
        $this->load->library('form_validation');

        if ($this->form_validation->run('login') == TRUE) {
            $email = trim(strtolower($this->post('email')));
            $pass = $this->post('pass');

            $user = $this->users_m->login($email, $pass);

            if ($user) {
                $this->users_m->setSession($user);
                $this->response(array('success' => true), 200);
            } else {
                $this->response($this->_error('Email and password combination are not match'), 404);
            }
        }

        $this->response($this->_error('Field are not valid'), 404);
    }

    private function _userSignup() {
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
                $this->response($this->_error('Email is already exists'), 404);
            }
        }

        $this->response($this->_error('Fields are not valid'), 404);
    }
}

?>
