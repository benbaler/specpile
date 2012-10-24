<?php

class MY_Form_validation extends CI_Form_validation {

	public function __construct() {
		parent::__construct();

		// backbone support
		$post = json_decode(file_get_contents('php://input'), TRUE);

		if (count($_POST) == 0 && count($post) > 0) {
			$_POST = $post;
		}

	}

}

?>
