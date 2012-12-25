<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Product extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function smartphones( $offest = 0 ) {
		$this->_sitemap( 'smartphones', $offest );
	}

	public function tablets( $offest = 0 ) {
		$this->_sitemap( 'tablets', $offest );
	}

	public function cameras( $offest = 0 ) {
		// ini_set('memory_limit', '1024M');
		$this->_sitemap( 'cameras', $offest );
	}

	public function _sitemap( $category, $offset ) {
		$limit = 25;

		$this->load->model( 'icecat_m' );

		$products = $this->icecat_m->getProductsByCategory( array( $category ) );
		$total = count( $products );

		$items = array();

		for ( $i = $offset; $i < $limit+$offset; $i++ ) {
			if ( isset( $products[$i] ) ) {
				$items[] = array(
					'id' => $products[$i]['_id']->__toString(),
					'name' => $products[$i]['name'],
					'category' => $products[$i]['category'],
					'company' => $products[$i]['company'],
					'image' => $this->icecat_m->getImageByIdAndUrl( $products[$i]['_id']->__toString(), $products[$i]['image'] )
				);
			}
		}

		$this->load->library( 'pagination' );

		$config['base_url'] = '/product/'.$category.'/';
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;

		$this->pagination->initialize( $config );

		$data = array(
			'app' => 'login',
			'products' => $items,
			'title' => ucwords( $category ).' page '.( $offset/$limit+1 ),
			'pagination' => $this->pagination->create_links()
		);

		$user = $this->_user();

		$this->load->view( 'header_v', $data );
		$this->load->view( 'topbar_v', $user );
		$this->load->view( 'elements/sitemap_v', $data );
		$this->load->view( 'footer_v' );
	}

	public function view( $p_id ) {
		$this->load->model( array( 'icecat_m' ) );

		$product = $this->icecat_m->getProductViewById( $p_id );

		$product['image'] = $this->icecat_m->getImageByIdAndUrl( $product['_id']->__toString(), $product['image'] );

		$data = array(
			'app' => 'viewProduct',
			'product' => $product,
			'title' => ucwords( $product['company'] ).' '.ucwords( $product['name'] )
		);

		$user = $this->_user();

		$this->load->view( 'header_v', $data );
		$this->load->view( 'topbar_v', $user );
		$this->load->view( 'viewProduct_v', $data );
		$this->load->view( 'footer_v' );

		// $this->load->model(array('categories_m','products_m'));

		// $product = $this->products_m->getProductViewById($p_id);

		// $data = array(
		//  'app' => 'editProduct',
		//  'product' => $product
		// );

		// $user = $this->_user();

		// $this->load->view('header_v', $data);
		// $this->load->view('topbar_v', $user);
		// $this->load->view('viewProduct_v', $data);
		// $this->load->view('footer_v');
	}

	public function add() {
		$this->load->model( array( 'categories_m', 'brands_m' ) );

		$data = array(
			'app' => 'addProduct',
			'categories' => $this->categories_m->getListOfNames(),
			'brands' => $this->brands_m->getListOfNames(),
			'title' => ucwords( $product['brand'] ).' '.ucwords( $product['name'] )
		);

		$user = $this->_user();

		$this->load->view( 'header_v', $data );
		$this->load->view( 'topbar_v', $user );
		$this->load->view( 'forms/addProduct_v', $data );
		$this->load->view( 'footer_v' );
	}

	public function edit( $p_id ) {
		$this->load->model( array( 'categories_m', 'products_m' ) );

		$product = $this->products_m->getProductViewById( $p_id );

		$data = array(
			'app' => 'editProduct',
			'product' => $product,
			'title' => ucwords( $product['company'] ).' '.ucwords( $product['name'] )
		);

		$user = $this->_user();

		$this->load->view( 'header_v', $data );
		$this->load->view( 'topbar_v', $user );
		$this->load->view( 'forms/editProduct_v', $data );
		$this->load->view( 'footer_v' );
	}

	public function compare() {
		$this->load->model( array( 'icecat_m' ) );

		if ( $this->uri->segment( 3 ) && $this->uri->segment( 4 ) && $this->uri->segment( 5 ) ) {
			//$chr = array('/', '.', '*', '+', '?', '|', '(', ')', '[', ']', '{', '}'/*, '\\'*/);
			
			$product1 = str_replace('','',urldecode($this->uri->segment( 4 )));
			$product2 = str_replace('','',urldecode($this->uri->segment( 5 )));
			
			$p1 = $this->icecat_m->getProductByNameAndCategory( $product1, array( $this->uri->segment( 3 ) ) );
			$p2 = $this->icecat_m->getProductByNameAndCategory( $product2, array( $this->uri->segment( 3 ) ) );

			// var_dump($p1,$p2);
			if ( !$p1 || !$p2 ) {
				echo 'no products found please go back and try again!';
				die();
			}


			$this->_compare( $p1['_id']->__toString(), $p2['_id']->__toString(), $this->uri->segment( 3 ) );

		} else {
			$data = array(
				'app' => 'compareProducts',
				'title' => 'Compare products'
			);

			$user = $this->_user();

			$this->load->view( 'header_v', $data );
			$this->load->view( 'topbar_v', $user );
			$this->load->view( 'elements/welcomeMsg_v' );
			$this->load->view( 'forms/compareProducts_v' );
			$this->load->view( 'footer_v' );
		}
	}

	private function _user() {
		return array(
			'id' => $this->session->userdata( 'id' ),
			'first' => $this->session->userdata( 'first' ),
			'picture_url' => $this->session->userdata( 'picture_url' ),
			'logged_in' => $this->session->userdata( 'logged_in' )
		);
	}

	private function _compare( $p_id1, $p_id2, $category = 'smartphones' ) {
		ini_set( 'memory_limit', '1024M' );


		$this->load->model( 'icecat_m' );


		if ( file_exists( 'temp/'.$category.'/template.html' ) ) {
			$arr = unserialize( file_get_contents( 'temp/'.$category.'/template.html' ) );
		}

		if ( !isset( $arr ) ) {
			$arr = $this->icecat_m->getTemplateByCategory( $category );
			file_put_contents( 'temp/'.$category.'/template.html', serialize( $arr ) );
		}

		$product1 = $this->icecat_m->getProductById( $p_id1/*'50c7a3f89aa8dfec1d0038ee'*/ );
		$product2 = $this->icecat_m->getProductById( $p_id2/*'50c7a3ed9aa8dfec1d003368'*/ );

		$data = array(
			'app' => 'compareProducts',
			'title' => ucwords( $product1['company'] ).' '.ucwords( $product1['name'] ).' vs '.ucwords( $product2['company'] ).' '.ucwords( $product2['name'] )
		);

		echo $this->load->view( 'header_v', $data, TRUE );
		echo $this->load->view( 'topbar_v', $this->_user(), TRUE );

		//echo $this->load->view('forms/compareProducts_v', TRUE);

?>

		<div class="row">
  <div class="twelve mobile-four columns">
    <h4>Compare <div class="fb-like" data-href="<?php echo 'http://specpile.com'.$_SERVER['REQUEST_URI'] ?>" data-send="true" data-width="50" data-show-faces="false" layout="button_count"></div></h4>
  </div>
</div>

<div class="row">
  <div class="twelve mobile-four columns">

    <form class="custom collapse" id="compareProducts-form" onsubmit="return false;">

      <div class="row">

        <div class="two mobile-four columns">
          <select name="company" id="category">
            <option value="smartphones" <?php echo $category == 'smartphones' ? 'SELECTED' : ''?>>Smartphones</option>
            <option value="tablets" <?php echo $category == 'tablets' ? 'SELECTED' : ''?>>Tablets</option>
            <option value="cameras" <?php echo $category == 'cameras' ? 'SELECTED' : ''?>>Cameras</option>
          </select>
        </div>

        <div class="four mobile-four columns show-for-medium-down">
          &nbsp;
        </div>

        <div class="four mobile-four columns">
          <input type="text" name="product1" id="product1" value="<?php echo $product1['name'] ?>" placeholder="Type First Product"/>
        </div>

        <div class="four mobile-four columns">
          <input type="text" name="product2" id="product2" value="<?php echo $product2['name'] ?>" placeholder="Type Second Product"/>
        </div>

        <div class="two mobile-four columns">
          <input class="postfix button expand" type="submit" value="Compare"/>
        </div>

      </div>

    </div>
  </form>

</div>
</div>

<?php


		// var_dump('<pre>', $arr, '</pre>');
		// var_dump('<pre>', $product1, '</pre>');
		// var_dump('<pre>', $product2, '</pre>');

		// echo '<div class="row">';
		// echo '<div class="twelve columns">';
		// echo '<h4>Compare</h4>';
		// echo '</div>';
		// echo '</div>';

		echo '<div class="row product-compare">';
		echo '<div class="twelve columns">';

		echo '<div class="row"><div class="twelve mobile-four columns feature-compare"><b>'.ucwords( $category ).'</b></div></div>';

		echo '<div class="row">';
		echo '<div class="eleven mobile-four columns offset-by-one">';

		// company
		echo '<div class="row">';
		echo '<div class="four mobile-four columns">Brand</div>';

		echo '<div class="four mobile-two columns" style="background-color:white;">'.ucwords( $product1['company'] ).'</div>';
		echo '<div class="four mobile-two columns" style="background-color:white;">'.ucwords( $product2['company'] ).'</div>';
		echo '</div>';

		// model
		echo '<div class="row">';
		echo '<div class="four mobile-four columns">Model</div>';

		echo '<div class="four mobile-two columns" style="background-color:white;">'.ucwords( $product1['name'] ).'</div>';
		echo '<div class="four mobile-two columns" style="background-color:white;">'.ucwords( $product2['name'] ).'</div>';
		echo '</div>';

		// image
		echo '<div class="row">';
		echo '<div class="four mobile-four columns">Image</div>';

		echo '<div class="four mobile-two columns" style="background-color:white;"><img src="'.$this->icecat_m->getImageByIdAndUrl( $product1['_id']->__toString(), $product1['image'] ).'"/></div>';
		echo '<div class="four mobile-two columns" style="background-color:white;"><img src="'.$this->icecat_m->getImageByIdAndUrl( $product2['_id']->__toString(), $product2['image'] ).'"/></div>';
		echo '</div>';

		echo '</div>';
		echo '</div>';
		echo '<br/><br/>';

		foreach ( $arr as $feature => $specs ) {
			if ( isset( $product1['features'][$feature] ) || isset( $product2['features'][$feature] ) ) {
				echo '<div class="row"><div class="twelve mobile-four columns feature-compare"><b>'.ucwords( $feature ).'</b></div></div>';
			}

			foreach ( $specs as $spec => $options ) {
				usort( $options, array( $this, '_compareRef' ) );

				// foreach($options as $option){
				//  echo $option.'<br/>';
				// }
				//die();
				//natsort($options);
				//asort( $options );

				if ( isset( $product1['features'][$feature][$spec] ) || isset( $product2['features'][$feature][$spec] ) ) {
					// echo '<div class="row">';
					// echo '<div class="twelve columns">';

					echo '<div class="row">';
					echo '<div class="eleven mobile-four columns offset-by-one">';

					echo '<div class="row">';
					echo '<div class="four mobile-four columns">'.ucwords( $spec ).'</div>';

					$options1 = $options2 = array();

					if ( isset( $product1['features'][$feature][$spec] ) ) {
						if ( !is_array( $product1['features'][$feature][$spec] ) ) {
							$color = $this->_color( array_search( $product1['features'][$feature][$spec], $options ), count( $options ) );
							$rating = round($this->_rating( array_search( $product1['features'][$feature][$spec], $options ), count( $options ) )).'%';
							// die($rating);
							$o1 = '<div class="four mobile-two columns"><div style="float:right;text-align:right;width:'.$rating.'; background-color:'.$color.';">'.ucwords( $product1['features'][$feature][$spec] ).'</div></div>';
							// $options1 = array( $product1['features'][$feature][$spec] );
						} else {
							$options1 = $product1['features'][$feature][$spec];
							//echo '<div class="four mobile-two columns" style="background-color:'.$this->_color( count( $product1['features'][$feature][$spec] )-1, count( $options ) ).';">'.ucwords(implode( '<br/>', $product1['features'][$feature][$spec] )).'</div>';
						}
					} else {
						$o1 = '<div class="four mobile-two columns">-</div>';
					}

					if ( isset( $product2['features'][$feature][$spec] ) ) {
						if ( !is_array( $product2['features'][$feature][$spec] ) ) {
							$color = $this->_color( array_search( $product2['features'][$feature][$spec], $options ), count( $options ) );
							$rating = round($this->_rating( array_search( $product2['features'][$feature][$spec], $options ), count( $options ) )).'%';
							// die($rating);
							$o2 = '<div class="four mobile-two columns"><div style="text-align:left;width:'.$rating.'; background-color:'.$color.';">'.ucwords( $product2['features'][$feature][$spec] ).'</div></div>';
							// $options2 = array( $product2['features'][$feature][$spec] );
						} else {
							$options2 = $product2['features'][$feature][$spec];
							//echo '<div class="four mobile-two columns" style="background-color:'.$this->_color( count( $product2['features'][$feature][$spec] )-1, count( $options ) ).';">'.ucwords(implode( '<br/>', $product2['features'][$feature][$spec] )).'</div>';
						}
					} else {
						$o2 = '<div class="four mobile-two columns">-</div>';
					}

					if(isset($o1)){
						echo $o1;
						unset($o1);
					}
						
					$this->_options( $options, $options1, $options2 );

					if(isset($o2)){
						echo $o2;
						unset($o2);
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

?>
<!-- 		    <div class="row">
  <div class="twelve mobile-four columns">

    <div id="disqus_thread"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'specpile'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
    </div>
</div> -->

		<div class="row">
		<div class="twelve columns">
		<div class="fb-comments" data-href="<?php echo 'http://specpile.com'.$_SERVER['REQUEST_URI'] ?>" data-width="430" data-num-posts="5"></div>
		</div>
		</div>
		

		<?php

		echo $this->load->view( 'footer_v' , '', TRUE );
	}

	private function _rating( $p_pos, $p_count ) {
		$p_count = $p_count == 1 ? 2 : $p_count;
		$percentage = $p_pos * ( 1/( $p_count-1 ) );

		return $percentage > 0.2 ? round($percentage,2) * 100 : 20;
	}

	private function _color( $p_pos, $p_count ) {
		$p_count = $p_count == 1 ? 2 : $p_count;
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

	private function _options( $options, $options1, $options2 ) {
		//if ( count( $options1 ) > 1 && count( $options2 ) > 1 ) {
			$o1 = $o2 = array();
			foreach ( $options as $key => $option ) {
				if ( in_array( $option, $options1 ) || in_array( $option, $options2 ) ) {
					if ( in_array( $option, $options1 ) ) {
						$o1[] = '<div style="margin:0px;padding:0px;">'.ucwords($option).'</div>';
						//echo '<div class="four mobile-two columns" style="background-color:'.$this->_color( $key, count( $options ) ).';">'.ucwords($option).'</div>';
					} else {
						$o1[] = '<div>-</div>';
						//echo '<div class="four mobile-two columns"><br/></div>';
					}

					if ( in_array( $option, $options2 ) ) {
						$o2[] = '<div style="margin:0px;padding:0px;">'.ucwords($option).'</div>';
						//echo '<div class="four mobile-two columns" style="background-color:'.$this->_color( $key, count( $options ) ).';">'.ucwords($option).'</div>';
					} else {
						$o2[] = '<div>-</div>';
						//echo '<div class="four mobile-two columns"><br/></div>';
					}
				}
			}
			if ( count( $options1 ) > 0 ) echo '<div class="four mobile-two columns"><div style="float:right;text-align:right;width:'.$this->_rating( count( $options1 )-1, count( $options ) ).'%;background-color:'.$this->_color( count( $options1 )-1, count( $options ) ).';">'.implode('',$o1).'</div></div>';
			if ( count( $options2 ) > 0 ) echo '<div class="four mobile-two columns"><div style="text-align:left;width:'.$this->_rating( count( $options2 )-1, count( $options ) ).'%;background-color:'.$this->_color( count( $options2 )-1, count( $options ) ).';">'.implode('',$o2).'</div></div>';
		//}
	}

	private function _compareRef( $a, $b ) {
		return strnatcmp( $a, $b );
	}

}

/* End of file product.php */
/* Location: ./application/controllers/product.php */
