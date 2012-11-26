<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories_m extends CI_Model{
	private $collection = 'categories';

	public function get_all(){
		return $this->mongo_db->get('categories');
	}

	public function getCategory($p_id){
		return $this->_get($p_id);
	}

	public function getCategoryByName($p_name){
		return $this->_get(array('name' => $p_name));
	}

	private function _get($p_values, $p_key = '_id') {
		if (is_array($p_values)) {
			return $this->mongo_db->where($p_values)
			->get($this->collection);
		}
		return $this->mongo_db->where($p_key, new MongoId($p_values))
		->get($this->collection);
	}

	public function getListOfValues(){
		$categories = $this->mongo_db->get('categories');
		$values = array();
		foreach ($categories as $category) {
			$values[] = $category['name'];
		}
		return $values;
	}

	public function addCategory($p_name){

	}
} 

/* End of file categories_m.php */
/* Location: ./application/models/categories_m.php */