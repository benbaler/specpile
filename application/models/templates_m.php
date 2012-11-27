<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Templates_m extends CI_Model {

	private $collection = 'templates';

	public function getTemplateIdByCategoryRef($p_categoryRef){
		$template = current($this->_get(array('category_id' => $p_categoryRef)));
		return isset($template['_id']) ? $template['_id']->__toString() : FALSE;
	}

	public function addTemplateByCategoryId($p_categoryId, $p_userId){
		$datetime = $this->mongo_db->date();

		$userRef = $this->mongo_db->create_dbref('users', new MongoId($p_userId));
		$categoryRef = $this->mongo_db->create_dbref('categories', new MongoId($p_categoryId));

		$templateId = $this->getTemplateIdByCategoryRef($categoryRef);

		if ($templateId == FALSE) {
			$template = array(
				'user_id' => $userRef,
				'category_id' => $categoryRef,
				'specs' => array(),
				'active' => true,

				'version' => $datetime,
				'history' => array(
					array(
						'version' => $datetime,
						'user_id'=> $userRef,
						'category_id' => $categoryRef,
						'specs' => array(),
						'active' => true
					)
				)
			);

			return $this->_set($template)->__toString();
		}

		return $templateId;
	}

	public function getTemplateSpecsByCategoryRef($p_categoryRef){
		$template = current($this->_get(array('category_id' => $p_categoryRef)));
		return $template;
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

/* End of file templates_m.php */
/* Location: ./application/models/templates_m.php */
