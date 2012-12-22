<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Linkman extends CI_Controller {

	public function index()
	{
		echo file_get_contents('temp/links.html');
	}

	public function affiliate()
	{
		file_put_contents('temp/links.html', $this->input->post('affiliate'), FILE_APPEND);
	}

}

/* End of file linkman.php */
/* Location: ./application/controllers/linkman.php */
