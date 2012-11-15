<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories_m extends CI_Model{
	public function get_all(){
		return $this->mongo_db->get('categories');
	}
} 

/* End of file categories_m.php */
/* Location: ./application/models/categories_m.php */