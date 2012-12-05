<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Description of page
 *
 * @author Ben
 */


class Page extends CI_Controller {

	public function index() {
		$this->load->model('categories_m');

		$data = array(
			'app' => 'home',
			'categories' => $this->categories_m->getListOfNames()
		);

		$this->load->view('header_v', $data);
		$this->load->view('topbar_v', $this->_user());
		$this->load->view('elements/categories_v', $data);
		$this->load->view('forms/search_v');
		$this->load->view('elements/results_v');
		$this->load->view('footer_v');
	}

	private function _user() {
		return array(
			'id' => $this->session->userdata('id'),
			'first' => $this->session->userdata('first'),
			'picture_url' => $this->session->userdata('picture_url'),
			'logged_in' => $this->session->userdata('logged_in')
		);
	}

	public function test() {
		$this->load->library('Flickr_API');
		// Create config array
		$flickr_api_config = array(
			'request_format'    => 'rest',
			'response_format'   => 'php_serial',
			'api_key'           => 'cacbb5c6035ec546a8a8755e8e585801',
			'secret'            => 'cbc54fafd28e4591',
			//'cache_use_db'      => TRUE,
			//'cache_expiration'  => 600,
			//'cache_max_rows'    => 1000,
		);

		// Initialize library with config
		$this->flickr_api->initialize($flickr_api_config);

		// Send authentication request for user account access
		//$this->flickr_api->authenticate('read');

		// Get frob from call back from Flickr
		//$this->flickr_api->auth_getToken($_GET['frob']);

		// Search for some photos
		$photos = $this->flickr_api->photos_search(array(
			'text' => 'apple iphone 5',
			'tags' => 'apple iphone 5',
			'per_page' => 5,
			'tag_mode' => 'all',
			'privacy_filter' => 1,
			'content_type' => 1,
			'sort' => 'relevance'
			));
		foreach ($photos['photos']['photo'] as $key => $value) {
			echo '<div class="flickr-thumb">
    			<a rel="nofollow" target="_blank" href="http://farm'.$value['farm'].'.static.flickr.com/'.$value['server'].'/'.$value['id'].'_'.$value['secret'].'.jpg" title="'.$value['title'].'">
    			<img src="http://farm'.$value['farm'].'.static.flickr.com/'.$value['server'].'/'.$value['id'].'_'.$value['secret'].'_s.jpg" alt="'.$value['title'].'"></a>
    		</div>';
			// echo "<pre>"; var_dump($value); echo "</pre>";
		}
	}

}

/* End of file page.php */
/* Location: ./application/controllers/page.php */
?>
