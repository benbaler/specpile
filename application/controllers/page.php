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
		$this->load->view( 'elements/categories_v', $data );
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
		var_dump($file);

		$output = '';

		if ( isset($bingImageResult->SearchResponse->Image->Results)) {
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

	public function test2()
	{
		?>
		<html> <head> <title>Bing Search Tester (Basic)</title> <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> </head> <body> <h1>Bing Search Tester (Basic)</h1> <form method="POST" action="bing_basic.php"> <label for="service_op">Service Operation</label><br/> <input name="service_op" type="radio" value="Web" CHECKED /> Web <input name="service_op" type="radio" value="Image" /> Image <br/> <label for="query">Query</label><br/> <input name="query" type="text" size="60" maxlength="60" value="" /><br /><br /> <input name="bt_search" type="submit" value="Search" /> </form> <h2>Results</h1> {RESULTS} </body> </html>
		<?php

		$acctKey = 'fpHMLPzJna70WGEyVYH14PUtyGR+XQFYG7Pd7llXiuk=';

		$rootUri = 'https://api.datamarket.azure.com/Bing/Search';

		// Read the contents of the .html file into a string.

		$contents = file_get_contents('bing_basic.html');

		if ($_POST['query'])

		{

		// Here is where you'll process the query.

		// The rest of the code samples in this tutorial are inside this conditional block.

		}

		echo $contents;
	}

}

/* End of file page.php */
/* Location: ./application/controllers/page.php */
?>
