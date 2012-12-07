<?php

if ( !defined( 'BASEPATH' ) )
	exit( 'No direct script access allowed' );

/**
 * Description of page
 *
 * @author Ben
 */


class Page extends CI_Controller {

	public function index() {
		$this->load->model( 'categories_m' );

		$data = array(
			'app' => 'home',
			'categories' => $this->categories_m->getListOfNames()
		);

		$this->load->view( 'header_v', $data );
		$this->load->view( 'topbar_v', $this->_user() );
		//$this->load->view( 'elements/categories_v', $data );
		$this->load->view( 'elements/welcomeMsg_v');
		$this->load->view( 'forms/search_v' );
		$this->load->view( 'elements/results_v' );
		$this->load->view( 'footer_v' );
	}

	private function _user() {
		return array(
			'id' => $this->session->userdata( 'id' ),
			'first' => $this->session->userdata( 'first' ),
			'picture_url' => $this->session->userdata( 'picture_url' ),
			'logged_in' => $this->session->userdata( 'logged_in' )
		);
	}

	public function test() {

		// Bing API IMAGE by Yoodey.com - Yodi aditya
		$apiNumber = 'fpHMLPzJna70WGEyVYH14PUtyGR+XQFYG7Pd7llXiuk=';
		$countImage = '5';
		$query = 'iphone 5';

		$url = 'http://api.bing.net/json.aspx?AppId='.$apiNumber.'&Query='.urlencode( $query ).'&Sources=Image&Version=2.2&Market=en-us&Adult=Strict&Image.Count='.$countImage.'&Image.Offset=0&JsonType=raw';


		$file = @file_get_contents( $url, 1000000 );


		$bingImageResult = json_decode( $file );
		var_dump( $file );

		$output = '';

		if ( isset( $bingImageResult->SearchResponse->Image->Results ) ) {
			$output .= '<div id="bingImage-wrap"><ul id="imageList">';
			foreach (

				$bingImageResult->SearchResponse->Image->Results as $value ) {


				$imageVal ='<img width="'.$value->Thumbnail->Width.'" height="'.$value->Thumbnail->Height.'" alt="'.$getNode->title.'" title="'.$getNode->title.'" src="'.str_replace( "&", "&amp;", $value->Thumbnail->Url ).'" />';
				$output .= '<li class="resultlistitem">'.$imageVal.'</li>';
			}


			$output .= '</ul><div class="clear"></div></div>';
		}
		echo $output;

	}

	public function test2() {
?>
		<html>
		<head>
			<title>Bing Search Tester (Basic)</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head> <body> <h1>Bing Search Tester (Basic)</h1>
	<form method="POST" action="">
		<label for="service_op">Service Operation</label><br/>
		<input name="service_op" type="radio" value="Web" CHECKED /> Web
		<input name="service_op" type="radio" value="Image" /> Image <br/>
		<label for="query">Query</label><br/>
		<input name="query" type="text" size="60" maxlength="60" value="" /><br /><br />
		<input name="bt_search" type="submit" value="Search" />
	</form>
	<h2>Results</h1>
		{RESULTS}
	</body>
	</html>
		<?php

		$acctKey = 'fpHMLPzJna70WGEyVYH14PUtyGR+XQFYG7Pd7llXiuk=';

		$rootUri = 'https://api.datamarket.azure.com/Bing/Search';


		// Encode the query and the single quotes that must surround it.

		$query = urlencode( "'{$_POST['query']}'" );

		// Get the selected service operation (Web or Image).

		$serviceOp = $_POST['service_op'];

		// Construct the full URI for the query.

		$requestUri = "$rootUri/$serviceOp?\$format=json&Query=$query";

		// Encode the credentials and create the stream context.

		$auth = base64_encode( "$acctKey:$acctKey" );

		$data = array(

			'http' => array(

				'request_fulluri' => true,

				// ignore_errors can help debug – remove for production. This option added in PHP 5.2.10

				'ignore_errors' => true,

				'header' => "Authorization: Basic $auth" )

		);

		$context = stream_context_create( $data );

		// Get the response from Bing.

		$response = file_get_contents( $requestUri, 0, $context );

		// Decode the response.
		$jsonObj = json_decode( $response );
		$resultStr = '';
		// Parse each result according to its metadata type.
		foreach ( $jsonObj->d->results as $value ) {
			switch ( $value->__metadata->type ) {
			case 'WebResult': $resultStr .= "<a href=\"{$value->Url}\">{$value->Title}</a><p>{$value->Description}</p>";
				break;
			case 'ImageResult': $resultStr .= "<h4>{$value->Title} ({$value->Width}x{$value->Height}) " . "{$value->FileSize} bytes)</h4>" . "<a href=\"{$value->MediaUrl}\">" . "<img src=\"{$value->Thumbnail->MediaUrl}\"></a><br />";
				break;
			}
		}
		// Substitute the results placeholder. Ready to go.
		//$contents = str_replace( '{RESULTS}', $resultStr, $contents );
		echo $resultStr;


	}

	public function test3() {
		$this->load->model('bing_m');
		var_dump($this->bing_m->getPhotosByText('iphone 5'));
	}

}

/* End of file page.php */
/* Location: ./application/controllers/page.php */
?>
