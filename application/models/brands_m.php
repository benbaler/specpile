<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brands_m extends CI_Model{
	private $collection = 'brands';

	public function get_all() {
		return $this->mongo_db->get('brands');
	}

	public function getBrandById($p_id) {
		return $this->_get($p_id);
	}

	public function addBrand($p_name, $p_userId) {
		$datetime = $this->mongo_db->date();
		$user_ref = $this->mongo_db->create_dbref('users', new MongoId($p_userId));

		$brand = array(
			'name' => $p_name,
			'user_id' => $user_ref,
			'active' => true,

			/* history */
			'version' => $datetime,
			'history' => array(
				array(
					'version' => $datetime,
					'name'=> $p_name,
					'user_id'=> $user_ref,
					'active' => true
				)
			)
		);

		return $this->_set($brand);
	}

	private function _get($p_values, $p_key = '_id') {
		if (is_array($p_values)) {
			return $this->mongo_db->where($p_values)
			->get($this->users_collection);
		}
		return $this->mongo_db->where($p_key, new MongoId($p_values))
		->get($this->collection);
	}

	private function _set($p_values, $p_key = NULL) {
		return $this->mongo_db->insert($this->collection,
			is_array($p_values) ? $p_values : array($p_key => $p_values));
	}

	public function getListOfValues() {
		$brands = $this->mongo_db->get('brands');
		$values = array();
		foreach ($brands as $brand) {
			$values[] = $brand['name'];
		}
		return $values;
	}
}

/* End of file brands_m.php */
/* Location: ./application/models/brands_m.php */;
