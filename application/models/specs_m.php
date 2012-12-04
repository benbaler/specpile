<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Specs_m extends CI_Model {
	private $collection = 'specs';

	public function getSpecById($p_id) {
		return current($this->_get($p_id));
	}

	public function getSpecByIdAndCategoryId($p_id, $p_categoryId) {
		return current($this->_get(array('_id' => new MongoId($p_id), 'category_id' => new MongoId($p_categoryId))));
	}

	public function getSpecIdByNameAndCategoryId($p_specName, $p_categoryId) {
		$regex = new MongoRegex('/^'.$p_specName.'$/i');
		$spec = current($this->_get(array('name' => $regex, 'category_id' => new MongoId($p_categoryId))));
		return isset($spec['_id']) ? $spec['_id']->__toString() : FALSE;
	}

	public function addSpecByName($p_specName, $p_categoryId, $p_userId) {
		$categoryId = new MongoId($p_categoryId);
		$userId = new MongoId($p_userId);

		$datetime = $this->mongo_db->date();

		$specId = $this->getSpecIdByNameAndCategoryId($p_specName, $p_categoryId);

		if ($specId == FALSE) {

			$spec = array(
				'name' => $p_specName,
				'category_id' => $categoryId,
				'user_id' => $userId,
				'active' => true,

				'version' => $datetime,
				'history' => array(
					array(
						'version' => $datetime,
						'name' => $p_specName,
						'category_id' => $categoryId,
						'user_id' => $userId,
						'active' => true
					)
				)
			);

			$specId = $this->_set($spec);

			return $specId->__toString();
		}

		return $specId;
	}

	public function updateSpecName($p_specName, $p_specId, $p_userId) {
		$datetime = $this->mongo_db->date();

		$specId = new MongoId($p_specId);
		$userId = new MongoId($p_userId);

		$spec = $this->getSpecById($p_specId);

		if ($spec) {
			$set = array(
				'name' => $p_specName,
				'user_id' => $userId,
				'version' => $datetime
			);

			$push = array(
				'history' => array(
					'version' => $datetime,
					'name' => $p_specName,
					'category_id' => $spec['category_id'],
					'user_id' => $userId,
					'active' =>  $spec['active']
				),
			);

			//$this->_update(array('where' => array('category_id' => $categoryId), 'push' => $push, 'set' => $set));
			$this->mongo_db->where(array('_id' => $specId))->push($push)->set($set)->update($this->collection);
		}
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

/* End of file specs_m.php */
/* Location: ./application/models/specs_m.php */
