<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function view($p_id)
	{
		$this->load->model(array('icecat_m'));
		
		$product = $this->icecat_m->getProductViewById($p_id);

		$data = array(
			'app' => 'editProduct',
			'product' => $product
		);

		$user = $this->_user();

		$this->load->view('header_v', $data);
		$this->load->view('topbar_v', $user);
		$this->load->view('viewProduct_v', $data);
		$this->load->view('footer_v');

		// $this->load->model(array('categories_m','products_m'));
		
		// $product = $this->products_m->getProductViewById($p_id);

		// $data = array(
		// 	'app' => 'editProduct',
		// 	'product' => $product
		// );

		// $user = $this->_user();

		// $this->load->view('header_v', $data);
		// $this->load->view('topbar_v', $user);
		// $this->load->view('viewProduct_v', $data);
		// $this->load->view('footer_v');
	}

	public function add(){
		$this->load->model(array('categories_m', 'brands_m'));
		
		$data = array(
			'app' => 'addProduct',
			'categories' => $this->categories_m->getListOfNames(),
			'brands' => $this->brands_m->getListOfNames()
		);

		$user = $this->_user();

		$this->load->view('header_v', $data);
		$this->load->view('topbar_v', $user);
		$this->load->view('forms/addProduct_v', $data);
		$this->load->view('footer_v');
	}

	public function edit($p_id)
	{
		$this->load->model(array('categories_m','products_m'));
		
		$product = $this->products_m->getProductViewById($p_id);

		$data = array(
			'app' => 'editProduct',
			'product' => $product
		);

		$user = $this->_user();

		$this->load->view('header_v', $data);
		$this->load->view('topbar_v', $user);
		$this->load->view('forms/editProduct_v', $data);
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

/* End of file product.php */
/* Location: ./application/controllers/product.php */