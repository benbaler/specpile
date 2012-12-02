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
		$this->load->model('categories_m');

		$data = array(
			'app' => 'home',
			'categories' => $this->categories_m->getListOfNames()
		);

		$this->load->view('header_v', $data);
		$this->load->view('topbar_v', $this->_user());
		$this->load->view('elements/categories_v', $data);
		$this->load->view('forms/search_v');
		$this->load->view('elements/results_v');
		$this->load->view('footer_v');
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

/* End of file page.php */
/* Location: ./application/controllers/page.php */
?>
