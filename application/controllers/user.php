<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of user
 *
 * @author Ben
 */


class User extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('REST_server');
        $this->load->library('form_validation');
        $this->load->model('users_m');
    }

    /**
     * login user
     *
     * @return bool login
     */
    public function login() {
        if ($this->form_validation->run('login') == TRUE) {
            $user = $this->users_m->login($this->input->post());

            if (count($user) > 0 && $row = current($user)) {
                $data = array(
                    'id' => (string)$row['_id'],
                    'first' => $row['first'],
                    'last' => $row['last'],
                    'email' => $row['email'],
                    'role' => $row['role'],
                    'picture_url' => $row['picture_url'],
                    'logged_in' => TRUE
                    );

                $this->session->set_userdata($data);
                $this->rest_server->success($data);

                return;

            } else {
                $data = array(
                    'error' => array(
                        'message' => 'email and password combination are not match',
                        'type' => 'login',
                        'code' => '1'
                        )
                    );

                $this->rest_server->fail($data);

                return;
            }

        }
        $data = array(
            'error' => array(
                'message' => 'email or password are not valid',
                'type' => 'login',
                'code' => '2'
                )
            );

        $this->rest_server->fail($data);
    }

    /**
     * register user
     *
     * @return bool register success
     */
    public function register() {
        if ($this->form_validation->run('register') == TRUE) {
            $register = $this->users_m->register($this->input->post());

            if ($register == TRUE) {
                $this->rest_server->success();

                return;

            } else {
                $data = array(
                    'error' => array(
                        'message' => 'email is already exists',
                        'type' => 'register',
                        'code' => '1'
                        )
                    );

                $this->rest_server->fail($data);

                return;
            }

        }
        $data = array(
            'error' => array(
                'message' => 'fields are not valid',
                'type' => 'register',
                'code' => '2'
                )
            );

        $this->rest_server->fail($data);
    }

    public function checkEmail() {
        $this->rest_server->success();
    }

    public function facebook()
    {
        $config = array(
            'appId' => '',
            'secret' => ''
            );

        $this->load->library('facebook', $config);
    }

    

}

?>
