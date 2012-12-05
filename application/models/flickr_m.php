<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Flickr_m extends CI_Model {

	private $api_key = 'cacbb5c6035ec546a8a8755e8e585801';
	private $secret = 'cbc54fafd28e4591';

	public function __construct() {
		parent::__construct();
		$this->load->library('Flickr_API');

		$flickr_api_config = array(
			'request_format'    => 'rest',
			'response_format'   => 'php_serial',
			'api_key'           => $this->api_key,
			'secret'            => $this->secret
		);

		$this->flickr_api->initialize($flickr_api_config);
	}

	public function getPhotosByText($p_text, $p_limit = 1) {
		$result = $this->flickr_api->photos_search(array(
				'text' => $p_text,
				'per_page' => $p_limit,
				'privacy_filter' => 1,
				'content_type' => 1,
				'sort' => 'relevance',

				'tags' => $p_text,
				'tag_mode' => 'all',
			));

		$urls = array();

		foreach ($result['photos']['photo'] as $photo) {
			// thumb
			$urls[] = 'http://farm'.$photo['farm'].'.static.flickr.com/'.$photo['server'].'/'.$photo['id'].'_'.$photo['secret'].'_s.jpg';

			// large photos
			//$urls[] = "http://farm'.$photo['farm'].'.static.flickr.com/'.$photo['server'].'/'.$photo['id'].'_'.$photo['secret'].'.jpg" title="'.$photo['title'].'";
		}

		return $urls;
	}

}

/* End of file flickr_m.php */
/* Location: ./application/models/flickr_m.php */
