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

	public function addSpecById($p_specId, $p_categoryId, $p_userId) {
		$datetime = $this->mongo_db->date();

		$specId = new MongoId($p_specId);
		$userId = new MongoId($p_userId);
		$categoryId = new MongoId($p_categoryId);

		$exists = $this->_exists(array('_id' => $categoryId , 'specs' => $specId));

		$category = $exists ? FALSE : current($this->_get($p_categoryId));

		//$category = current($this->_get(array('_id' => $categoryId , 'specs' => $specId)));

		if ($category) {
			array_push($category['specs'],$specId);

			$set = array(
				'user_id' => $userId,
				'version' => $datetime
			);

			$push = array(
				'specs' => $specId,
				'history' => array(
					'version' => $datetime,
					'name' => $category['name'],
					'user_id' => $userId,
					'specs' => $category['specs'],
					'active' =>  $category['active']
				),
			);

			// var_dump($set, $push);
			// die();
			//$this->_update(array('where' => array('category_id' => $categoryId), 'push' => $push, 'set' => $set));
			$update = $this->mongo_db->where(array('_id' => $categoryId))->push($push)->set($set)->update($this->collection);
		}
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

	private function _exists($p_values, $p_key = '_id') {
		return count($this->_get($p_values, $p_key)) == 0 ? FALSE : TRUE;
	}

	private function _update($p_arr){
		$str = '$this->mongo_db';
		foreach ($p_arr as $key => $arr) {
			$str .= '->$key($arr)';
		}

		$str .= '->update($this->collection)';
		eval($str);
	}
}

/* End of file categories_m.php */
/* Location: ./application/models/categories_m.php */
