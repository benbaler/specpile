<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products_m extends CI_Model{

	private $collection = 'products';

	public function getProductIdByNameAndBrandId($p_name, $p_brandId) {
		$regex = new MongoRegex('/^'.$p_name.'$/i');
		$product = current($this->_get(array('name' => $regex, 'brand_id' => new MongoId($p_brandId))));
		return isset($product['_id']) ? $product['_id']->__toString() : FALSE;
	}

	public function addProductByName($p_productName, $p_categoryId, $p_brandId, $p_userId) {
		$categoryId = new MongoId($p_categoryId);
		$brandId = new MongoId($p_brandId);
		$userId = new MongoId($p_userId);

		$datetime = $this->mongo_db->date();

		$productId = $this->getProductIdByNameAndbrandId($p_productName, $p_brandId);

		if ($productId == FALSE) {

			$product = array(
				'name' => $p_productName,
				'category_id' => $categoryId,
				'brand_id' => $brandId,
				'user_id' => $userId,
				'options' => array(),
				'images' => array(),
				'active' => true,

				'version' => $datetime,
				'history' => array(
					array(
						'version' => $datetime,
						'name' => $p_productName,
						'category_id' => $categoryId,
						'brand_id' => $brandId,
						'user_id' => $userId,
						'options' => array(),
						'images' => array(),
						'active' => true
					)
				)
			);

			$productId = $this->_set($product);

			return $productId->__toString();
		}

		return $productId;
	}

	public function getProductById($p_id) {
		return current($this->_get($p_id));
	}

	public function getProductsByQuery($p_query) {
		return $this->mongo_db->where(array('name' => array('$regex' => $p_query, '$options' => 'i')))->get($this->collection);
	}

	public function getProductViewById($p_id)
	{
		$product = current($this->_get($p_id));
		
		$productView = array();

		if(count($product) > 0){
			$this->load->model(array('categories_m', 'brands_m', 'specs_m', 'options_m'));

			$productView['_id'] = $product['_id']->__toString();
			$productView['name'] = $product['name']->__toString();
			$productView['category_id'] = $product['category_id']->__toString();
			$productView['brand_id'] = $product['brand_id']->__toString();
			
			$productView['category_name'] = $this->categories_m->getCategoryNameById($product['category_id']->__toString());
			$productView['brand_name'] = $this->brands_m->getBrandNameById($product['brand_id']->__toString());

			$productView['specs'] = array();

			$category = $this->categories_m->getCategoryNameById($product['category_id']->__toString());
			
			foreach ($category['specs'] as $specId) {
				$spec = $this->getSpecById($specId->__toString());
				$options = $this->getOptionsBySpecId($specId->__toString());
				
			}

			foreach ($product['options'] as $option) {
				
			}
		}

		var_dump($product);
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
