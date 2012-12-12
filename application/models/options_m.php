<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Options_m extends CI_Model {

	private $collection = 'options';

	public function getOptionById($p_id) {
		return current($this->_get($p_id));
	}

	public function getOptionsBySpecId($p_specId) {
		return $this->_get(array('spec_id' => new MongoId($p_specId)));
	}

	public function addOptionToArrayOfOptions(/* Array of MongoIds */ $p_optionsIds, $p_optionId){
		$option = $this->getOptionById($p_optionId);
		$options = array();

		foreach ($p_optionsIds as $optionId) {
			$temp = $this->getOptionById($optionId->__toString());	
			if($temp['spec_id']->__toString() != $option['spec_id']->__toString()){
				$options[] = $optionId;
			}
		}

		$options[] = new MongoId($p_optionId);
		return $options;
	}

	public function getOptionByNameAndSpecId($p_optionName, $p_titleId, $p_specId){
		$regex = new MongoRegex('/^'.$p_optionName.'$/i');
		$option = current($this->_get(array('name' => $regex, 'title_id' => new MongoId($p_titleId), 'spec_id' => new MongoId($p_specId))));
		return isset($option['_id']) ? $option['_id']->__toString() : FALSE;
	}

	public function addOptionByName($p_optionName, $p_titleId, $p_specId, $p_userId){
		$titleId = new MongoId($p_titleId);
		$specId = new MongoId($p_specId);
		$userId = new MongoId($p_userId);

		$datetime = $this->mongo_db->date();

		$optionId = $this->getOptionByNameAndSpecId($p_optionName, $p_titleId, $p_specId);

		if ($optionId == FALSE) {

			$option = array(
				'name' => $p_optionName,
				'title_id' => $titleId,
				'spec_id' => $specId,
				'user_id' => $userId,
				'active' => true,

				'version' => $datetime,
				'history' => array(
					array(
						'version' => $datetime,
						'name' => $p_optionName,
						'title_id' => $titleId,
						'spec_id' => $specId,
						'user_id' => $userId,
						'active' => true
					)
				)
			);

			$optionId = $this->_set($option);

			return $optionId->__toString();
		}

		return $optionId;
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

/* End of file options_m.php */
/* Location: ./application/models/options_m.php */