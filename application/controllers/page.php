<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Description of page
 *
 * @author Ben
 */


class Page extends CI_Controller {

	private $user;

	public function __construct() {
		parent::__construct();
		$this->user = array(
			'id' => $this->session->userdata('id'),
			'first' => $this->session->userdata('first'),
			'picture_url' => $this->session->userdata('picture_url'),
			'logged_in' => $this->session->userdata('logged_in')
		);
	}

	public function index() {
		$this->load->model('categories_m');

		$data = array(
			'app' => 'home',
			'categories' => $this->categories_m->get_all()
		);

		$this->load->view('header_v', $data);
		$this->load->view('topbar_v', $this->user);
		$this->load->view('elements/categories_v', $data);
		$this->load->view('forms/search_v');
		$this->load->view('elements/results_v');
		$this->load->view('footer_v');
	}

	public function login() {
		if ($this->session->userdata('logged_in') == TRUE)
			redirect('page/index');

		$this->load->library('Facebook');

		$user = $this->facebook->getUser();

		// if ($user) {
		// 	$logoutUrl = $this->facebook->getLogoutUrl();
		// 	echo '<a href="'.$logoutUrl.'">Logout</a>';
		// } else {
		// 	$loginUrl = $this->facebook->getLoginUrl(array('redirect_uri' => 'http://specpile.com'));
		// 	echo '<a href="'.$loginUrl.'">Login</a>';
		// }

		$data = array(
			'app' => 'login'
		);

		$this->load->view('header_v', $data);
		$this->load->view('topbar_v', $this->user);
		$this->load->view('forms/login_v');
		$this->load->view('footer_v');
	}

	public function register() {
		if ($this->session->userdata('logged_in') == TRUE)
			redirect('page/login');

		$data = array(
			'app' => 'register'
		);

		$this->load->view('header_v', $data);
		$this->load->view('topbar_v', $this->user);
		$this->load->view('forms/register_v');
		$this->load->view('footer_v');
	}

	public function template() {
		if ($this->session->userdata('logged_in') != TRUE)
			redirect('page/login');

		$data = array(
			'app' => 'template'
		);

		$this->load->view('header_v', $data);
		$this->load->view('topbar_v', $this->user);
		$this->load->view('forms/template_v');
		$this->load->view('footer_v');
	}

}

/* End of file page.php */
/* Location: ./application/controllers/page.php */
?>
