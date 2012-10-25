<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class REST_server {
	private $CI;
	
	public function __construct() {
		$this->CI =& get_instance(); 

		$post = json_decode(file_get_contents('php://input'), TRUE);

		if (count($_POST) == 0 && count($post) > 0) {
			$_POST = $post;
		}
	}

	public function success($data = array()) {
		$this->CI->output->set_status_header('200');
		$this->CI->output->set_content_type('application/json');
		$this->CI->output->set_output(json_encode($data));
	}

	public function fail($data) {
		$this->CI->output->set_status_header('404');
		$this->CI->output->set_content_type('application/json');
		$this->CI->output->set_output(json_encode($data));
	}

}

?>
