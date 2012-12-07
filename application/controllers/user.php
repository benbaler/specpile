<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of user
 *
 * @author Ben
 */


class User extends CI_Controller {

    public function id($p_id){
        $this->load->model('users_m');

        $data = array(
            'app' => 'viewProfile',
            'user' => $p_id ? $this->users_m->getUserById($p_id) : NULL
        );

        $this->load->view('header_v', $data);
        $this->load->view('topbar_v', $this->_user());
        $this->load->view('viewProfile_v', $data);
        $this->load->view('footer_v');

    }

    public function login() {
        if ($this->session->userdata('logged_in') == TRUE)
            redirect('home');

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

    public function logout(){
        $this->session->sess_destroy();
        redirect('home');   
    }

    private function _user() {
        return array(
            'id' => $this->session->userdata('id'),
            'first' => $this->session->userdata('first'),
            'picture_url' => $this->session->userdata('picture_url'),
            'logged_in' => $this->session->userdata('logged_in')
        );
    }


}

?>
