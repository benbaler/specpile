<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products_m extends CI_Model{

	private $collection = 'products';

	public function addProduct($p_data) {
		if ($this->_exists(array(
					'category_id' => $p_data['category'],
					'brand_id' => $p_data['brand'],
					'name' => trim($p_data['model'])
				)) == FALSE) {

			$id = $this->_set(array(
					'category_id' => $p_data['category'],
					'brand_id' => $p_data['brand'],
					'name' => trim($p_data['model']),
					'creator_id' => $this->session->userdata('id') ? $this->session->userdata('id') : $this->session->userdata('session_id'),
					'date_time' => $this->mongo_db->date()
				));

			return $id->__toString();
		}
		return FALSE;
	}

	public function getProduct($p_id) {
		return $this->_get($p_id);
	}

	/**
	 * retrive user object from users collection with specific values or key, value pair
	 *
	 * @param array   $p_values
	 * @param string  $p_key
	 * @return array
	 */


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

	/**
	 * check if values or key, value pair exists in users collection
	 *
	 * @param string  $p_values
	 * @param string  $p_key
	 * @return boolean
	 */
	private function _exists($p_values, $p_key = '_id') {
		if (is_array($p_values)) {
			return count($this->_get($p_values)) == 0 ? FALSE : TRUE;
		}
		return count($this->_get($p_values, $p_key)) == 0 ? FALSE : TRUE;
	}
}

/* End of file products_m.php */
/* Location: ./application/models/products_m.php */
