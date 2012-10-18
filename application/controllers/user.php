<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author Ben
 */
class User extends CI_Controller {

    public function __construct() {
        parent::__construct();

        /* load libraries */
        $this->load->library('form_validation');

        /* load models */
        $this->load->model('users_m');
    }

    public function login() {
        /* try validating users credentials */
        if ($this->form_validation->run('login') == TRUE) {
            /* user credentials array */
            $user_credentials = array(
                'email' => $this->input->post('email'),
                'pass' => $this->input->post('pass')
            );

            /* try to login using user credentials */
            $user = $this->users_m->login($user_credentials);
            print_r($user); exit;
            if (count($user_obj) == 0) {
                $this->session->set_userdata(array(
                    'username' => $user_obj['username'],
                    'logged_in' => TRUE));

                echo "true";
                //redirect('home');
            }
        }
        /* on login fail display login form */
        $this->load->view('forms/login_v');
    }
    
    public function loginAjax(){
        /* try validating users credentials */
        if ($this->form_validation->run('login') == TRUE) {
            /* user credentials array */
            $user_credentials = array(
                'email' => $this->input->post('email'),
                'pass' => $this->input->post('pass')
            );

            /* try to login using user credentials */
            $user = $this->users_m->login($user_credentials);
            print_r($user); exit;
            if (count($user_obj) == 0) {
                $this->session->set_userdata(array(
                    'username' => $user_obj['username'],
                    'logged_in' => TRUE));

                echo "true";
                //redirect('home');
            }
        }
        /* on login fail display login form */
        $this->load->view('forms/login_v');
    }

    public function signin() {
        $this->users_m->signin();
    }
    
    

}

?>
