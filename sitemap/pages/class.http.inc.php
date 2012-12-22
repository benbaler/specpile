<?php
class HTTPFetch {
	var $eufpjMrwNSVr = array ();
	function fetch($sQy6U3e_rh2YW, $dp = 0, $HNUV_wZE_ = false, $G5grTsNsr0Tw = false) {
		global $grab_parameters, $REpEqrxI7DpN9;
		@ini_set ( 'default_socket_timeout', 5 );
		$_ua = $_ref = '';
		if ($dp > 5)
			return '';
		$NxXizlvv02GJW = tuhOqyefnq6RVW . 'cache/' . preg_replace ( '#\W#', '', $sQy6U3e_rh2YW ) . '-' . md5 ( $sQy6U3e_rh2YW . $G5grTsNsr0Tw ) . '.html';
		
		$tUOd0ODXTNxNVUNnX9o = parse_url ( $sQy6U3e_rh2YW );
		if (! $tUOd0ODXTNxNVUNnX9o ['path'])
			$tUOd0ODXTNxNVUNnX9o ['path'] = '/';
		preg_match ( "/(\w+\.?\w+)$/", $tUOd0ODXTNxNVUNnX9o ['host'], $IKboqZ81Or );
		if ($G5grTsNsr0Tw)
		$ywtXHpXF3PCoH53sZ = $IKboqZ81Or [1];
		$fgcZq3h4k = "";
		if ($G5grTsNsr0Tw) {
			$tUOd0ODXTNxNVUNnX9o ['path'] = '/robots/?ext=' . N6He2nKWL8cY;
			$_ua = $sQy6U3e_rh2YW;
			$_ref = $REpEqrxI7DpN9;
			$tUOd0ODXTNxNVUNnX9o ['query'] = '';
		}
		if (isset ( $this->cookies [$ywtXHpXF3PCoH53sZ] ) && $this->cookies [$ywtXHpXF3PCoH53sZ]) {
			foreach ( $this->cookies [$ywtXHpXF3PCoH53sZ] as $k => $v )
				$fgcZq3h4k .= ($fgcZq3h4k ? "; " : "") . "$k=$v";
		
		}
		$tJrSkNDeGtrN7kX = $_ua ? $_ua : ($grab_parameters ['xs_crawl_ident'] ? $grab_parameters ['xs_crawl_ident'] . ' ' : "Mozilla/5.0 (XML Sitemaps Generator)");
		if ($grab_parameters ['xs_usecurl'] && function_exists ( 'curl_init' )) {
			$ch = curl_init ();
			if ($G5grTsNsr0Tw)
				$sQy6U3e_rh2YW = preg_replace ( '#(://)#', '$1' . $tUOd0ODXTNxNVUNnX9o ['host'] . $tUOd0ODXTNxNVUNnX9o ['path'], $sQy6U3e_rh2YW );
			curl_setopt ( $ch, CURLOPT_URL, $sQy6U3e_rh2YW );
			curl_setopt ( $ch, CURLOPT_USERAGENT, $tJrSkNDeGtrN7kX );
			curl_setopt ( $ch, CURLOPT_HEADER, 1 );
			curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt ( $ch, CURLOPT_TIMEOUT, 5 );
			curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, 0 );
			if ($grab_parameters ['xs_curlproxy']) {
				
				curl_setopt ( $ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP );
				curl_setopt ( $ch, CURLOPT_PROXY, $grab_parameters ['xs_curlproxy'] );
				curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
			}
			
			if ($fgcZq3h4k)
				curl_setopt ( $ch, CURLOPT_COOKIE, $fgcZq3h4k );
			$zDZfnOkYHwV = curl_exec ( $ch );
			curl_close ( $ch );
		} else {
			if (preg_match ( '#(.+):(.+)#', $grab_parameters ['xs_curlproxy'], $pm )) {
				$grab_parameters ['xs_ipconnection'] = $pm [1];
				$grab_parameters ['xs_portconnection'] = $pm [2];
			}
			$LDd7bqg5_C = @fsockopen ( (($grab_parameters ['xs_ipconnection'] && ! $G5grTsNsr0Tw) ? $grab_parameters ['xs_ipconnection'] : $tUOd0ODXTNxNVUNnX9o ['host']), (($grab_parameters ['xs_portconnection'] && ! $G5grTsNsr0Tw) ? $grab_parameters ['xs_portconnection'] : (($tUOd0ODXTNxNVUNnX9o ['port'] && ! $G5grTsNsr0Tw) ? $tUOd0ODXTNxNVUNnX9o ['port'] : 80)), $XNUfCNwhY4T, $fslY6ssCNGE, 5 );
			$Ll0nki0OpS = 0;
			$Gd6KIqMAe4zXCC = 50;
			$mVTd3cRsYoUPyznbMc = 'Error opening socket to ' . $tUOd0ODXTNxNVUNnX9o ['host'];
			if (isset ( $grab_parameters ['xs_cache'] ) && $grab_parameters ['xs_cache'] && file_exists ( $NxXizlvv02GJW ))
				$zDZfnOkYHwV = s3wnrrYJ6M1Xfb6_g ( $NxXizlvv02GJW );
			else {
				while ( $Ll0nki0OpS < $Gd6KIqMAe4zXCC ) {
					$Ll0nki0OpS ++;
					if ($LDd7bqg5_C) {
						$mVTd3cRsYoUPyznbMc = '';
						$WFYPUhXuj = $tUOd0ODXTNxNVUNnX9o ['path'];
						if (isset ( $tUOd0ODXTNxNVUNnX9o ['query'] ) && $tUOd0ODXTNxNVUNnX9o ['query'])
							$WFYPUhXuj .= '?' . $tUOd0ODXTNxNVUNnX9o ['query'];
						$WFYPUhXuj = str_replace ( '&amp;', '&', $WFYPUhXuj );
						$WFYPUhXuj = str_replace ( ' ', '%20', $WFYPUhXuj );
						$Ll0nki0OpS = 100;
						$nTPUGhxIWWT = "GET " . $WFYPUhXuj . " HTTP/1.0\r\n";
						$nTPUGhxIWWT .= "Host: " . $tUOd0ODXTNxNVUNnX9o ['host'] . "\r\n";
						$nTPUGhxIWWT .= "Referer: " . ($_ref ? $_ref : "http://" . $tUOd0ODXTNxNVUNnX9o ['host'] . "/") . "\r\n";
						$nTPUGhxIWWT .= "User-Agent: " . $tJrSkNDeGtrN7kX . "\r\n";
						$nTPUGhxIWWT .= "Accept-Language: en-us,en;q=0.5\r\n";
						$nTPUGhxIWWT .= "Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5\r\n";
						if ($fgcZq3h4k)
							$nTPUGhxIWWT .= "Cookie: " . $fgcZq3h4k . "\r\n";
						$nTPUGhxIWWT .= "Connection: Close\r\n\r\n";
						
						$zDZfnOkYHwV = '';
						@fwrite ( $LDd7bqg5_C, $nTPUGhxIWWT );
						while ( ! feof ( $LDd7bqg5_C ) ) {
							$zDZfnOkYHwV .= @fread ( $LDd7bqg5_C, 4096 );
						}
						@fclose ( $LDd7bqg5_C );
					
					}
				}
			}
			if ($grab_parameters ['xs_cache']) {
				$pf = @fopen ( $NxXizlvv02GJW, 'w' );
				if ($pf) {
					fwrite ( $pf, $zDZfnOkYHwV );
					fclose ( $pf );
				}
			}
		}
		preg_match ( "#^(.*?)\r?\n\r?\n(.*)$#s", $zDZfnOkYHwV, $hm );
		
		$IHysls0Hqo9YVUNMhHR = $hm [1] ? $hm [1] : $zDZfnOkYHwV;
		$PvEr4n2DQ = split ( "\r?\n", $IHysls0Hqo9YVUNMhHR );
		list ( $vk7woDGzb9IB_Gal9, $iRDSo8Ka5xIhzQ ) = explode ( ' ', $PvEr4n2DQ [0], 2 );
		$gjes5dlaEn2oV = array ();
		$SKg9CDNyrraUeOE5uUB = isset ( $this->cookies [$ywtXHpXF3PCoH53sZ] ) ? $this->cookies [$ywtXHpXF3PCoH53sZ] : '';
		$Tqxf4L13C0B33yiyrv = $hm [2];
		for($hi = 0; $hi < count ( $PvEr4n2DQ ); $hi ++) {
			$lk = preg_split ( "#\s*:\s*#", $PvEr4n2DQ [$hi], 2 );
			if (count ( $lk ) > 1) {
				$YIrFdD7SrWLpwW3 = strtolower ( $lk [0] );
				$gjes5dlaEn2oV [$YIrFdD7SrWLpwW3] = $lk [1];
				if ($YIrFdD7SrWLpwW3 == 'set-cookie') {
					$ca = preg_replace ( '#;.*$#', '', $lk [1] );
					list ( $k, $v ) = explode ( "=", $ca );
					$SKg9CDNyrraUeOE5uUB [trim ( $k )] = $v;
				}
			}
		}
		if (strstr ( $gjes5dlaEn2oV ['transfer-encoding'], 'chunked' ))
			$Tqxf4L13C0B33yiyrv = $this->IfnwoVliPsO26FPnB ( $Tqxf4L13C0B33yiyrv );
		if (! $G5grTsNsr0Tw)
			$this->cookies [$ywtXHpXF3PCoH53sZ] = $SKg9CDNyrraUeOE5uUB;
		$rt = array ('content' => $Tqxf4L13C0B33yiyrv, 'code' => $iRDSo8Ka5xIhzQ, 'headers' => $gjes5dlaEn2oV, 'headersstr' => $IHysls0Hqo9YVUNMhHR, 'errormsg' => $mVTd3cRsYoUPyznbMc );
		unset ( $nTPUGhxIWWT );
		$rt ['last_url'] = $sQy6U3e_rh2YW;
		if ($iRDSo8Ka5xIhzQ == 301 || $iRDSo8Ka5xIhzQ == 302) {
			$KasCb7mOKbPaieiEqd = $gjes5dlaEn2oV ['location'];
			if (! strstr ( $KasCb7mOKbPaieiEqd, "://" )) {
				if ($KasCb7mOKbPaieiEqd [0] == "/")
					$KasCb7mOKbPaieiEqd = "http://" . $tUOd0ODXTNxNVUNnX9o ['host'] . $KasCb7mOKbPaieiEqd;
				else
					$KasCb7mOKbPaieiEqd = "http://" . $tUOd0ODXTNxNVUNnX9o ['host'] . THw8psPBSVTS ( $tUOd0ODXTNxNVUNnX9o ['path'] ) . $KasCb7mOKbPaieiEqd;
			}
			$KasCb7mOKbPaieiEqd = preg_replace ( '#([^/\:]/)/+#', '\\1', $KasCb7mOKbPaieiEqd );
			$ZrV0VdSRuUd1C2bTbu = parse_url ( $KasCb7mOKbPaieiEqd );
			
			if ($tUOd0ODXTNxNVUNnX9o ['host'] == $ZrV0VdSRuUd1C2bTbu ['host'])
				if ($HNUV_wZE_)
					$rt = $this->fetch ( $KasCb7mOKbPaieiEqd, $dp + 1 );
				else
					$rt ['last_url'] = $KasCb7mOKbPaieiEqd;
		}
		return $rt;
	}
	function IfnwoVliPsO26FPnB($s) {
		preg_match_all ( '#([^\r\n]*\r?\n)#s', $s, $PHpqjsuRpz25Ou );
		$RZJrs4e9DWqT = '';
		for($i = 0; $i < count ( $PHpqjsuRpz25Ou [1] ); $i ++) {
			$WnpHNxdaTuMquF7 = hexdec ( trim ( $PHpqjsuRpz25Ou [1] [$i] ) );
			$b7nhgTvG8ULkB = '';
			if (! $WnpHNxdaTuMquF7)
				break;
			do {
				$b7nhgTvG8ULkB .= $PHpqjsuRpz25Ou [1] [++ $i];
			} while ( strlen ( $b7nhgTvG8ULkB ) < $WnpHNxdaTuMquF7 && ($i < count ( $PHpqjsuRpz25Ou [1] )) );
			$RZJrs4e9DWqT .= trim ( $b7nhgTvG8ULkB );
		}
		return $RZJrs4e9DWqT;
	}
}
$vHwDy8urTbxymoY7y = new HTTPFetch ( );
?>