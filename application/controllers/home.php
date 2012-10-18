<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home
 *
 * @author Ben
 */

class Home extends CI_Controller {

    public function index() {
        $this->load->view('header_v');
        $this->load->view('topbar_v');
        $this->load->view('footer_v');
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */

?>
