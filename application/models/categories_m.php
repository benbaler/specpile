<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories_m extends CI_Model{
	private $collection = 'categories';

	public function getCategoryById($p_id) {
		return current($this->_get($p_id));
	}

	public function getCategoryIdByName($p_name) {
		$regex = new MongoRegex('/^'.$p_name.'$/i');
		$category = current($this->_get(array('name' => $regex)));
		return isset($category['_id']) ? $category['_id']->__toString() : FALSE;
	}

	public function addCategoryByName($p_name, $p_userId) {
		$datetime = $this->mongo_db->date();
		$userId = new MongoId($p_userId);

		$categoryId = $this->getCategoryIdByName($p_name);

		if ($categoryId == FALSE) {
			$category = array(
				'name' => $p_name,
				'user_id' => $userId,
				'specs' => array(),
				'active' => true,

				'version' => $datetime,
				'history' => array(
					array(
						'version' => $datetime,
						'name'=> $p_name,
						'user_id'=> $userId,
						'specs' => array(),
						'active' => true
					)
				)
			);

			return $this->_set($category)->__toString();
		}

		return $categoryId;
	}

	public function getListOfNames() {
		$categories = $this->mongo_db->get($this->collection);
		$names = array();
		foreach ($categories as $category) {
			$names[] = $category['name'];
		}
		return $names;
	}

	public function get_all() {
		return $this->mongo_db->get('categories');
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
}

/* End of file categories_m.php */
/* Location: ./application/models/categories_m.php */
