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

}

/* End of file page.php */
/* Location: ./application/controllers/page.php */
?>
