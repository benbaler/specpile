<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Scrap_m extends CI_Model {

	public function gsmSpecs($p_html)
	{
		$xpath = $this->xpath( $p_html );

		$trs = $xpath->query( "//div[@id='specs-list']//tr" );

		$features = array();

		if ( !is_null( $trs ) ) {
			foreach ( $trs as $tr ) {
				$tds = $tr->getElementsByTagName('td');
				$ths = $tr->getElementsByTagName('th');

				if($tds->length == 2){
					if($ths->length && $ths->item(0)->nodeValue != '&nbsp;'){
						$spec = $ths->item(0)->nodeValue;
						$features[$spec] = array();
					}

					if(preg_match('/^[A-Za-z0-9-_.\s]+$/', $tds->item(0)->nodeValue)){
						$sub_spec = preg_match('/^[A-Za-z0-9-_.\s]+$/', $tds->item(0)->nodeValue) ? $tds->item(0)->nodeValue : 'Details';
						$features[$spec][$sub_spec] = array();
					}

					$features[$spec][$sub_spec][] = $tds->item(1)->nodeValue;
				}
			}
		}
		return $features;
	}


	public function gsmPhonesNav($p_html)
	{
		$xpath = $this->xpath( $p_html );

		$as = $xpath->query( "//div[@class='nav-pages']//a" );

		$links = array();

		if ( !is_null( $as ) ) {
			foreach ( $as as $a ) {
				$links[] = $a->getAttribute('href');	
			}
		}
		return array_unique($links);
	}

	public function gsmPhones( $p_html ) {
		$xpath = $this->xpath( $p_html );

		$lis = $xpath->query( "//li" );

		$phones = array();

		if ( !is_null( $lis ) ) {
			foreach ( $lis as $li ) {
				$a = $li->getElementsByTagName( 'a' );
				$img = $li->getElementsByTagName( 'img' );
				$strong = $li->getElementsByTagName( 'strong' );
				// var_dump($a->length, $img->length, $strong->length);
				if ( $a->length && $img->length && $strong->length ) {
					$phones[$strong->item( 0 )->nodeValue] = array(
						'name' => $strong->item( 0 )->nodeValue,
						'thumb' => $img->item( 0 )->getAttribute( 'src' ),
						'link' => $a->item( 0 )->getAttribute( 'href' )
					);
				}
			}
		}
		// echo count( $phones );
		return $phones;
	}
	public function gsmBrands( $p_html ) {
		$xpath = $this->xpath( $p_html );

		$tds = $xpath->query( "//div[@id='mid-col']//td" );

		$brands = array();

		if ( !is_null( $tds ) ) {
			foreach ( $tds as $td ) {
				$img = $td->getElementsByTagName( 'img' );
				$a = $td->getElementsByTagName( 'a' );
				preg_match( '/^([^-]+)/', $a->item( 0 )->getAttribute( 'href' ), $matches );
				$name = $matches[1];
				if ( $img->length ) {
					$brands[$name] = array(
						'image' => $img->item( 0 )->getAttribute( 'src' ),
						'link' => $a->item( 0 )->getAttribute( 'href' )
					);
				} else {
					preg_match( '/^(.*) phones \(([0-9]+)\)$/', $a->item( 0 )->nodeValue, $matches );
					$brands[$name]['name'] = $matches[1];
					$brands[$name]['count'] = $matches[2];
				}
			}
		}

		return $brands;

	}

	public function products( $html ) {
		$products = array();

		$xpath = $this->xpath( $html );

		$trs = $xpath->query( "//*[@id='all-products-table']/tbody/tr" );
		if ( !is_null( $trs ) ) {
			foreach ( $trs as $tr ) {
				$tds = $tr->getElementsByTagName( 'td' );
				if ( $tds->length == 8 ) { // company without logo only name
					for ( $i = 0; $i < 8; $i++ ) {
						switch ( $i ) {
						case 0:
							break;

						case 1:
							$company = "";
							$company = trim( str_replace( '(show your logo)', '', $tds->item( $i )->nodeValue ) );
							break;

						case 2:
							break;
						case 3:
							break;

						case 4:
							$imgs = $tds->item( $i )->getElementsByTagName( 'img' );
							$image = "";
							foreach ( $imgs as $img ) {
								$image = $img->getAttribute( 'src' );
							}
							break;

						case 5:
							$as = $tds->item( $i )->getElementsByTagName( 'a' );
							$code = "";
							foreach ( $as as $a ) {
								$code = $a->nodeValue;
							}
							break;

						case 6:
							$as = $tds->item( $i )->getElementsByTagName( 'a' );
							$link = "";
							$name = "";
							foreach ( $as as $a ) {
								$link = $a->getAttribute( 'href' );
								$name = $a->nodeValue;
								break;
							}
							break;

						default:
						}

					}
				} else {
					for ( $i = 0; $i < 6; $i++ ) {
						switch ( $i ) {
						case 0:
							break;

						case 1:
							$imgs = $tds->item( $i )->getElementsByTagName( 'img' );
							$company = "";
							foreach ( $imgs as $img ) {
								$company = $img->getAttribute( 'alt' );
							}

						case 2:
							$imgs = $tds->item( $i )->getElementsByTagName( 'img' );
							$image = "";
							foreach ( $imgs as $img ) {
								$image = $img->getAttribute( 'src' );
							}

							break;

						case 3:
							$as = $tds->item( $i )->getElementsByTagName( 'a' );
							$code = "";
							foreach ( $as as $a ) {
								$code = $a->nodeValue;
							}
							break;

						case 4:
							$as = $tds->item( $i )->getElementsByTagName( 'a' );

							foreach ( $as as $a ) {
								$link = $a->getAttribute( 'href' );
								$name = $a->nodeValue;
								break;
							};

							break;

						case 5:
							// $imgs = $tds->item($i)->getElementsByTagName('img');

							// foreach ($imgs as $img) {
							//  $m = $img->getAttribute('src');
							//  if ($m) { $image = $m;
							//  }
							// }

							// $as = $tds->item($i)->getElementsByTagName('a');

							// foreach ($as as $a) {
							//  $link = $a->getAttribute('href');
							//  if ($link) {
							//   $name = $a->nodeValue;
							//   break;

							//  }
							// };
							break;
						default:
						}

					}
				}

				preg_match( '/-([0-9]+).html$/', $link, $matches );
				$id = $matches[1];

				$products[] = array(
					'icecat_id' => $id,
					'code' => $code,
					'name' => trim( strtolower( $name ) ),
					'company' => trim( strtolower( $company ) ),
					'link' => $link,
					'image' => $image,
					'scan' => 'pending'
				);
			}
		}

		return $products;
	}

	public function feature( $html ) {

		$arr = array();

		$xpath = $this->xpath( $html );

		$features = $xpath->query( "//td" );

		$spec = "";
		$sub_spec = "";

		if ( !is_null( $features ) ) {
			foreach ( $features as $feature ) {
				if ( $feature->getAttribute( 'class' ) == 'ds_bold_header' ) {
					$spec = trim( strtolower( str_replace( array( '.', '$' ), array( '_', '' ), $feature->nodeValue ) ) );
				}
				if ( $feature->getAttribute( 'class' ) == 'ds_label' ) {
					$pair = explode( '*', $feature->nodeValue );
					$sub_spec = trim( strtolower( str_replace( array( '.', '$' ), array( '_', '' ), $pair[0] ) ) );
					//var_dump($pair[0]);
				}
				if ( $feature->getAttribute( 'class' ) == 'ds_data' ) {
					$val = trim( $feature->nodeValue );
					if ( $val == "" ) {
						$items = $feature->getElementsByTagName( 'img' );
						if ( $items->length == 0 ) {
							$rr[$spec][$sub_spec] = FALSE;
						} else {
							$src = $items->item( 0 )->getAttribute( 'src' );
							$arr[$spec][$sub_spec] = strpos( $src, 'yes' ) !== FALSE ? TRUE : FALSE;
						}
					} else {
						$arr[$spec][$sub_spec] = trim( strtolower( $val ) );
					}
				}
			}

		}

		return $arr;
	}

	public function search( $html ) {
		$xpath = $this->xpath( $html );

		$a = array();

		$elements = $xpath->query( "//a" );

		if ( !is_null( $elements ) ) {
			foreach ( $elements as $element ) {
				if ( preg_match( '/\/p\//', $element->getAttribute( 'href' ) ) ) {
					$a[] = $element->getAttribute( 'href' );
				}
			}
		}

		return array_unique( $a );
	}

	public function product( $html ) {
		$xpath = $this->xpath( $html );

		$product = array();

		// info
		$product = $this->productInfo( $xpath );

		// title
		$product['title'] = $this->text( $xpath, "//*[@id='product-title']" );

		// images
		$product['images'] = $this->productImages( $xpath );

		// desc
		$product['desc'] = $this->text( $xpath, "//*[@id='product-description-wrap']" );
		$product['text'] = $this->text( $xpath, "//*[@id='more_text']" );

		// specs
		//$product['specs'] = $this->productSpecs($xpath);

		return $product;
	}

	public function productInfo( $xpath ) {
		$arr = array();

		$infos = $xpath->query( "//*[contains(@class,'info-item')]" );

		if ( !is_null( $infos ) ) {
			foreach ( $infos as $info ) {
				$pair = explode( ':', $info->nodeValue );

				if ( !isset( $arr[trim( $pair[0] )] ) ) {
					if ( !isset( $pair[0] ) || !isset( $pair[1] ) ) {
						//var_dump('----', $info->nodeValue, '----');
					} else {
						$arr[trim( strtolower( $pair[0] ) )] = preg_replace( '!\s+!', ' ', trim( $pair[1] ) );
					}
				}
			}
		}

		return $arr;
	}

	public function productImages( $xpath ) {
		$arr = array();
		$arr['gallery'] = array();

		$links = $xpath->query( "//a" );

		if ( !is_null( $links ) ) {
			foreach ( $links as $link ) {
				if ( preg_match( '/^http:\/\/images.icecat.biz\/img\/norm\/high/', $link->getAttribute( 'href' ) ) ) {
					$arr['high'] = $link->getAttribute( 'href' );
				}
				if ( preg_match( '/^http:\/\/images.icecat.biz\/img\/gallery/', $link->getAttribute( 'href' ) ) ) {
					$arr['gallery'][] = $link->getAttribute( 'href' );
				}
			}
		}

		$images = $xpath->query( "//img" );

		if ( !is_null( $images ) ) {
			foreach ( $images as $image ) {
				if ( preg_match( '/^http:\/\/images.icecat.biz\/img\/norm\/low/', $image->getAttribute( 'src' ) ) ) {
					$arr['low'] = $image->getAttribute( 'src' );
				}
				if ( preg_match( '/^http:\/\/images.icecat.biz\/img\/gallery_thumbs/', $image->getAttribute( 'src' ) ) ) {
					$arr['gallery'][] = $image->getAttribute( 'src' );
				}
			}
		}

		return $arr;
	}

	public function xpath( $html ) {
		libxml_use_internal_errors( TRUE );
		libxml_clear_errors();

		$doc = new DOMDocument();
		$doc->recover = TRUE;
		$doc->strictErrorChecking = FALSE;
		$doc->loadHTML( $html );

		return new DOMXpath( $doc );
	}

	public function text( $xpath, $query, $space = FALSE ) {
		$str = "";

		$elements = $xpath->query( $query );

		if ( !is_null( $elements ) ) {
			foreach ( $elements as $element ) {
				$str .= $element->nodeValue;
			}
		}

		if ( $space == TRUE ) {
			return preg_replace( '!\s+!', ' ', trim( $str ) );
		}

		return trim( $str );
	}

}

/* End of file scrap_m.php */
/* Location: ./application/models/scrap_m.php */
