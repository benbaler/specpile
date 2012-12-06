<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bing_m extends CI_Model {

	private $acctKey = 'fpHMLPzJna70WGEyVYH14PUtyGR+XQFYG7Pd7llXiuk=';
	//private $rootUri = 'https://api.datamarket.azure.com/Bing/Search';
	private $rootUri = 'https://api.datamarket.azure.com/Data.ashx/Bing/Search/v1/';
	//Image?Query=%27apple%27&ImageFilters=%27Size%3aSmall%27&$top=5&$format=Atom

	public function getPhotosByText($p_query, $p_limit = 1){
		$query = urlencode("'{$p_query}'");
		$serviceOp = 'Image'; //'Web';

		$requestUri = "{$this->rootUri}/$serviceOp?\$format=json&Query=$query&\$top=$p_limit&ImageFilters=%27Size%3aSmall%27";

		$auth = base64_encode( "{$this->acctKey}:{$this->acctKey}" );

		$data = array(
			'http' => array(
				'request_fulluri' => true,
				'ignore_errors' => true,
				'header' => "Authorization: Basic $auth" )
		);

		$context = stream_context_create( $data );

		$response = file_get_contents( $requestUri, 0, $context );

		$jsonObj = json_decode( $response );
		$resultStr = array();

		foreach ( $jsonObj->d->results as $value ) {
			switch ( $value->__metadata->type ) {
			//case 'WebResult': $resultStr .= "<a href=\"{$value->Url}\">{$value->Title}</a><p>{$value->Description}</p>";
			//	break;
			case 'ImageResult': 
				//$resultStr .= "<h4>{$value->Title} ({$value->Width}x{$value->Height}) " . "{$value->FileSize} bytes)</h4>" . "<a href=\"{$value->MediaUrl}\">" . "<img src=\"{$value->Thumbnail->MediaUrl}\"></a><br />";
				$resultStr[] = $value->Thumbnail->MediaUrl;
				break;
			}
		}

		return $resultStr;
	}
	

}

/* End of file bing_m.php */
/* Location: ./application/models/bing_m.php */
