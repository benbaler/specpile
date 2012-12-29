<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Search_m extends CI_Model {

	private $collection = 'searches';

	public function addSearch( $p_query ) {
		$this->_set( array(
				'ip' => $this->input->ip_address(),
				'agent' => $this->input->user_agent(),
				'date' => $this->mongo_db->date(),
				'query' => $p_query
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

/* End of file search_m.php */
/* Location: ./application/models/search_m.php */
