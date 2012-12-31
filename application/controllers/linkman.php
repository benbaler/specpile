<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Linkman extends CI_Controller {

	public function index() {
		echo file_get_contents( 'temp/links.html' );
	}

	public function backlinks( $p_url ) {
		if(!function_exists('curl_init')){
			die('curl is not exists');
		}
?>
			<form method="post" action="">
			<input type="text" name="url">
			<input type="submit">
			</form>

			<?php
		//return if no post or invalide url
		if ( ( !isset( $_POST['url'] ) || !filter_var( $_POST['url'], FILTER_VALIDATE_URL ) ) && !isset( $p_url ) ) {
			return;
		}

		//url
		$url = isset( $_POST['url'] ) ? $_POST['url'] : $p_url;
		$referer = isset( $_POST['url'] ) ? $_POST['url'] : $p_url;

		$post_to = "";
		$link = "";
		$captcha = "";

		//config
		$name = "specpile";
		$email = "team@specpile.com";
		$title = "Specpile Search & Compare Products Specs";
		$site_url = "http://specpile.com";
		$recurl = "http://specpile.com/linkman";
		$description = "Specpile is the place for searching and comparing products by specifications like smart phones, tablets and digital cameras";

		// headers
		$header[] = "Host: ".parse_url( $url, PHP_URL_HOST );
		$header[] = "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.1; he; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3";
		$header[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
		$header[] = "Accept-Language: he,en-us;q=0.7,en;q=0.3";
		$header[] = "Accept-Encoding: gzip,deflate";
		$header[] = "Accept-Charset: windows-1255,utf-8;q=0.7,*;q=0.7";
		$header[] = "Keep-Alive: 115";
		$header[] = "Connection: keep-alive";

		//parse url
		preg_match( "/^(.*\/)(.*)$/", $url, $match );
		if ( isset( $match[1] ) ) {
			$match[1] = $url = str_replace('/url?q=','',$match[1]);
			echo $match[1]."<br/>";
			$post_to = $match[1];
		}

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_REFERER, $referer );
		curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
		curl_setopt( $ch, CURLOPT_FAILONERROR, false );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
		curl_setopt( $ch, CURLOPT_COOKIEJAR, 'cookies.txt' );
		curl_setopt( $ch, CURLOPT_COOKIEFILE, 'cookies.txt' );
		curl_setopt( $ch, CURLOPT_VERBOSE, 0 );

		$content=curl_exec( $ch );
		echo strip_tags($content);

		//grab link
		preg_match( "/<textarea.*>(.*)<\/textarea>/U", $content, $match );
		if ( isset( $match[1] ) ) {
			echo htmlspecialchars_decode( $match[1] )."<br/>";
			//check XSS
			$link = htmlspecialchars_decode( $match[1] );
		}

		/*
//grab action
preg_match_all("/<form.*action=\"(.*)\".*>/U",$content,$match);
if(isset($match[1])){
    echo $match[1]."<br/>";
    //check XSS
    $post_to .= $match[1];
    print_r($match);
}
*/

		//action
		$post_to .= "addlink.php";
		echo $post_to."<br/>";

		//return if post_to or link is blank
		if ( $post_to == "" || $link == "" ) {
			echo "link or post_to were empty!<br/>";
			return;
		}

		//publish link
		if ( !$file = fopen( "temp/links.html", "a+" ) ) {
			echo "can not open file!<br/>";
			return;
		}
		$str = "<div>".$link."</div>";
		if ( fwrite( $file, $str ) === false ) {
			echo "can not write to file!<br/>";
			return;
		}
		fclose( $file );

		$fields['name'] = $name;
		$fields['email'] = $email;
		$fields['title'] = $title;
		$fields['url'] = $site_url;
		$fields['recurl'] = $recurl;
		$fields['description'] = $description;

		curl_setopt( $ch, CURLOPT_URL, $post_to );
		curl_setopt( $ch, CURLOPT_REFERER, $referer );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $fields );
		curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
		curl_setopt( $ch, CURLOPT_FAILONERROR, false );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_COOKIEJAR, 'cookies.txt' );
		curl_setopt( $ch, CURLOPT_COOKIEFILE, 'cookies.txt' );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
		curl_setopt( $ch, CURLOPT_VERBOSE, 1 );

		$content=curl_exec( $ch );
		echo strip_tags($content);

		//grab captcha
		preg_match( "/<b>([0-9]{5})<\/b>/", $content, $match );
		if ( isset( $match[1] ) ) {
			echo $match[1]."<br/>";
			//check XSS
			$captcha = $match[1];
		}

		if ( $captcha == "" ) {
			echo "could not find captcha!<br/>";
		}

		else {
			$fields['secnumber'] = $captcha;

			curl_setopt( $ch, CURLOPT_URL, $post_to );
			curl_setopt( $ch, CURLOPT_REFERER, $referer );
			curl_setopt( $ch, CURLOPT_POST, true );
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $fields );
			curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
			curl_setopt( $ch, CURLOPT_FAILONERROR, false );
			curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
			curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
			curl_setopt( $ch, CURLOPT_COOKIEJAR, 'cookies.txt' );
			curl_setopt( $ch, CURLOPT_COOKIEFILE, 'cookies.txt' );
			curl_setopt( $ch, CURLOPT_VERBOSE, 1 );

			$content=curl_exec( $ch );

			if ( preg_match( "/<b>Your link has been added!<\/b>/", $content ) ) {
				echo "link added!<br/>";
			}
			else "link not added!<br/>";
		}
		
		echo strip_tags($content).'<br/><br/>';

		return;
		//file_put_contents('temp/links.html', $this->input->post('affiliate'), FILE_APPEND);
	}

	public function hotbot( $p_from = 1, $p_amount = 10) {
		$this->load->model( array( 'scrap_m', 'icecat_m' ) );

		for ( $i=$p_from; $i < $p_from+$p_amount ; $i++ ) {
			// $html = file_get_contents( 'http://www.hotbot.com/search/web?pn='.$i.'&q=%22Powered+by+PHP+Link+manager+from+php+scripts%22' );
			$html = file_get_contents( 'http://www.google.com/search?q=%22Powered+by+PHP+Link+manager+from+php+scripts%22&start='.($i*10) );

			$links = $this->scrap_m->links( $html );

			foreach ( $links as $link ) {
				$this->backlinks( str_replace('/url?q=','',$link) );
			}
		}
	}

	public function curl()
	{
		$header = array();
		$header[] = "Host: ".parse_url( 'http://bing.com', PHP_URL_HOST );
		$header[] = "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.1; he; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3";
		$header[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
		$header[] = "Accept-Language: he,en-us;q=0.7,en;q=0.3";
		$header[] = "Accept-Encoding: gzip,deflate";
		$header[] = "Accept-Charset: windows-1255,utf-8;q=0.7,*;q=0.7";
		$header[] = "Keep-Alive: 115";
		$header[] = "Connection: keep-alive";

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, 'http://bing.com' );
		curl_setopt( $ch, CURLOPT_REFERER, 'http://bing.com' );
		curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
		curl_setopt( $ch, CURLOPT_FAILONERROR, false );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
		curl_setopt( $ch, CURLOPT_COOKIEJAR, 'cookies.txt' );
		curl_setopt( $ch, CURLOPT_COOKIEFILE, 'cookies.txt' );
		curl_setopt( $ch, CURLOPT_VERBOSE, 0 );

		$content=curl_exec( $ch );
		echo $content;
	}

}

/* End of file linkman.php */
/* Location: ./application/controllers/linkman.php */
