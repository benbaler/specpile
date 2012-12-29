<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Bing_m extends CI_Model {

	private $acctKey = 'fpHMLPzJna70WGEyVYH14PUtyGR+XQFYG7Pd7llXiuk=';
	//private $rootUri = 'https://api.datamarket.azure.com/Bing/Search';
	private $rootUri = 'https://api.datamarket.azure.com/Data.ashx/Bing/Search/v1/';
	//Image?Query=%27apple%27&ImageFilters=%27Size%3aSmall%27&$top=5&$format=Atom

	public function getPhotosByText( $p_query, $p_limit = 1 ) {
		$query = urlencode( "'{$p_query}'" );
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
			$resultStr[] = $value->MediaUrl;
			switch ( $value->__metadata->type ) {
				//case 'WebResult': $resultStr .= "<a href=\"{$value->Url}\">{$value->Title}</a><p>{$value->Description}</p>";
				// break;
			case 'ImageResult':
				//$resultStr .= "<h4>{$value->Title} ({$value->Width}x{$value->Height}) " . "{$value->FileSize} bytes)</h4>" . "<a href=\"{$value->MediaUrl}\">" . "<img src=\"{$value->Thumbnail->MediaUrl}\"></a><br />";
				//$resultStr[] = $value->Thumbnail->MediaUrl;
				break;
			}
		}

		return $resultStr;
	}

	public function getImage( $p_id, $p_name, $p_company, $p_image ) {
		if ( !file_exists( 'assets/images/large/'.$p_id.'.jpg' ) ) {
			$images = $this->getPhotosByText( $p_company.' '.$p_name.' shopping', 1 );
			if ( count( $images ) > 0 ) {
				if ( $data = file_get_contents( $images[0] ) ) {
					if ( file_put_contents( 'assets/images/large/'.$p_id.'.jpg', $data ) ) {
						$this->removeWhiteBorder('assets/images/large/'.$p_id.'.jpg');
						return '/assets/images/large/'.$p_id.'.jpg';
					}
				}
			}
		} else {
			return '/assets/images/large/'.$p_id.'.jpg';
		}
		return $p_image;
	}

	public function removeWhiteBorder( $p_image ) {
		//load the image
		$img = imagecreatefromjpeg( $p_image );

		//find the size of the borders
		$b_top = 0;
		$b_btm = 0;
		$b_lft = 0;
		$b_rt = 0;

		//top
		for ( ; $b_top < imagesy( $img ); ++$b_top ) {
			for ( $x = 0; $x < imagesx( $img ); ++$x ) {
				if ( imagecolorat( $img, $x, $b_top ) != 0xFFFFFF ) {
					break 2; //out of the 'top' loop
				}
			}
		}

		//bottom
		for ( ; $b_btm < imagesy( $img ); ++$b_btm ) {
			for ( $x = 0; $x < imagesx( $img ); ++$x ) {
				if ( imagecolorat( $img, $x, imagesy( $img ) - $b_btm-1 ) != 0xFFFFFF ) {
					break 2; //out of the 'bottom' loop
				}
			}
		}

		//left
		for ( ; $b_lft < imagesx( $img ); ++$b_lft ) {
			for ( $y = 0; $y < imagesy( $img ); ++$y ) {
				if ( imagecolorat( $img, $b_lft, $y ) != 0xFFFFFF ) {
					break 2; //out of the 'left' loop
				}
			}
		}

		//right
		for ( ; $b_rt < imagesx( $img ); ++$b_rt ) {
			for ( $y = 0; $y < imagesy( $img ); ++$y ) {
				if ( imagecolorat( $img, imagesx( $img ) - $b_rt-1, $y ) != 0xFFFFFF ) {
					break 2; //out of the 'right' loop
				}
			}
		}

		//copy the contents, excluding the border
		$newimg = imagecreatetruecolor(
			imagesx( $img )-( $b_lft+$b_rt ), imagesy( $img )-( $b_top+$b_btm ) );

		imagecopy( $newimg, $img, 0, 0, $b_lft, $b_top, imagesx( $newimg ), imagesy( $newimg ) );

		imagejpeg($newimg, $p_image);
	}
}

/* End of file bing_m.php */
/* Location: ./application/models/bing_m.php */
