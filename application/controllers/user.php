<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of user
 *
 * @author Ben
 */


class User extends CI_Controller {

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

    public function login()
    {
        if ($this->session->userdata('logged_in') == TRUE)
            redirect('/');

        // $this->load->library('Facebook');

        // $user = $this->facebook->getUser();

        // if ($user) {
        //  $logoutUrl = $this->facebook->getLogoutUrl();
        //  echo '<a href="'.$logoutUrl.'">Logout</a>';
        // } else {
        //  $loginUrl = $this->facebook->getLoginUrl(array('redirect_uri' => 'http://specpile.com'));
        //  echo '<a href="'.$loginUrl.'">Login</a>';
        // }

        $data = array(
            'app' => 'login'
        );

        $this->load->view('header_v', $data);
        $this->load->view('topbar_v', $this->_user());
        $this->load->view('forms/login_v');
        $this->load->view('footer_v');
    }

    public function signup() {
        if ($this->session->userdata('logged_in') == TRUE)
            redirect('user/login');

        $data = array(
            'app' => 'register'
        );

        $this->load->view('header_v', $data);
        $this->load->view('topbar_v', $this->_user());
        $this->load->view('forms/register_v');
        $this->load->view('footer_v');
    }

    private function _user(){
        return array(
            'id' => $this->session->userdata('id'),
            'first' => $this->session->userdata('first'),
            'picture_url' => $this->session->userdata('picture_url'),
            'logged_in' => $this->session->userdata('logged_in')
        );
    }
    

}

?>
