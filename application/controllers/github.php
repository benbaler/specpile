<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Github extends CI_Controller {

	public function pull()
	{
		`sudo git pull`;
	}

}

/* End of file github.php */
/* Location: ./application/controllers/github.php */
