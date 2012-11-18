<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brands_m extends CI_Model{
	private $collection = 'brands';

	public function get_all(){
		return $this->mongo_db->get('brands');
	}

	public function getBrand($p_id)	{
		return $this->_get($p_id);
	}

	private function _get($p_values, $p_key = '_id') {
		if (is_array($p_values)) {
			return $this->mongo_db->where($p_values)
			->get($this->users_collection);
		}
		return $this->mongo_db->where($p_key, new MongoId($p_values))
		->get($this->collection);
	}
}

/* End of file brands_m.php */
/* Location: ./application/models/brands_m.php */