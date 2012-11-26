<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products_m extends CI_Model{

	private $collection = 'products';

	public function addProduct($p_productName, $p_categoryId, $p_brandId, $p_userId) {
		$categoryRef = $this->mongo_db->create_dbref('categories', new MongoId($p_categoryId));
		$brandRef = $this->mongo_db->create_dbref('brands', new MongoId($p_brandId));
		$userRef = $this->mongo_db->create_dbref('users', new MongoId($p_userId));

		$datetime = $this->mongo_db->date();

		$productSearch = array(
			'name' => $p_productName,
			'category_id' => $categoryRef,
			'brand_id' => $brandRef
		);

		if ($this->_exists($productSearch) == FALSE) {

			$product = array(
				'name' => $p_productName,
				'category_id' => $categoryRef,
				'brand_id' => $brandRef,
				'user_id' => $userRef,
				'active' => true,

				'version' => $datetime,
				'history' => array(
					array(
						'name' => $p_productName,
						'category_id' => $categoryRef,
						'brand_id' => $brandRef,
						'user_id' => $userRef,
						'active' => true
					)
				)
			);

			$productId = $this->_set($product);

			return $productId->__toString();
		}
		return FALSE;
	}

	public function getProductById($p_id) {
		$product = current($this->_get($p_id));

		if (count($product) > 0) {
			$product['category_id'] = $this->mongo_db->get_dbref($product['category_id']);
			$product['brand_id'] = $this->mongo_db->get_dbref($product['brand_id']);
			$product['creator_id'] = $this->mongo_db->get_dbref($product['creator_id']);
		}

		return $product;
	}

	public function getProductsByQuery($p_query) {
		return $this->mongo_db->where(array('name' => array('$regex' => $p_query, '$options' => 'i')))->get($this->collection);
	}

	public function get_all() {
		return $this->mongo_db->get($this->collection);
	}

	/**
	 * retrive user object from users collection with specific values or key, value pair
	 *
	 * @param array   $p_values
	 * @param string  $p_key
	 * @return array
	 */


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

	/**
	 * check if values or key, value pair exists in users collection
	 *
	 * @param string  $p_values
	 * @param string  $p_key
	 * @return boolean
	 */
	private function _exists($p_values, $p_key = '_id') {
		if (is_array($p_values)) {
			return count($this->_get($p_values)) == 0 ? FALSE : TRUE;
		}
		return count($this->_get($p_values, $p_key)) == 0 ? FALSE : TRUE;
	}
}

/* End of file products_m.php */
/* Location: ./application/models/products_m.php */
