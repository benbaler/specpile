<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Description of page
 *
 * @author Ben
 */


class Page extends CI_Controller {

	public function index() {
		$this->load->view('header_v');
		$this->load->view('topbar_v');
		$this->load->view('forms/search_v');
		$this->load->view('footer_v');
	}

	public function login()
	{
		$this->load->view('header_v');
		$this->load->view('forms/login_v');
		$this->load->view('footer_v');
	}

	public function register()
	{
		$this->load->view('header_v');
		$this->load->view('forms/register_v');
		$this->load->view('footer_v');
	}

}

/* End of file page.php */
/* Location: ./application/controllers/page.php */
?>
