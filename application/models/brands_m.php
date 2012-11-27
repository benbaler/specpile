<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brands_m extends CI_Model{
	private $collection = 'brands';

	public function get_all() {
		return $this->mongo_db->get('brands');
	}

	public function getBrandById($p_id) {
		return $this->_get($p_id);
	}

	public function getBrandIdByName($p_name) {
		$regex = new MongoRegex('/^'.$p_name.'$/i');
		$brand = current($this->_get(array('name' => $regex)));
		return isset($brand['_id']) ? $brand['_id']->__toString() : FALSE;
	}

	public function addBrandByName($p_name, $p_userId) {
		$datetime = $this->mongo_db->date();
		$userId = new MongoId($p_userId);

		$brandId = $this->getBrandIdByName($p_name);

		if ($brandId == FALSE) {
			$brand = array(
				'name' => $p_name,
				'user_id' => $userId,
				'active' => true,

				/* history */
				'version' => $datetime,
				'history' => array(
					array(
						'version' => $datetime,
						'name'=> $p_name,
						'user_id'=> $userId,
						'active' => true
					)
				)
			);

			return $this->_set($brand)->__toString();
		}

		return $brandId;
	}

	private function _get($p_values, $p_key = '_id') {
		if (is_array($p_values)) {
			return $this->mongo_db->where($p_values)
			->get($this->collection);
		}
		return $this->mongo_db->where($p_key, new MongoId($p_values))
		->get($this->collection);
	}

	private function _set($p_values, $p_key = NULL) {
		return $this->mongo_db->insert($this->collection,
			is_array($p_values) ? $p_values : array($p_key => $p_values));
	}

	public function getListOfNames() {
		$brands = $this->mongo_db->get($this->collection);
		$names = array();
		foreach ($brands as $brand) {
			$names[] = $brand['name'];
		}
		return $names;
	}
}

/* End of file brands_m.php */
/* Location: ./application/models/brands_m.php */;
