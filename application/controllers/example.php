<?php

class Example extends CI_Controller {

	private $more = TRUE;

	function __construct() {
		parent::__construct();
	}

	function index() {
		/*
		** Load the mcurl library
		*/
		$this->load->library('mcurl');

		/*
		** Example 1: Adding a Basic GET Request
		*/
		//$this->mcurl->add_call("call1","get","http://chadhutchins.com");

		/*
		** Example 2: Adding a Basic POST Request
		*/
		//$this->mcurl->add_call("call2","post","http://twitter.com/chadhutchins");

		/*
		** Example 3: Adding a more complex Request with Variables and Curl Options
		*/
		$vars = array(
			"v" => "1.0",
			"q" => "blogHer"
		);

		$options = array(
			CURLOPT_SSL_VERIFYPEER => FALSE
		);

		//$this->mcurl->add_call("call3","get","https://ajax.googleapis.com/ajax/services/search/blogs",$vars,$options);

		/*
		** Example 4: Error Handling
		*/
		//$this->mcurl->add_call("call4","post","httpasdf://twitter.com/chadhutchins");
		//

		$headers = array
		(
			'Host' => 'icecat.biz',
			'Connection' => 'keep-alive',
			'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11',
			'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
			'Referer' => 'http://icecat.biz/index.cgi?search=1;language=en;search=1;start_row=0;',
			'Accept-Encoding' => 'gzip,deflate,sdch',
			'Accept-Language' => 'en-US,en;q=0.8',
			'Accept-Charset' => 'ISO-8859-1,utf-8;q=0.7,*;q=0.3',
		);

		$options = array(
			CURLOPT_SSL_VERIFYPEER =>  FALSE,
			CURLOPT_RETURNTRANSFER =>  TRUE,
			CURLOPT_HTTPHEADER =>  $headers,
			CURLOPT_AUTOREFERER =>  TRUE,
			CURLOPT_FOLLOWLOCATION =>  TRUE,
			CURLOPT_COOKIEJAR =>  'cookies.txt',
			CURLOPT_COOKIEFILE =>  'cookies.txt',
			CURLOPT_MAXREDIRS =>  5
		);

		$this->mcurl->add_call("get", "http://icecat.biz/index.cgi?search=1;language=en;search=1;start_row=25;", array(), $options);

		$this->mcurl->add_call("get", "http://icecat.biz/index.cgi?search=1;language=en;search=1;start_row=25;", array(), $options);

		$this->mcurl->add_call("get", "http://icecat.biz/index.cgi?search=1;language=en;search=1;start_row=25;", array(), $options);
		/*
		** Execute the requests with Multiple Curl
		*/
		$this->mcurl->execute(array($this, 'callback'));

		// foreach ($data as $call) {
		//  echo $call['response'];
		// }
		/*
		** Display the results with debug method
		*/
		//$this->mcurl->debug();
	}

	public function callback($key, $call) {
		var_dump($key, $call);

		if ($this->more == TRUE) {
			echo "---------------</br>";
			$headers = array
			(
				'Host' => 'icecat.biz',
				'Connection' => 'keep-alive',
				'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11',
				'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
				'Referer' => 'http://icecat.biz/index.cgi?search=1;language=en;search=1;start_row=0;',
				'Accept-Encoding' => 'gzip,deflate,sdch',
				'Accept-Language' => 'en-US,en;q=0.8',
				'Accept-Charset' => 'ISO-8859-1,utf-8;q=0.7,*;q=0.3',
			);

			$options = array(
				CURLOPT_SSL_VERIFYPEER =>  FALSE,
				CURLOPT_RETURNTRANSFER =>  TRUE,
				CURLOPT_HTTPHEADER =>  $headers,
				CURLOPT_AUTOREFERER =>  TRUE,
				CURLOPT_FOLLOWLOCATION =>  TRUE,
				CURLOPT_COOKIEJAR =>  'cookies.txt',
				CURLOPT_COOKIEFILE =>  'cookies.txt',
				CURLOPT_MAXREDIRS =>  5
			);

			$this->mcurl->add_call("get", "http://icecat.biz/index.cgi?search=1;language=en;search=1;start_row=1550;", array(), $options);

			$this->more = FALSE;
		}
	}

}

?>
