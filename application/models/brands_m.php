<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brands_m extends CI_Model{
	public function get_all(){
		return $this->mongo_db->get('brands');
	}
}

/* End of file brands_m.php */
/* Location: ./application/models/brands_m.php */