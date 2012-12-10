<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Scrap extends CI_Controller {

	private $i = 0;
	private $j = 25;
	private $options = array();
	private $url = 'http://icecat.biz/index.cgi?search=1;language=en;search=1;start_row=';
	private $limit = 0;

	public function __construct() {
		parent::__construct();
		$this->options = array(
			CURLOPT_SSL_VERIFYPEER =>  FALSE,
			CURLOPT_RETURNTRANSFER =>  TRUE,
			CURLOPT_HTTPHEADER =>  array(
				'Host' => 'icecat.biz',
				'Connection' => 'keep-alive',
				'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11',
				'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
				'Referer' => 'http://icecat.biz/index.cgi?search=1;language=en;search=1;start_row=0;',
				'Accept-Encoding' => 'gzip,deflate,sdch',
				'Accept-Language' => 'en-US,en;q=0.8',
				'Accept-Charset' => 'ISO-8859-1,utf-8;q=0.7,*;q=0.3',
			),
			CURLOPT_AUTOREFERER =>  TRUE,
			CURLOPT_FOLLOWLOCATION =>  TRUE,
			CURLOPT_COOKIEJAR =>  'cookies.txt',
			CURLOPT_COOKIEFILE =>  'cookies.txt',
			CURLOPT_MAXREDIRS =>  5
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

		$headers = array(
			'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
			'Accept-Charset' => 'ISO-8859-1,utf-8;q=0.7,*;q=0.3',
			'Accept-Encoding' => 'gzip,deflate,sdch',
			'Accept-Language' => 'en-US,en;q=0.8',
			'Cache-Control' => 'max-age=0',
			'Connection' => 'keep-alive',
			// 'Cookie' => 'PHPSESSID=2i9qjo04tfkopqdce1jnj3bj85; icecat_bizlookup_text=iphone%204; __atuvc=49%7C50; icecat_bizlimit=; icecat_bizULocation=109%7CIL%7CIsrael%7C20.00%7CILS%7C1%7CIsrael.jpg; icecat_bizsearch_query=z97AZcP3Co2HefVbSXoCdn7aiYRna7exd2kazmoTtfcCmu4y',
			'Host' => 'icecat.biz',
			'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'
		);

		// $proxy_ip = '213.181.73.145';
		// $proxy_port = '8080';

		curl_setopt($ch, CURLOPT_URL, "http://icecat.biz/index.cgi?price=&limit_value_1=&feature_id_1=8053&limit_value_2=&feature_id_2=7570&limit_value_3=&feature_id_3=1618&limit_value_4=&feature_id_4=1574&limit_value_5=&feature_id_5=63&limit_value_6=&feature_id_6=74&limit_value_7=&feature_id_7=48&limit_value_8=&feature_id_8=7514&limit_value_9=&feature_id_9=2397&feature_id_10=1766&stock=-2&7=7&52=52&1482=1482&868=868&4645=4645&57=57&5040=5040&4445=4445&10=10&285=285&11=11&45=45&865=865&2451=2451&2440=2440&5113=5113&13=13&75=75&15=15&959=959&3542=3542&358=358&704=704&169=169&1=1&237=237&4908=4908&756=756&88=88&22=22&3173=3173&562=562&90=90&91=91&571=571&4973=4973&281=281&3438=3438&106=106&1841=1841&265=265&263=263&708=708&261=261&25=25&1131=1131&4836=4836&610=610&4995=4995&393=393&4752=4752&3891=3891&26=26&757=757&3513=3513&184=184&5=5&5240=5240&2729=2729&2768=2768&2=2&244=244&2895=2895&2252=2252&1826=1826&4805=4805&2788=2788&language=en&rows=10&uncatid=45121504&new_search=1;");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers );
		curl_setopt($ch, CURLOPT_AUTOREFERER, FALSE);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
		curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
		//curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
		// curl_setopt($ch, CURLOPT_PROXYPORT, $proxy_port);
		// curl_setopt($ch, CURLOPT_PROXYTYPE, 'HTTPS');
		// curl_setopt($ch, CURLOPT_PROXY, $proxy_ip);
		$result = curl_exec( $ch );
		curl_close($ch);

		echo $result;
	}

	public function test6($file) {
		$this->load->model('scrap_m');

		$html = file_get_contents('temp/'.$file);

		$a = $this->scrap_m->search($html);

		echo '<pre>';
		var_dump(array_unique($a));
		echo '</pre>';

	}

	public function test7($i = 0, $j = 25, $l = 2) {
		$this->j = $j;
		$this->load->library('mcurl');

		// $url = 'http://icecat.biz/index.cgi?price=&limit_value_1=&feature_id_1=7350&limit_value_2=&feature_id_2=4963&limit_value_3=&feature_id_3=1585&limit_value_4=&feature_id_4=944&limit_value_5=&feature_id_5=5&limit_value_6=&feature_id_6=8737&limit_value_7=&feature_id_7=3311&limit_value_8=&feature_id_8=1614&limit_value_9=&feature_id_9=1289&limit_value_10=&feature_id_10=3239&limit_value_11=&feature_id_11=3329&limit_value_12=&feature_id_12=2172&limit_value_13=&feature_id_13=7302&limit_value_14=&feature_id_14=771&limit_value_15=&feature_id_15=7737&limit_value_16=&feature_id_16=94&stock=-2&7=7&207=207&4886=4886&2020=2020&7183=7183&9=9&687=687&161=161&2249=2249&32=32&57=57&1374=1374&8420=8420&4243=4243&1905=1905&292=292&1906=1906&1388=1388&4887=4887&4712=4712&3483=3483&15=15&202=202&4824=4824&2280=2280&3815=3815&8610=8610&3273=3273&1=1&1455=1455&2139=2139&1193=1193&4981=4981&4803=4803&3012=3012&4750=4750&684=684&293=293&3067=3067&7981=7981&1161=1161&6612=6612&370=370&4691=4691&7737=7737&106=106&108=108&4746=4746&957=957&39=39&263=263&3025=3025&25=25&1055=1055&2957=2957&738=738&167=167&26=26&4842=4842&191=191&2488=2488&4821=4821&3281=3281&5=5&4804=4804&1639=1639&1172=1172&1843=1843&947=947&4711=4711&1326=1326&2=2&2434=2434&154=154&734=734&247=247&291=291&7924=7924&4744=4744&4822=4822&4741=4741&language=en&rows=16&uncatid=43191528&new_search=1&search_row=0';

		$url = 'http://icecat.biz/index.cgi?price=&limit_value_1=&feature_id_1=8053&limit_value_2=&feature_id_2=7570&limit_value_3=&feature_id_3=1618&limit_value_4=&feature_id_4=1574&limit_value_5=&feature_id_5=63&limit_value_6=&feature_id_6=74&limit_value_7=&feature_id_7=48&limit_value_8=&feature_id_8=7514&limit_value_9=&feature_id_9=2397&feature_id_10=1766&stock=-2&7=7&52=52&1482=1482&868=868&4645=4645&57=57&5040=5040&4445=4445&10=10&285=285&11=11&45=45&865=865&2451=2451&2440=2440&5113=5113&13=13&75=75&15=15&959=959&3542=3542&358=358&704=704&169=169&1=1&237=237&4908=4908&756=756&88=88&22=22&3173=3173&562=562&90=90&91=91&571=571&4973=4973&281=281&3438=3438&106=106&1841=1841&265=265&263=263&708=708&261=261&25=25&1131=1131&4836=4836&610=610&4995=4995&393=393&4752=4752&3891=3891&26=26&757=757&3513=3513&184=184&5=5&5240=5240&2729=2729&2768=2768&2=2&244=244&2895=2895&2252=2252&1826=1826&4805=4805&2788=2788&language=en&rows=10&uncatid=45121504&new_search=1';

		$flag = $i == 0 ? true : false;

		for ($this->i=$i;$this->i<$l*25+$i;$this->i+=25) {
			if ($flag == true) {
				$this->mcurl->add_call("get", $url, array(), $this->options);
				$flag = false;
			}else {
				$this->mcurl->add_call("get", $this->url.$this->i.';', array(), $this->options);
			}
		}

		$this->mcurl->execute(array($this, 'callback'));

	}

	public function callback($key, $call) {
		// <h1>Your IP access was denied by our administrators, as it resembles a ripping attempt.</h1>

		$this->load->model('scrap_m');
		//$this->load->model('mongo_db');

		$html = $call['response'];

		preg_match('/=([0-9]+);$/', $call['url'], $matches);

		$name = '0';
		if (isset($matches[1]))
			$name = $matches[1];

		//echo $name;

		file_put_contents('temp/cameras/'. $name .'.html', $html);

		//var_dump($html);

		$a = $this->scrap_m->search($html);

		var_dump(count($a));

		// if(count($a) == 0){
		//  echo "<br/>ERROR: ".(!isset($matches[1])) ? '0' : $matches[1] ."<br/>";
		// }else{
		//  echo "<br/>SUCCESS: ".(!isset($matches[1])) ? '0' : $matches[1] ."<br/>";
		// }

		foreach ($a as $key => $href) {
			$products = $this->mongo_db->where(array('url' => $href, 'category' => 'cameras'))->get('icecat_products');
			if (count($products) > 0) continue;
			$this->mongo_db->insert('icecat_products', array(
					'url' => $href,
					'category' => 'cameras'
				));
		}

		if ($this->i < $this->j) {
			sleep(3);
			$this->mcurl->add_call("get", $this->url.$this->i.';', array(), $this->options);
			$this->i += 25;
		}

	}

	public function test8($page) {
		echo file_get_contents('temp/smartphones/'.$page);
	}

	public function test9() {
		// $products = $this->mongo_db->get('icecat_products');
		// foreach ($products as $product) {
		//  var_dump($product['_id']->__toString());
		//  $this->mongo_db->where(array('_id' => $product['_id']))->set(array('category' => 'smartphones'))->update('icecat_products');
		// }
	}

	public function test10() {
		$this->load->model('scrap_m');
		$html = file_get_contents('temp/product.html');

		$arr = $this->scrap_m->product($html);

		echo "<pre>";
		var_dump($arr);
		echo "</pre>";
	}

	public function test11() {
		$this->load->model('scrap_m');
		$html = file_get_contents('temp/feature.html');

		$arr = $this->scrap_m->feature($html);

		echo "<pre>";
		var_dump($arr);
		echo "</pre>";
	}

	public function test12() {
		$flag = 0;
		$this->load->model('scrap_m');
		if ($handle = opendir('temp/smartphones')) {
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != "..") {
					$html = file_get_contents('temp/smartphones/'. $entry);
					//echo $html;
					$products = $this->scrap_m->products($html);
					foreach ($products as $product) {
						$p = current($this->mongo_db->where(array('id' => $product['id']))->get('icecat_products2'));
						if (!$p) {
							$this->mongo_db->insert('icecat_products2', $product);
						}
					}
					//if ($flag == 2) die();
					$flag++;
				}
			}
			closedir($handle);
		}
	}

	public function test13($i = 0, $j = 10, $l = 3) {
		// error: 0 = not scanned, 1 = scanned, 2 = some error
		// $this->mongo_db->set(array('error' => 0))->update('icecat_products2');
		// die();
		$this->load->library('mcurl');
		$this->load->model('scrap_m');

		$this->i = $i;
		$this->j = $j;

		for ($i = 0; $i < $j; $i++) {
			$product = current($this->mongo_db->where(array('error' => 0))->get('icecat_products2'));
			// var_dump($product); die();
			if ($product) {
				$id = $product['product_id'];
				$html = file_get_contents("http://icecat.biz/index.cgi?ajax=productPage;product_id=".$id.";language=en;request=feature");

				if (strlen($html) < 10) {
					$this->mongo_db->where(array('product_id' => $id))->set(array('error' => 2))->update('icecat_products2');
				} else {
					$features = $this->scrap_m->feature($html);
					if (count($features) < 3) {
						var_dump($html, $features, $id);
						die();
					}
					echo $features;
					$this->mongo_db->where(array('product_id' => $id))->set(array('error' => 1, 'specs' => $features))->update('icecat_products2');
				}

				//$this->mcurl->add_call("get", "http://icecat.biz/index.cgi?ajax=productPage;product_id=".$product['id'].";language=en;request=feature", array(), $this->options);
			}
			sleep(3);
			$this->i++;
		}

		$this->mcurl->execute(array($this, 'callback2'));
	}

	public function callback2($key, $call) {
		// <h1>Your IP access was denied by our administrators, as it resembles a ripping attempt.</h1>

		$this->load->model('scrap_m');

		preg_match('/product_id=([0-9]+);/', $call['url'], $matches);
		$id = $matches[1];

		$error = $call['error'];

		if ($error) {
			$this->mongo_db->where(array('id' => $id))->set(array('error' => 2))->update('icecat_products2');
		} else {
			$html = $call['response'];
			$features = $this->scrap_m->feature($html);
			if (count($features) < 3) {
				var_dump($html, $features, $call['url']);
				echo file_get_contents('http://icecat.biz/index.cgi?ajax=productPage;product_id=4719950;language=en;request=feature');
				die();
			}
			$this->mongo_db->where(array('id' => $id))->set(array('error' => 1, 'specs' => $features))->update('icecat_products2');
		}

		if ($this->i < $this->j) {
			sleep(3);
			$product = current($this->mongo_db->where(array('error' => 0))->get('icecat_products2'));

			if ($product) {
				$this->mcurl->add_call("get", "http://icecat.biz/index.cgi?ajax=productPage;product_id=".$product['id'].";language=en;request=feature", array(), $this->options);
			}
			$this->i++;
		}

	}


}

/* End of file scrap.php */
/* Location: ./application/controllers/scrap.php */
