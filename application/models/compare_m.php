<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Compare_m extends CI_Model {

	private $collection = 'compares';

	public function addCompare($p_product1, $p_product1_image, $p_product2, $p_product2_image, $p_category)
		{
			$this->_set( array(
				'ip' => $this->input->ip_address(),
				'agent' => $this->input->user_agent(),
				'date' => $this->mongo_db->date(),
				'product1' => $p_product1,
				'product1_image' => $p_product1_image,
				'product2' => $p_product2,
				'product2_image' => $p_product2_image,
				'category' => $p_category
			) );
		}

		public function getAll()
	{
		return $this->mongo_db->get($this->collection);
	}

	private function _get( $p_values, $p_key = '_id' ) {
		if ( is_array( $p_values ) ) {
			return $this->mongo_db->where( $p_values )
			->get( $this->collection );
		}
		return $this->mongo_db->where( $p_key, new MongoId( $p_values ) )
		->get( $this->collection );
	}

	private function _set( $p_values, $p_key = NULL ) {
		return $this->mongo_db->insert( $this->collection,
			is_array( $p_values ) ? $p_values : array( $p_key => $p_values ) );
	}	

}

/* End of file compare_m.php */
/* Location: ./application/models/compare_m.php */
