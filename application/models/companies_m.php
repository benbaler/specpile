<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Companies_m extends CI_Controller{
	public function get_all(){
		return $this->mongo_db->get('companies');
	}
} 

/* End of file companies_m.php */
/* Location: ./application/models/companies_m.php */