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

		$productId = $this->getProductIdByNameAndBrandId($p_productName, $p_brandId);

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
		$this->load->model(array('categories_m', 'brands_m', 'specs_m', 'options_m', 'flickr_m'));

		$products = $this->_get(array('name' => array('$regex' => $p_query, '$options' => 'i')));

		$productView = array();
		foreach ($products as $product) {
			// code...
			$productId = $product['_id']->__toString();
			$categoryId = $product['category_id']->__toString();
			$brandId = $product['brand_id']->__toString();

			$category = $this->categories_m->getCategoryById($categoryId);
			$brand = $this->brands_m->getBrandById($brandId);

			$urls = current($this->flickr_m->getPhotosByText($brand['name'].' '.$product['name']));

			$productView[] = array(
				'_id' => $productId,
				'name' => $product['name'],
				'category_id' => $categoryId,
				'category_name' => $category['name'],
				'brand_id' => $brandId,
				'brand_name' => $brand['name'],
				'image' => $urls
			);

		}

		return $productView;
	}

	public function getProductViewById($p_id) {
		$product = current($this->_get($p_id));

		$productView = array();

		if (count($product) > 0) {
			$this->load->model(array('categories_m', 'brands_m', 'specs_m', 'options_m', 'flickr_m'));

			$productId = $product['_id']->__toString();
			$categoryId = $product['category_id']->__toString();
			$brandId = $product['brand_id']->__toString();

			$category = $this->categories_m->getCategoryById($categoryId);
			$brand = $this->brands_m->getBrandById($brandId);


			// TODO: get specView by spec ids??? should be in specs model

			$specsView = array();

			foreach ($category['specs'] as $spec_id) {
				$specId = $spec_id->__toString();
				$spec = $this->specs_m->getSpecById($specId);
				$options = $this->options_m->getOptionsBySpecId($specId);

				$optionsView = array();

				foreach ($options as $option) {
					$optionSeleced = FALSE;
					$optionId = $option['_id']->__toString();

					if (in_array($optionId, $product['options'])) {
						$optionSeleced = TRUE;
					}

					$optionsView[] = array(
						'_id' => $optionId,
						'product_id' => $productId,
						'spec_id' => $specId,
						'name' => $option['name'],
						'selected' => $optionSeleced
					);
				}

				$specsView[] = array(
					'_id' => $specId,
					'category_id' => $categoryId,
					'product_id' => $productId,
					'name' => $spec['name'],
					'options' =>  $optionsView
				);

			}

			// TODO: cache flickr photosearch
			$urls = $this->flickr_m->getPhotosByText($brand['name'].' '.$product['name'], 5);

			$productView = array(
				'_id' => $productId,
				'name' => $product['name'],
				'category_id' => $categoryId,
				'category_name' => $category['name'],
				'brand_id' => $brandId,
				'brand_name' => $brand['name'],
				'specs' => $specsView,
				'images' => $urls
			);

		}

		return $productView;
	}

	public function addOptionById($p_optionId, $p_productId, $p_userId) {
		$datetime = $this->mongo_db->date();

		$optionId = new MongoId($p_optionId);
		$userId = new MongoId($p_userId);
		$productId = new MongoId($p_productId);

		$exists = $this->_exists(array('_id' => $productId , 'options' => $optionId));

		$product = $exists ? FALSE : current($this->_get($p_productId));

		if ($product) {
			$this->load->model('options_m');
			$options = $this->options_m->addOptionToArrayOfOptions($product['options'], $p_optionId);

			$set = array(
				'user_id' => $userId,
				'version' => $datetime,
				'options' => $options
			);

			$push = array(
				'history' => array(
					'version' => $datetime,
					'name' => $product['name'],
					'category_id' => $product['category_id'],
					'brand_id' => $product['brand_id'],
					'user_id' => $userId,
					'options' => $options,
					'images' => $product['images'],
					'active' =>  $product['active']
				),
			);

			$this->mongo_db->where(array('_id' => $productId))->push($push)->set($set)->update($this->collection);
		}
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
