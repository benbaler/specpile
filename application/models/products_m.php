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

	public function getProductViewById($p_id) {
		$product = current($this->_get($p_id));

		$productView = array();

		if (count($product) > 0) {
			$this->load->model(array('categories_m', 'brands_m', 'specs_m', 'options_m'));

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
						'name' => $option['name'],
						'selected' => $optionSeleced
					);
				}

				$specsView[] = array(
					'_id' => $specId,
					'name' => $spec['name'],
					'options' =>  $optionsView
				);

			}


			// fake specs for testing
			$specsFake = array(
				array(
					'_id' => '1',
					'name' => 'Resolution',
					'options' => array(
						array(
							'_id' => '1',
							'name' => '1920x1080',
							'selected' => false,
							'product_id' => '1'
						),
						array(
							'_id' => '2',
							'name' => '1024x768',
							'selected' => true,
							'product_id' => '1'
						),
						array(
							'_id' => '3',
							'name' => '800x600',
							'selected' => false,
							'product_id' => '1'
						),
						array(
							'_id' => '4',
							'name' => '300x200',
							'selected' => false,
							'product_id' => '1'
						)
					)
				),
				array(
					'_id' => '2',
					'name' => 'CPU',
					'options' => array(
						array(
							'_id' => '1',
							'name' => 'A4',
							'selected' => false
						),
						array(
							'_id' => '2',
							'name' => 'A5',
							'selected' => true
						),
						array(
							'_id' => '3',
							'name' => 'A6',
							'selected' => false
						)
					)
				),
				array(
					'_id' => '3',
					'name' => 'Memory',
					'options' => array(
						array(
							'_id' => '1',
							'name' => '1GB',
							'selected' => false
						),
						array(
							'_id' => '2',
							'name' => '2GB',
							'selected' => true
						),
						array(
							'_id' => '3',
							'name' => '4GB',
							'selected' => false)
					)
				)
			);

			$productView = array(
				'_id' => $productId,
				'name' => $product['name'],
				'category_id' => $categoryId,
				'category_name' => $category['name'],
				'brand_id' => $brandId,
				'brand_name' => $brand['name'],

				'specs' => $specsFake//$specsView
			);


		}

		return $productView;
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
