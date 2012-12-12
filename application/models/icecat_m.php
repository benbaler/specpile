<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Icecat_m extends CI_Model {

	private $collection = 'icecat_products';

	public function getProductsByQuery( $p_query ) {
		return $this->_get( array( 'name' => array( '$regex' => $p_query, '$options' => 'i' ) ) );
	}

	public function getProductsByQueryAndLimit( $p_query, $p_limit = 10 ) {
		return $this->mongo_db->where( array( 'name' => array( '$regex' => $p_query, '$options' => 'i' ), 'category' => array( '$regex' => 'smartphones', '$options' => 'i' ) ) )->limit( $p_limit )->get( $this->collection );
	}






	public function getProductViewById( $p_id ) {

		$product = current( $this->_get( $p_id ) );
		if ( $product ) {
			return $product;
			$specsView = array();
			$i = 1;
			foreach ( $product['features'] as $feature => $specs ) {
				foreach ( $specs as $spec => $option ) {

					$specsView[] = array(
						'_id' => $i,
						'product_id' => $product['_id']->__toString(),
						'category_id' => 1,
						'name' => $spec,
						'options' =>  array(
							'_id' => 1,
							'product_id' => $product['_id']->__toString(),
							'spec_id' => $i,
							'name' => $option,
							'selected' => TRUE
						)
					);

					$i++;
				}
			}

			$productView = array(
				'_id' => $product['_id']->__toString(),
				'name' => $product['name'],
				'category_id' => 1,
				'brand_id' => 1,
				'category_name' => $product['category'],
				'brand_name' => $product['company'],
				'specs' => $specsView,
				'images' => array( $product['image'] )
			);

			return $productView;

		} 

		return array();
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
