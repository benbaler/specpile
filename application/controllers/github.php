<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Github extends CI_Controller {

	public function pull()
	{
		echo exec('whoami');
		echo exec('git pull');
	}

}

/* End of file github.php */
/* Location: ./application/controllers/github.php */
