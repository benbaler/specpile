<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'libraries/REST_Controller.php';

$post = json_decode(file_get_contents('php://input'), TRUE);

if (count($_POST) == 0 && count($post) > 0) {
    $_POST = $post;
}

class Api extends REST_Controller {

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
        $this->load->library('form_validation');

        if ($this->form_validation->run('addProduct') == TRUE) {

            $this->load->model('products_m');
            $id = $this->products_m->addProduct($this->post());

            if ($id == TRUE) {
                $data = array(
                    'id' => $id
                );

                $this->response($data, 200);
                return;

            } else {
                $data = array(
                    'error' => array(
                        'message' => 'product is already exists',
                        'type' => 'product',
                        'code' => '1'
                    )
                );

                $this->response($data, 404);
                return;
            }

        }

        $data = array(
            'error' => array(
                'message' => 'fields are not valid',
                'type' => 'product',
                'code' => '2'
            )
        );

        $this->response($data, 404);
    }
}

?>
