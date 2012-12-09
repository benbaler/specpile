<?php

if ( !defined( 'BASEPATH' ) )
	exit( 'No direct script access allowed' );

/**
 * Description of page
 *
 * @author Ben
 */


class Home extends CI_Controller {

	public function index() {
		$this->load->model( 'categories_m' );

		$data = array(
			'app' => 'home',
			'categories' => $this->categories_m->getListOfNames()
		);

		$this->load->view( 'header_v', $data );
		$this->load->view( 'topbar_v', $this->_user() );
		//$this->load->view( 'elements/categories_v', $data );
		$this->load->view( 'elements/welcomeMsg_v' );
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
		$this->load->model( 'bing_m' );
		var_dump( $this->bing_m->getPhotosByText( 'iphone 5' ) );
	}

	public function test4() {
		echo $this->_getICEcatProductSpecs('8808993518876', 1, 1);
	}

	private function _getICEcatProductSpecs( $ean, $drawdescription = 0, $drawpicture = 0 ) {
		// Username and password for usage with ICEcat
		$username = "benbaler";
		$password = "benb1234";

		// Return 0 and exit function if no EAN available
		if ( $ean == null ) {
			return 0;
		}

		// Get the product specifications in XML format
		$context = stream_context_create( array(
				'http' => array(
					'header'  => "Authorization: Basic " . base64_encode( $username.":".$password )
				)
			) );
		$data = file_get_contents( 'http://data.icecat.biz/xml_s3/xml_server3.cgi?ean_upc='.$ean.'&lang=en&output=productxml', false, $context );
		$xml = new SimpleXMLElement( $data );

		// Create arrays of item elements from the XML feed
		$productPicture = $xml->xpath( "//Product" );
		$productDescription = $xml->xpath( "//ProductDescription" );
		$categories = $xml->xpath( "//CategoryFeatureGroup" );
		$spec_items = $xml->xpath( "//ProductFeature" );

		//Draw product specifications table if any specs available for the product
		if ( $spec_items != null ) {
			$categoryList = array();
			foreach ( $categories as $categoryitem ) {
				$catId = intval( $categoryitem->attributes() );
				$titleXML = new SimpleXMLElement( $categoryitem->asXML() );
				$title = $titleXML->xpath( "//Name" );
				$catName = $title[0]->attributes();
				//echo $catId . $catName['Value']. "<br />";
				$categoryList[$catId] = $catName['Value'];
			}

			$specs =  "<table class='productspecs'>";
			$i = 0;

			$drawnCategories = array();

			foreach ( $spec_items as $item ) {
				$specValue = $item->attributes();
				$titleXML = new SimpleXMLElement( $item->asXML() );
				$title = $titleXML->xpath( "//Name" );
				$specName = $title[0]->attributes();
				$specCategoryId = intval( $specValue['CategoryFeatureGroup_ID'] );

				if ( $specName['Value'] != "Source data-sheet" ) {
					$class = $i%2==0?"odd":"even";
					$specs .= "<tr class='".$class."'>
						<td>
							<table>";
					if ( !in_array( $specCategoryId, $drawnCategories ) ) {
						$specs .= "	<tr class='speccategory'>
									<th><h3>".$categoryList[$specCategoryId]."</h3></th>
								</tr>";
						$drawnCategories[$i] = $specCategoryId;
					}
					$specs .= "		<tr>
									<th>".utf8_decode( $specName['Value'] )."</th>
								</tr>
								<tr>
									<td>";
					if ( $specValue['Presentation_Value'] == "Y" ) {
						$specs .= "Yes <img width='15' height='15' src='http://commons.hortipedia.com/images/thumb/3/35/Green_check_icon_file_16KB.png/120px-Green_check_icon_file_16KB.png' alt='Ja' />";
					}
					else if ( $specValue['Presentation_Value'] == "N" ) {
							$specs .= "No <img width='15' height='15' src='http://commons.hortipedia.com/images/thumb/d/dd/Red_x_icon_file_18KB.png/120px-Red_x_icon_file_18KB.png' alt='Nee' />";
						}
					else {
						$specs .= str_replace( '\n', '<br />', utf8_decode( $specValue['Presentation_Value'] ) );
					}
					$specs .= "</td>
								</tr>
							</table>
						</td>
					</tr>";
				}
				$i++;
			}
			$specs .= "</table>";

			//Draw product description and link to manufacturer if available
			if ( $drawdescription != 0 ) {
				foreach ( $productDescription as $item ) {
					$productValues = $item->attributes();
					if ( $productValues['URL'] != null ) {
						$specs .= "<p id='manufacturerlink'><a href='".$productValues['URL']."'>Productinformation from manufacturer</a></p>";
					}
					if ( $productValues['LongDesc'] != null ) {
						$description = utf8_decode( str_replace( '\n', '', $productValues['LongDesc'] ) );
						$description = str_replace( '<b>', '<strong>', $description );
						$description = str_replace( '<B>', '<strong>', $description );
						$description = str_replace( '</b>', '</strong>', $description );
						$specs .= "<p id='manudescription'>".$description."</p>";
					}
				}
			}

			//Draw product picture if available
			if ( $drawdescription != 0 ) {
				foreach ( $productPicture as $item ) {
					$productValues = $item->attributes();
					if ( $productValues['HighPic'] != null ) {
						$specs .= "<div id='manuprodpic'><img src='".$productValues['HighPic']."' alt='' /></div>";
					}
				}
			}
			return $specs;
		}
		else {
			return 0;
		}
	}

	public function test5() {
		$ch = curl_init();
		$headers = array
		(
			'Host' => 'icecat.biz',
			'Connection' => 'keep-alive',
			'User-Agent' => 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.15 (KHTML, like Gecko) Chrome/24.0.1295.0 Safari/537.15',
			'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
			'Referer' => 'http://icecat.biz',
			'Accept-Encoding' => 'gzip,deflate,sdch',
			'Accept-Language' => 'en-US,en;q=0.8',
			'Accept-Charset' => 'ISO-8859-1,utf-8;q=0.7,*;q=0.3',
		);

		curl_setopt($ch, CURLOPT_URL, "http://icecat.biz/index.cgi?search=1;language=en;search=1;start_row=25;");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers );
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1); 
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
	    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt'); 
	    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt'); 
	    curl_setopt($ch, CURLOPT_MAXREDIRS, 5); 
		$result = curl_exec( $ch );
		curl_close($ch);

		echo $result;
	}

}

/* End of file page.php */
/* Location: ./application/controllers/page.php */
?>
