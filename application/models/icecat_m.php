<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Icecat_m extends CI_Model {

	private $collection = 'icecat_products';

	public function getProductByNameAndCategory( $p_name, $p_category ) {
		return current( $this->mongo_db->where( array( 'features' => array( '$exists' => true ), 'category' => array( '$in' => $p_category ) ) )->like('company_name', $p_name, 'isu')->limit( 1 )->get( $this->collection ) );
	}

	public function getProductsByQuery( $p_query ) {
		return $this->_get( array( 'company_name' => array( '$regex' => $p_query, '$options' => 'i' ) ) );
	}

	public function getProductsByQueryAndLimit( $p_query, $p_limit = 10, $p_category = array( 'smartphones', 'tablets', 'cameras' ) ) {
		return $this->mongo_db->where( array( 'features' => array( '$exists' => true ), 'category' => array( '$in' => $p_category )/*, 'category' => array( '$regex' => 'smartphones', '$options' => 'i' )*/ ) )->like('company_name', $p_query, 'i')->order_by(array('company_name' => 'ASC'))->limit( $p_limit )->get( $this->collection );
	}

	public function getProductsByCategory( $p_category ) {
		return $this->mongo_db->where( array( 'features' => array( '$exists' => true ), 'category' => array( '$in' => $p_category ) ) )->limit( 30000 )->get( $this->collection );
	}

	public function getProductById( $p_id ) {
		$product = current( $this->_get( $p_id ) );
		$features = array();
		foreach ( $product['features'] as $feature => $specs ) {
			foreach ( $specs as $spec => $option ) {
				$p = str_replace( array( ';', '/ ', '- ' ), array( ',', ',', ',' ), $option );
				$o = explode( ',', $p );
				if ( count( $o ) > 1 ) {
					foreach ( $o as $op ) {
						if ( trim( $op ) ) {
							$features[$feature][$spec][] = trim( $op );
						}
					}
				} else {
					$features[$feature][$spec] = $option === TRUE ? 'yes' : ( $option === FALSE ? 'no' : $option );
				}
			}
		}

		$product['features'] = $features;
		return $product;
	}



	public function getProductViewById( $p_id ) {

		$product = current( $this->_get( $p_id ) );
		if ( $product ) {

			// TODO: fix this!
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

	public function getTemplateByCategory( $category = 'smartphones' ) {
		$products = $this->mongo_db->where( array( 'scan' => 'scanned', 'category' => $category ) )->get( 'icecat_products' );

		$template = array();

		$counter = 0;
		foreach ( $products as $product ) {
			$counter++;

			foreach ( $product['features'] as $feature => $specs ) {
				if ( !isset( $template[$feature] ) ) {
					$template[$feature] = array();
				}

				foreach ( $specs as $spec => $option ) {
					if ( !isset( $template[$feature][$spec] ) ) {
						$template[$feature][$spec] = array();
					}

					if ( !in_array( $option, $template[$feature][$spec] ) ) {
						$p = str_replace( array( ';', '/ ', '- ' ), array( ',', ',', ',' ), $option );
						$o = explode( ',', $p );
						if ( count( $o ) > 1 ) {
							foreach ( $o as $op ) {
								if ( trim( $op ) ) {
									$template[$feature][$spec][] = trim( $op );
								}
							}
						} else {
							if ( gettype( $option ) == 'boolean' ) {
								$template[$feature][$spec][] = 'yes';
								$template[$feature][$spec][] = 'no';
							} else {
								$template[$feature][$spec][] = $option;
							}
						}
					}
				}
			}

		}

		// unique
		foreach ( $template as $f => $ss ) {
			foreach ( $ss as $s => $os ) {
				$template[$f][$s] = array_unique( $os );
			}
		}

		return $template;
	}

	public function getImageByIdAndUrl( $p_id, $p_imgUrl ) {
		if($p_imgUrl == "") return $p_imgUrl;
		
		$imgUrl = 'assets/images/thumbs/'.$p_id.'.jpg';
		if ( !file_exists( $imgUrl ) ) {
			$data = file_get_contents( $p_imgUrl );
			
			if(!$data || !file_put_contents( $imgUrl, $data )){
				return $p_imgUrl;
			}
		}

		return '/'.$imgUrl;
	}

	public function getProducts()
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

}

/* End of file icecat_m.php */
/* Location: ./application/models/icecat_m.php */
