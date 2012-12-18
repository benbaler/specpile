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
		$this->load->model( array('categories_m','icecat_m') );
		// $products = $this->icecat_m->getProductsByQueryAndLimit('', 500);

		// $images = array();
		// foreach ($products as $product) {
		// 	if($product['image']){
		// 		$images[] = $product['image'];
		// 	}
		// }

		$data = array(
			'app' => 'home',
			'categories' => $this->categories_m->getListOfNames(),
			'title' => 'Specpile',
			//'images' => $images
		);

		$this->load->view( 'header_v', $data );
		$this->load->view( 'topbar_v', $this->_user() );
		// $this->load->view( 'elements/wall_v', $data );
		$this->load->view( 'elements/welcomeMsg_v' );
		$this->load->view( 'forms/search_v' );
		$this->load->view( 'elements/results_v' );
		$this->load->view( 'footer_v' );
	}

	public function slide()
	{
		$this->load->view('elements/iphone_v');
	}

	private function _user() {
		return array(
			'id' => $this->session->userdata( 'id' ),
			'first' => $this->session->userdata( 'first' ),
			'picture_url' => $this->session->userdata( 'picture_url' ),
			'logged_in' => $this->session->userdata( 'logged_in' )
		);
	}

	public function updateFieldScan( $category = 'smartphones' ) {
		$products = $this->mongo_db->where( array( 'scan' => 'done', 'category' => $category ) )->get( 'icecat_products' );

		foreach ( $products as $product ) {
			$this->mongo_db->where( array( '_id' => $product['_id'] ) )->set( array( 'scan' => 'scanned' ) )->update( 'icecat_products' );
		}
	}

	public function test( $category = 'smartphones' ) {
		$this->load->model( 'icecat_m' );
		$arr = $this->icecat_m->getTemplateByCategory( $category );

		foreach ( $arr as $feature => $specs ) {
			echo '<label><b>'.$feature.'</b></label><br/>';
			foreach ( $specs as $spec => $options ) {
				echo '<label>'.$spec.' </label>';
				echo '<select>';
				asort( $options );
				foreach ( $options as $option ) {
					echo '<option>'.( $option === TRUE ? 'yes' : ( $option === FALSE ? 'no' : $option ) ) .'</option>';
				}
				echo '</select><br/>';
			}
			echo '<br/>';
		}
	}

	public function test2() {
		$this->load->model( 'scrap_m' );

		$url = 'http://en.wikipedia.org/wiki/June_12';
		$html = file_get_contents( $url );

		$xpath = $this->scrap_m->xpath( $html );

		$lis = $xpath->query( '//li' );

		$str = "";
		$h2s = array( 'Events', 'Birth', 'Death' );

		$i = 0;
		foreach ( $lis as $li ) {

			preg_match( '/^([0-9]*)/', $li->nodeValue, $matches );

			if ( !isset( $li->previousSibling->nodeValue ) && count( $matches ) == 2 ) {
				echo $h2s[$i];
				$i++;
			}

			$a = $li->getElementsByTagName( 'a' ); // many

			// first
			$href = $a->length > 0 ? 'http://wikipedia.org/'.$a->item( 0 )->getAttribute( 'href' ) : "";
			$text = $a->length > 0 ? $a->item( 0 )->nodeValue : "";
			$str .= '<a href="'.$href.'">('.$text.')</a> - '.$li->nodeValue.'<br/>';
		}

		echo $str;
	}

	public function test3() {
		$this->load->model( 'scrap_m' );

		$url = 'http://en.wikipedia.org/wiki/June_12';
		$html = file_get_contents( $url );

		$xpath = $this->scrap_m->xpath( $html );

		$all = $xpath->query( '//h2' );

		foreach ( $all as $single ) {
			if ( $single->tagName == 'h2' ) {
				var_dump( $single->nextSibling->splitText( 10 )->nodeValue );
				echo "found";
			}
		}
	}

	public function test4( $category = 'smartphones' ) {
		ini_set('memory_limit','1024M');
		

		$this->load->model( 'icecat_m' );


		if ( file_exists( 'temp/'.$category.'/template.html' ) ) {
			$arr = unserialize( file_get_contents( 'temp/'.$category.'/template.html' ) );
		}

		if ( !isset( $arr ) ) {
			$arr = $this->icecat_m->getTemplateByCategory( $category );
			file_put_contents( 'temp/'.$category.'/template.html', serialize( $arr ) );
		}

		$product1 = $this->icecat_m->getProductById( '50c7a3f89aa8dfec1d0038ee' );
		$product2 = $this->icecat_m->getProductById( '50c7a3ed9aa8dfec1d003368' );

		$data = array(
			'app' => 'home',
			'title' => 'Specpile | '. ucwords($product1['company']).' '.ucwords($product1['name']).' vs '.ucwords($product2['company']).' '.ucwords($product2['name'])
		);

		echo $this->load->view( 'header_v', $data, TRUE);
		echo $this->load->view( 'topbar_v', $this->_user(), TRUE);


		// var_dump('<pre>', $arr, '</pre>');
		// var_dump('<pre>', $product1, '</pre>');
		// var_dump('<pre>', $product2, '</pre>');

		echo '<div class="row">';
		echo '<div class="twelve columns">';
		echo '<h4>Compare</h4>';
		echo '</div>';
		echo '</div>';

		echo '<div class="row product-compare">';
		echo '<div class="twelve columns">';

		echo '<div class="row"><div class="twelve mobile-four columns feature-compare"><b>'.ucwords($category).'</b></div></div>';

		echo '<div class="row">';
		echo '<div class="eleven mobile-four columns offset-by-one">';

		// company
		echo '<div class="row">';
		echo '<div class="four mobile-four columns">Brand</div>';

		echo '<div class="four mobile-two columns" style="background-color:white;">'.ucwords($product1['company']).'</div>';
		echo '<div class="four mobile-two columns" style="background-color:white;">'.ucwords($product2['company']).'</div>';
		echo '</div>';

		// model
		echo '<div class="row">';
		echo '<div class="four mobile-four columns">Model</div>';

		echo '<div class="four mobile-two columns" style="background-color:white;">'.ucwords($product1['name']).'</div>';
		echo '<div class="four mobile-two columns" style="background-color:white;">'.ucwords($product2['name']).'</div>';
		echo '</div>';

		// image
		echo '<div class="row">';
		echo '<div class="four mobile-four columns">Image</div>';

		echo '<div class="four mobile-two columns" style="background-color:white;"><img src="'.$product1['image'].'"/></div>';
		echo '<div class="four mobile-two columns" style="background-color:white;"><img src="'.$product2['image'].'"/></div>';
		echo '</div>';

		echo '</div>';
		echo '</div>';
		echo '<br/><br/>';

		foreach ( $arr as $feature => $specs ) {
			if ( isset( $product1['features'][$feature] ) || isset( $product2['features'][$feature] ) ) {
				echo '<div class="row"><div class="twelve mobile-four columns feature-compare"><b>'.ucwords($feature).'</b></div></div>';
			}

			foreach ( $specs as $spec => $options ) {
				//asort( $options );

				if ( isset( $product1['features'][$feature][$spec] ) || isset( $product2['features'][$feature][$spec] ) ) {
				// echo '<div class="row">';
				// echo '<div class="twelve columns">';

					echo '<div class="row">';
					echo '<div class="eleven mobile-four columns offset-by-one">';

					echo '<div class="row">';
					echo '<div class="four mobile-four columns">'.ucwords($spec).'</div>';

					if ( isset( $product1['features'][$feature][$spec] ) ) {
						if ( !is_array( $product1['features'][$feature][$spec] ) ) {
							echo '<div class="four mobile-two columns" style="background-color:'.$this->_color( array_search( $product1['features'][$feature][$spec], $options ), count( $options ) ).';">'.ucwords($product1['features'][$feature][$spec]).'</div>';
						} else {
							echo '<div class="four mobile-two columns" style="background-color:'.$this->_color( count( $product1['features'][$feature][$spec] )-1, count( $options ) ).';">'.ucwords(implode( '<br/>', $product1['features'][$feature][$spec] )).'</div>';
						}
					} else {
						echo '<div class="four mobile-two columns">-</div>';
					}

					if ( isset( $product2['features'][$feature][$spec] ) ) {
						if ( !is_array( $product2['features'][$feature][$spec] ) ) {
							echo '<div class="four mobile-two columns" style="background-color:'.$this->_color( array_search( $product2['features'][$feature][$spec], $options ), count( $options ) ).';">'.ucwords($product2['features'][$feature][$spec]).'</div>';
						} else {
							echo '<div class="four mobile-two columns" style="background-color:'.$this->_color( count( $product2['features'][$feature][$spec] )-1, count( $options ) ).';">'.ucwords(implode( '<br/>', $product2['features'][$feature][$spec] )).'</div>';
						}
					} else {
						echo '<div class="four mobile-two columns">-</div>';
					}

					echo '</div>';
					echo '</div>';
					echo '</div>';
				}



				// foreach ( $options as $option ) {

				//  echo '<option>'.( $option === TRUE ? 'yes' : ( $option === FALSE ? 'no' : $option ) ) .'</option>';
				// }
			}

			if ( isset( $product1['features'][$feature] ) || isset( $product2['features'][$feature] ) ) {
				
				echo '<br/><br/>';
			}

		}

		echo '</div>';
		echo '</div>';

		echo $this->load->view( 'footer_v' ,'', TRUE);
	}

	private function _color( $p_pos, $p_count ) {
		$percentage = $p_pos * ( 1/( $p_count-1 ) );

		// echo $percentage.'<br/>';

		if ( $percentage < 0.5 ) {
			// echo floor( 255 * $percentage * 2 ).'<br/>';
			$color = 'rgb(255,'.floor( 255 * $percentage * 2 ).',0)';
		}else {
			// echo floor( 255 * ( $percentage * 2 - 1 ) ).'<br/>';
			$color = 'rgb('.( 255 - floor( 255 * ( $percentage * 2 - 1 ) ) ).',255,0)';
		}

		return $color;
	}

	public function test5( $pos = 0, $count = 10 ) {
		$color = $this->_color( $pos, $count );
		echo '<span style="background-color: '.$color.';">'.$pos.' '.$count.'</span>';
	}

	public function test6( $category = 'smartphones' ) {
		$this->load->model( 'icecat_m' );
		$arr = $this->icecat_m->getTemplateByCategory( $category );

		echo '$features = array(<br/>';

		foreach ( $arr as $feature => $specs ) {
			echo '"'.$feature.'" => array(<br/>';
			foreach ( $specs as $spec => $options ) {
				echo '"'.$spec.'" => array(<br/>';
				asort( $options );
				foreach ( $options as $option ) {
					echo '"'.( $option === TRUE ? 'yes' : ( $option === FALSE ? 'no' : $option ) ) .'",<br/>';
				}
				echo '),<br/>';
			}
			echo '),<br/>';
		}

		echo ');';
	}

	public function test7() {
		//$html = file_get_contents('http://www.gsmarena.com/makers.php3');
		$html = file_get_contents( 'http://www.gsmarena.com/apple_iphone_5-4910.php' );
		file_put_contents( 'gsmarena/specs.html', $html );
	}

	public function test8() {
		$this->load->model( 'scrap_m' );

		// $html = file_get_contents('gsmarena/brands.html');
		// $data = $this->scrap_m->gsmBrands($html);

		// $html = file_get_contents('gsmarena/phones.html');
		// echo $html;
		//$data = $this->scrap_m->gsmPhones($html);

		// var_dump($data);

		//$data = $this->scrap_m->gsmPhonesNav($html);
		// var_dump($data);

		$html = file_get_contents( 'gsmarena/specs.html' );

		$data = $this->scrap_m->gsmSpecs( $html );
		var_dump( $data );


	}

}

/* End of file page.php */
/* Location: ./application/controllers/page.php */
?>
