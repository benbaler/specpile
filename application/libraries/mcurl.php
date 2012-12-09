<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Copyright (C) 2011 by Chad Hutchins
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 * */


/**
 * CodeIgniter MCurl Class
 *
 * Work with remote servers via multi-cURL much easier than using the native PHP bindings.
 *
 * @package   CodeIgniter
 * @subpackage  Libraries
 * @category  Libraries
 * @author   Chad Hutchins
 * @link   http://github.com/chadhutchins/codeigniter-mcurl
 */
class Mcurl {

	private $_ci;    // CodeIgniter instance
	private $calls = array(); // multidimensional array that holds individual calls and data
	private $curl_parent;  // the curl multi handle resource
	private $active;  // number of active curl handles

	function __construct() {
		$this->_ci = & get_instance();
		log_message('debug', 'Mcurl Class Initialized');

		if (!$this->is_enabled()) {
			log_message('error', 'Mcurl Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.');
		}
		else {
			$this->curl_parent = curl_multi_init();
		}
	}

	// check to see if necessary function exists
	function is_enabled() {
		return function_exists('curl_multi_init');
	}

	// method to add curl requests to the multi request queue
	function add_call(/*$key=null, */$method, $url, $params = array(), $options = array()) {
		// if (is_null($key)) {
		// 	$key = count($this->calls);
		// }

		// check to see if the multi handle has been closed
		// init the multi handle again
		$resource_type = get_resource_type($this->curl_parent);
		if (!$resource_type || $resource_type == 'Unknown') {
			$this->calls = array();
			$this->curl_parent = curl_multi_init();
		}

		$init = curl_init();
		$key = $this->resource($init);
		
		$this->calls [$key]= array(
			"method" => $method,
			"url" => $url,
			"params" => $params,
			"options" => $options,
			"curl" => $init,
			"response" => null,
			"error" => null
		);

		echo $key.' start<br/>';

		// If its an array (instead of a query string) then format it correctly
		if (is_array($params)) {
			$params = http_build_query($params, NULL, '&');
		}

		$method = strtoupper($method);

		// only supports get/post requests
		// set some special curl opts for each type of request
		switch ($method) {
		case "POST":
			curl_setopt($this->calls[$key]["curl"], CURLOPT_URL, $url);
			curl_setopt($this->calls[$key]["curl"], CURLOPT_POST, TRUE);
			curl_setopt($this->calls[$key]["curl"], CURLOPT_POSTFIELDS, $params);
			break;

		case "GET":
			curl_setopt($this->calls[$key]["curl"], CURLOPT_URL, $url."?".$params);
			break;

		default:
			log_message('error', 'Mcurl Class - Provided http method is not supported. Only POST and GET are currently supported.');
			break;
		}

		curl_setopt($this->calls[$key]["curl"], CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($this->calls[$key]["curl"], CURLOPT_FOLLOWLOCATION, TRUE);

		curl_setopt_array($this->calls[$key]["curl"], $options);

		curl_multi_add_handle($this->curl_parent, $this->calls[$key]["curl"]);

		return $key;
	}

	// run the calls in the curl requests in $this->calls
	function execute($callback=null) {
		if (count($this->calls)) {
			// kick off the requests
			//
			//
			//

			$active = null;
			//execute the handles
			//
        do{ 
                curl_multi_exec($this->curl_parent,$active); 
                if (!is_null($callback)) {
								$info = curl_multi_info_read($this->curl_parent);
								if($info['msg'] == CURLMSG_DONE){
								$key = $this->resource($info['handle']);
								echo $key.' finish<br/>';
								$error = curl_error($this->calls[$key]["curl"]);
								if (!empty($error)) {
									$this->calls[$key]["error"] = $error;
								}
								$this->calls[$key]["response"] = curl_multi_getcontent($this->calls[$key]["curl"]);
								curl_multi_remove_handle($this->curl_parent, $this->calls[$key]["curl"]);
								call_user_func_array($callback, array('key' => $key, 'call' => $this->calls[$key]));
							}
							usleep(100);
						}
        }while($active > 0); 

			// do {
			// 	$mrc = curl_multi_exec($this->curl_parent, $active);
			// 	$this->active = $active;
			// } while ($mrc == CURLM_CALL_MULTI_PERFORM);

			// while ($active && $mrc == CURLM_OK) {
			// 	if (curl_multi_select($this->curl_parent) != -1) {
			// 		do {
			// 			$mrc = curl_multi_exec($this->curl_parent, $active);
			// 			if ($active < $this->active) {
			// 				$this->active = $active;
			// 				if (!is_null($callback)) {
			// 					$info = curl_multi_info_read($this->curl_parent);
			// 					$key = $this->resource($info['handle']);
			// 					echo $key.' finish<br/>';
			// 					$error = curl_error($this->calls[$key]["curl"]);
			// 					if (!empty($error)) {
			// 						$this->calls[$key]["error"] = $error;
			// 					}
			// 					$this->calls[$key]["response"] = curl_multi_getcontent($this->calls[$key]["curl"]);
			// 					curl_multi_remove_handle($this->curl_parent, $this->calls[$key]["curl"]);
			// 					call_user_func_array($callback, array('key' => $key, 'call' => $this->calls[$key]));
			// 				}
			// 			}
			// 		} while ($mrc == CURLM_CALL_MULTI_PERFORM);
			// 	}
			// }


			// do {
			//  $multi_exec_handle = curl_multi_exec($this->curl_parent, $active);
			// } while ($active>0);

			// after all requests finish, set errors and repsonses in $this->calls
			// foreach ($this->calls as $key => $call) {
			// 	$error = curl_error($this->calls[$key]["curl"]);
			// 	if (!empty($error)) {
			// 		$this->calls[$key]["error"] = $error;
			// 	}
			// 	$this->calls[$key]["response"] = curl_multi_getcontent($this->calls[$key]["curl"]);
			// 	curl_multi_remove_handle($this->curl_parent, $this->calls[$key]["curl"]);
			// }

			curl_multi_close($this->curl_parent);
		}

		//return $this->calls;
	}

	function debug() {
		echo "<h2>mcurl debug</h2>";
		foreach ($this->calls as $call) {
			echo '<p>url: <b>'.$call["url"].'</b></p>';
			if (!is_null($call["error"])) {
				echo '<p style="color:red;">error: <b>'.$call["error"].'</b></p>';
			}
			echo '<textarea cols="100" rows="10">'.htmlentities($call["response"])."</textarea><hr>";
		}
	}

	function handle($info) {
		if ($info['msg'] == CURLMSG_DONE && $info['result'] == CURLE_OK) {
			return $this->resource($info['handle']);
		}
		return FALSE;
	}

	function resource($handle){
		preg_match('/[0-9]+/', (string)$handle, $matches);
		return $matches[0];
	}

}

/* End of file mcurl.php */
/* Location: ./application/libraries/mcurl.php */
