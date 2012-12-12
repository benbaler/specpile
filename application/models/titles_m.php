<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Titles_m extends CI_Model {
	private $collection = 'titles';

	public function getTitleIdByNameAndCategoryId($p_titleName, $p_categoryId) {
		$regex = new MongoRegex('/^'.$p_titleName.'$/i');
		$title = current($this->_get(array('name' => $regex, 'category_id' => new MongoId($p_categoryId))));
		return isset($title['_id']) ? $title['_id']->__toString() : FALSE;
	}

	public function addTitleByName($p_titleName, $p_categoryId, $p_userId) {
		$categoryId = new MongoId($p_categoryId);
		$userId = new MongoId($p_userId);

		$datetime = $this->mongo_db->date();

		$titleId = $this->getTitleIdByNameAndCategoryId($p_titleName ,$p_categoryId);

		if ($titleId == FALSE) {

			$title = array(
				'name' => $p_titleName,
				'category_id' => $categoryId,
				'user_id' => $userId,
				'active' => true,

				'version' => $datetime,
				'history' => array(
					array(
						'version' => $datetime,
						'name' => $p_titleName,
						'category_id' => $categoryId,
						'user_id' => $userId,
						'active' => true
					)
				)
			);

			$titleId = $this->_set($title);

			return $titleId->__toString();
		}

		return $titleId;
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

/* End of file titles_m.php */
/* Location: ./application/models/titles_m.php */
