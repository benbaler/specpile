<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->library('REST_server');
	}

	public function add(){
		if ($this->form_validation->run('addProduct') == TRUE) {

			$product = $this->products_m->add($this->input->post());

			if ($product == TRUE) {
				$this->rest_server->success($product);
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

}

/* End of file product.php */
/* Location: ./application/controllers/product.php */
