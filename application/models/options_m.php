<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Options_m extends CI_Model {

	private $collection = 'options';

	public function getOptionById() {
		return current($this->_get($p_id));
	}

	public function getOptionsBySpecId($p_specId) {
		return $this->_get(array('spec_id' => new MongoId($p_specId)));
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