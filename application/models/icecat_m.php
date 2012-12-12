<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Icecat_m extends CI_Model {

	private $collection = 'icecat_products';

	public function getProductsByQuery($p_query)
	{
		return $this->_get(array('name' => array('$regex' => $p_query, '$options' => 'i')));
	}

	public function getProductsByQueryAndLimit($p_query, $p_limit = 10)
	{
		return $this->mongo_db->where(array('name' => array('$regex' => $p_query, '$options' => 'i'), 'category' => array('$regex' => 'smartphones', '$options' => 'i')))->limit($p_limit)->get($this->collection);
	}

	private function _get( $p_values, $p_key = '_id' ) {
		if ( is_array( $p_values ) ) {
			return $this->mongo_db->where( $p_values )
			->get( $this->collection );
		}
		return $this->mongo_db->where( $p_key, new MongoId( $p_values ) )
		->get( $this->collection );
	}

}

/* End of file icecat_m.php */
/* Location: ./application/models/icecat_m.php */
