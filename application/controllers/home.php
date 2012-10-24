<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Home
 *
 * @author Ben
 */
class Home extends CI_Controller {

    public function index() {
        $this->load->view('header_v');
        // $this->load->view('topbar_v');
        $this->load->view('forms/login_v');
        $this->load->view('footer_v');
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
?>
