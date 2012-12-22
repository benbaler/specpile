<?php
class SiteCrawler {
	function ANwqywRuJwV($r2uxsHQ7o, &$urls_completed) {
		global $grab_parameters, $vHwDy8urTbxymoY7y;
		
		error_reporting ( E_ALL & ~ E_NOTICE );
		set_time_limit ( $grab_parameters ['xs_exec_time'] );
		if ($r2uxsHQ7o ['bgexec']) {
			ignore_user_abort ( true );
		}
		register_shutdown_function ( 'lG49emKQ8V' );
		$yMBs2OPLVVuAK = explode ( " ", microtime () );
		$TdLyzkK8x3Qv23IEX = $yMBs2OPLVVuAK [0] + $yMBs2OPLVVuAK [1];
		$aRjeSjk24 = $r2uxsHQ7o ['initurl'];
		$VTQP1ue8oY1PvdK = $r2uxsHQ7o ['maxpg'] > 0 ? $r2uxsHQ7o ['maxpg'] : 1E10;
		$RXZaXpOvdbjwY = $r2uxsHQ7o ['maxdepth'] ? $r2uxsHQ7o ['maxdepth'] : - 1;
		$LBgEBgVZ4z = $r2uxsHQ7o ['progress_callback'];
		$hRkxxxwtG = preg_replace ( "#\s*[\r\n]+\s*#", '|', (strstr ( $s = trim ( $grab_parameters ['xs_excl_urls'] ), '*' ) ? $s : preg_quote ( $s, '#' )) );
		$A9WzwJYtTB0O3GkI69 = preg_replace ( "#\s*[\r\n]+\s*#", '|', (strstr ( $s = trim ( $grab_parameters ['xs_incl_urls'] ), '*' ) ? $s : preg_quote ( $s, '#' )) );
		$nNMzp2IgH7HiM = $aHYbmExGS2Xg9WZI = array ();
		$AUsclCf2r5Z = preg_split ( '#[\r\n]+#', $grab_parameters ['xs_ind_attr'] );
		$pTRcWpFjH8WqYG74 = '#200' . ($r2uxsHQ7o ['xs_allow_httpcode'] ? '|' . $r2uxsHQ7o ['xs_allow_httpcode'] : '') . '#';
		foreach ( $AUsclCf2r5Z as $ia )
			if ($ia) {
				$is = explode ( ',', $ia );
				if ($is [0] [0] == '$')
					$k2mbaYG7Adhhp0nn = substr ( $is [0], 1 );
				else
					$k2mbaYG7Adhhp0nn = str_replace ( '\\$', '$', preg_quote ( $is [0], '#' ) );
				$aHYbmExGS2Xg9WZI [] = $k2mbaYG7Adhhp0nn;
				$nNMzp2IgH7HiM [str_replace ( '$', '', $is [0] )] = array ('lm' => $is [1], 'f' => $is [2], 'p' => $is [3] );
			}
		if ($aHYbmExGS2Xg9WZI)
			$AdSeH3KPw4 = implode ( '|', $aHYbmExGS2Xg9WZI );
		$LcIWmtRK09YCyYKIu = parse_url ( $aRjeSjk24 );
		if (! $LcIWmtRK09YCyYKIu ['path']) {
			$aRjeSjk24 .= '/';
			$LcIWmtRK09YCyYKIu = parse_url ( $aRjeSjk24 );
		}
		$G99nA35xjYQh = $vHwDy8urTbxymoY7y->fetch ( $aRjeSjk24, 0, true ); // the first request is to skip session id
		$G99nA35xjYQh = $vHwDy8urTbxymoY7y->fetch ( $aRjeSjk24, 0, true );
		if (! preg_match ( $pTRcWpFjH8WqYG74, $G99nA35xjYQh ['code'] ))
			return array ('errmsg' => '<b>There was an error while retrieving the URL specified:</b> ' . $aRjeSjk24 . '' . ($G99nA35xjYQh ['errormsg'] ? '<br><b>Error message:</b> ' . $G99nA35xjYQh ['errormsg'] : '') . '<br><b>HTTP headers follow:</b><br>' . $G99nA35xjYQh ['headersstr'] . '<br><b>HTTP output:</b><br>' . $G99nA35xjYQh ['content'] );
		$aRjeSjk24 = $G99nA35xjYQh ['last_url'];
		$urls_completed = array ();
		$urls_404 = array ();
		$FE4j24hlEn8 = $LcIWmtRK09YCyYKIu ['scheme'] . '://' . $LcIWmtRK09YCyYKIu ['host'] . ((! $LcIWmtRK09YCyYKIu ['port'] || ($LcIWmtRK09YCyYKIu ['port'] == '80')) ? '' : (':' . $LcIWmtRK09YCyYKIu ['port']));
		$pn = $tsize = 0;
		$nBJII2x1AG_zc = preg_replace ( '#([^/\:]/)/+#', '\\1', $FE4j24hlEn8 . '/' . THw8psPBSVTS ( $LcIWmtRK09YCyYKIu ['path'] ) );
		$vZKpEamsDiBU = preg_replace ( '#^.+://[^/]+#', '', $nBJII2x1AG_zc );
		$fTr9xtaaPTXU = $vHwDy8urTbxymoY7y->fetch ( $aRjeSjk24, 0, true, true );
		$NXm2oclRZ5XZH = str_replace ( $nBJII2x1AG_zc, '', $aRjeSjk24 );
		$urls_list_full = array ($NXm2oclRZ5XZH );
		if (! $NXm2oclRZ5XZH)
			$NXm2oclRZ5XZH = '/';
		$urls_list = array ($NXm2oclRZ5XZH );
		$urls_list2 = array ();
		$t7fVZsI8scAQ = array ();
		$links_level = 0;
		$UGhOmnuNjG2fj = $ref_links = $ref_links2 = array ();
		$Jh02oPSmnHw = 0;
		$HknvIMZfUroGmi3 = $VTQP1ue8oY1PvdK;
		if (isset ( $grab_parameters ['xs_robotstxt'] ) && $grab_parameters ['xs_robotstxt']) {
			$oDpbA930JAaWHLhY = $vHwDy8urTbxymoY7y->fetch ( $FE4j24hlEn8 . '/robots.txt' );
			if ($FE4j24hlEn8 . '/' != $nBJII2x1AG_zc) {
				$wC_wuheBcmck1kAj4J = "\n" . $vHwDy8urTbxymoY7y->fetch ( $nBJII2x1AG_zc . 'robots.txt' );
				$oDpbA930JAaWHLhY ['content'] .= "\n" . $wC_wuheBcmck1kAj4J ['content'];
			}
			$ra = preg_split ( '#user-agent:\s*#im', $oDpbA930JAaWHLhY ['content'] );
			$n1xLFyVmobkiwwn = array ();
			for($i = 1; $i < count ( $ra ); $i ++) {
				preg_match ( '#^(\S+)(.*)$#s', $ra [$i], $UIPYmw0UFeGY );
				if ($UIPYmw0UFeGY [1] == '*' || strstr ( $UIPYmw0UFeGY [1], 'google' )) {
					preg_match_all ( '#^disallow:\s*(\S*)#im', $UIPYmw0UFeGY [2], $rm );
					for($pi = 0; $pi < count ( $rm [1] ); $pi ++)
						if ($rm [1] [$pi])
							$n1xLFyVmobkiwwn [] = preg_quote ( $rm [1] [$pi], '#' );
				}
			}
			$Wgni4L7FPJT4Beo7d = implode ( '|', $n1xLFyVmobkiwwn );
		} else
			$Wgni4L7FPJT4Beo7d = '';
		$lqQshuQq_Yx_SG = $grab_parameters ['xs_exc_skip'] != '\\.()';
		$Jqivy4YQhay18 = $grab_parameters ['xs_inc_skip'] != '\\.()';
		$grab_parameters ['xs_inc_skip'] .= '$';
		$grab_parameters ['xs_exc_skip'] .= '$';
		$av2KTAsuDctU = 0;
		$url_ind = 0;
		$cnu = 1;
		$pf = fopen ( tuhOqyefnq6RVW . TpMaRXMDxB2, 'w' );
		fclose ( $pf );
		if ($r2uxsHQ7o ['resume'] != '') {
			$h0KbcjRKxhS_ = @twb3vL6xHv65 ( s3wnrrYJ6M1Xfb6_g ( tuhOqyefnq6RVW . fLu000jqfwiRF ) );
			echo 'Resuming the last session (last updated: ' . date ( 'Y-m-d H:i:s', $h0KbcjRKxhS_ ['time'] ) . ')';
			if ($h0KbcjRKxhS_)
				extract ( $h0KbcjRKxhS_ );
			$TdLyzkK8x3Qv23IEX -= $ctime;
			$av2KTAsuDctU = $ctime;
			unset ( $h0KbcjRKxhS_ );
		}
		sleep ( 1 );
		@unlink ( tuhOqyefnq6RVW . TpMaRXMDxB2 );
		do {
			$yCwTqe5GDcta = $urls_list [$url_ind ++];
			$G99nA35xjYQh = array ();
			$cn = '';
			if (isset ( $t7fVZsI8scAQ [$yCwTqe5GDcta] ))
				$yCwTqe5GDcta = $t7fVZsI8scAQ [$yCwTqe5GDcta];
			$f = $lqQshuQq_Yx_SG && preg_match ( '#' . $grab_parameters ['xs_exc_skip'] . '#i', $yCwTqe5GDcta );
			if ($hRkxxxwtG && ! $f)
				$f = $f || preg_match ( '#(' . $hRkxxxwtG . ')#', $yCwTqe5GDcta );
			if ($Wgni4L7FPJT4Beo7d && ! $f)
				$f = $f || preg_match ( '#(' . $Wgni4L7FPJT4Beo7d . ')#', $vZKpEamsDiBU . $yCwTqe5GDcta );
			$f2 = false;
			if (! $f) {
				$f2 = $Jqivy4YQhay18 && preg_match ( '#' . $grab_parameters ['xs_inc_skip'] . '#', $yCwTqe5GDcta );
				if ($A9WzwJYtTB0O3GkI69 && ! $f2)
					$f2 = $f2 || (preg_match ( '#(' . $A9WzwJYtTB0O3GkI69 . ')#', $yCwTqe5GDcta ));
			}
			do {
				if (! $f && ! $f2) { // && ($HknvIMZfUroGmi3>(count($urls_list)-$url_ind))){
					if ($RXZaXpOvdbjwY <= 0 || $links_level < $RXZaXpOvdbjwY) {
						$FRy4YMXr_PT = preg_replace ( '#([^/\:]/)/+#', '\\1', $nBJII2x1AG_zc . $yCwTqe5GDcta );
						
						if ($_GET ['ddbg'])
							echo "<h4> { $FRy4YMXr_PT } </h4>";
						flush ();
						$C8YeeJvXHpz7ff = 0;
						do {
							$G99nA35xjYQh = $vHwDy8urTbxymoY7y->fetch ( $FRy4YMXr_PT, 0, 1 );
							if ($G99nA35xjYQh ['code'] == 403) {
								$C8YeeJvXHpz7ff ++;
								sleep ( $grab_parameters ['xs_delay_ms'] ? $grab_parameters ['xs_delay_ms'] : 1 );
							} else
								$C8YeeJvXHpz7ff = 5;
						} while ( $C8YeeJvXHpz7ff < 3 );
						
						$S8whnPM_47w7 = strtolower ( $G99nA35xjYQh ['headers'] ['content-type'] );
						if (! strstr ( $S8whnPM_47w7, 'text/html' ) && ! strstr ( $S8whnPM_47w7, '/xhtml' ))
							continue;
						$hE3J3lTm1xrJcz5CHD = array ();
						if ($G99nA35xjYQh ['code'] == 404) {
							$urls_404 [] = array ($yCwTqe5GDcta, $ref_links2 [$yCwTqe5GDcta] );
							continue;
						}
						if ($FRy4YMXr_PT != $G99nA35xjYQh ['last_url']) {
							$t7fVZsI8scAQ [$yCwTqe5GDcta] = $G99nA35xjYQh ['last_url'];
							$io = $yCwTqe5GDcta;
							$ggrLEJRK1lNl = preg_replace ( '#^.*?' . preg_quote ( $nBJII2x1AG_zc, '#' ) . '#', '', $G99nA35xjYQh ['last_url'] );
							$urls_list2 [] = $ggrLEJRK1lNl;
							$ref_links [$ggrLEJRK1lNl] = $yCwTqe5GDcta;
							continue;
						}
						if (! preg_match ( $pTRcWpFjH8WqYG74, $G99nA35xjYQh ['code'] ))
							continue;
						$cn = $G99nA35xjYQh ['content'];
						
						$tsize += strlen ( $cn );
						$cn = preg_replace ( '#<!--.*?-->#is', '', $cn );
						preg_match ( '#<base[^>]*?href=[\'"](.*?)[\'"]#is', $cn, $bm );
						if (isset ( $bm [1] ) && $bm [1])
							$YD8Ku5kCxh9EuzlBTRB = THw8psPBSVTS ( $bm [1] . '/' );
						else
							$YD8Ku5kCxh9EuzlBTRB = THw8psPBSVTS ( $nBJII2x1AG_zc . $yCwTqe5GDcta );
						
						preg_match_all ( '#<a(?:rea)?\s[^>]*href\s*=\s*(?:"([^"]*)|\'([^\']*)|([^\s\">]+)).*?>#is', $cn, $am );
						preg_match_all ( '#<i?frame\s[^>]*src\s*=\s*["\']?(.*?)("|>|\'[>\s])#is', $cn, $aODzvLGsrOWa5fBIlnt );
						preg_match_all ( '#<meta\s[^>]*http-equiv\s*=\s*"?refresh[^>]*URL\s*=\s*["\']?(.*?)("|>|\'[>\s])#is', $cn, $VLTQ71VfTeTUARqPl );
						$hE3J3lTm1xrJcz5CHD = array ();
						for($i = 0; $i < count ( $am [1] ); $i ++) {
							if (! preg_match ( '#rel=["\']nofollow#i', $am [0] [$i] ))
								$hE3J3lTm1xrJcz5CHD [] = $am [1] [$i];
						}
						$hE3J3lTm1xrJcz5CHD = array_merge ( $hE3J3lTm1xrJcz5CHD, 

						$am [2], $am [3], $aODzvLGsrOWa5fBIlnt [1], $VLTQ71VfTeTUARqPl [1] );
						$hE3J3lTm1xrJcz5CHD = array_unique ( $hE3J3lTm1xrJcz5CHD );
						
						$nn = $nt = 0;
						reset ( $hE3J3lTm1xrJcz5CHD );
						if (preg_match ( '#<meta name="robots" content="[^"]*?nofollow#is', $cn ))
							$hE3J3lTm1xrJcz5CHD = array ();
						foreach ( $hE3J3lTm1xrJcz5CHD as $i => $ll )
							if ($ll) {
								$a = $sa = trim ( $ll );
								if ($grab_parameters ['xs_proto_skip'] && (preg_match ( '#^' . $grab_parameters ['xs_proto_skip'] . '#i', $a ) || ($lqQshuQq_Yx_SG && preg_match ( '#' . $grab_parameters ['xs_exc_skip'] . '#i', $a )) || preg_match ( '#^' . $grab_parameters ['xs_proto_skip'] . '#i', function_exists ( 'html_entity_decode' ) ? html_entity_decode ( $a ) : $a )))
									continue;
								if ($grab_parameters ['xs_exclude_check']) {
									$_f = $_f2 = false;
									$_f = $hRkxxxwtG && preg_match ( '#(' . $hRkxxxwtG . ')#', $a );
									if ($Wgni4L7FPJT4Beo7d && ! $_f)
										$_f = preg_match ( '#(' . $Wgni4L7FPJT4Beo7d . ')#', $vZKpEamsDiBU . $a );
									
									if ($_f)
										continue;
								}
								
								if (preg_match ( '#https?(:|&\#58;)#is', $a ))
									;
								else if ($a && $a [0] == '/')
									$a = $FE4j24hlEn8 . $a;
								else
									$a = $YD8Ku5kCxh9EuzlBTRB . $a;
								$a = str_replace ( '/./', '/', $a );
								if (strstr ( $a, '../' )) {
									preg_match ( '#(.*?:.*?//.*?)(/.*)$#', $a, $aa );
									do {
										$ap = $aa [2];
										$aa [2] = preg_replace ( '#/?[^/]*/\.\.#', '', $ap, 1 );
									} while ( $aa [2] != $ap );
									$a = $aa [1] . $aa [2];
								}
								$a = preg_replace ( '#/\./#', '/', $a );
								$a = str_replace ( '&#38;', '&', $a );
								$a = str_replace ( '&amp;', '&', $a );
								$a = preg_replace ( '#\#.*$#', '', $a );
								$a = preg_replace ( '#([^/\:]/)/+#', '\\1', $a );
								$a = preg_replace ( '#[\r\n]+#s', '', $a );
								
								if (strtolower ( substr ( $a, 0, strlen ( $nBJII2x1AG_zc ) ) ) != strtolower ( $nBJII2x1AG_zc ))
									continue;
								
								$ggrLEJRK1lNl = substr ( $a, strlen ( $nBJII2x1AG_zc ) );
								if ($grab_parameters ['xs_cleanurls'])
									$ggrLEJRK1lNl = @preg_replace ( $grab_parameters ['xs_cleanurls'], '', $ggrLEJRK1lNl );
								if ($grab_parameters ['xs_cleanpar']) {
									$ggrLEJRK1lNl = @preg_replace ( '#[\\?\\&](' . $grab_parameters ['xs_cleanpar'] . ')=[a-z0-9]+$#i', '', $ggrLEJRK1lNl );
									$ggrLEJRK1lNl = @preg_replace ( '#([\\?\\&])(' . $grab_parameters ['xs_cleanpar'] . ')=[a-z0-9]+&#i', '$1', $ggrLEJRK1lNl );
								}
								$urls_list2 [] = $ggrLEJRK1lNl;
								$ref_links [$ggrLEJRK1lNl] = $yCwTqe5GDcta;
								$nt ++;
							}
						unset ( $hE3J3lTm1xrJcz5CHD );
					}
				}
				
				if ($grab_parameters ['xs_incl_only'] && ! $f)
					$f = $f || ! preg_match ( '#' . preg_quote ( $grab_parameters ['xs_incl_only'], '#' ) . '#', $nBJII2x1AG_zc . $yCwTqe5GDcta );
				if (! $f)
					$f = $f || preg_match ( '#<meta name="robots" content="[^"]*?noindex#is', $cn );
				if (! $f) {
					$NYySB95cXj2bdre = array (

					'link' => preg_replace ( '#([^/\:]/)/+#', '\\1', $nBJII2x1AG_zc . $yCwTqe5GDcta ) );
					if ($grab_parameters ['xs_makehtml']) {
						preg_match ( '#<title>(.*?)</title>#is', $G99nA35xjYQh ['content'], $EA_T0CYlIF6tb7UtP );
						$NYySB95cXj2bdre ['t'] = $EA_T0CYlIF6tb7UtP [1];
					}
					if ($grab_parameters ['xs_metadesc']) {
						preg_match ( '#<meta\s[^>]*(?:http-equiv|name)\s*=\s*"?description[^>]*content\s*=\s*["]?([^>\"]*)#is', $cn, $JcUJ6noUPUWESUgG );
						if ($JcUJ6noUPUWESUgG [1])
							$NYySB95cXj2bdre ['d'] = $JcUJ6noUPUWESUgG [1];
					}
					if ($grab_parameters ['xs_makeror'] || $grab_parameters ['xs_autopriority'])
						$NYySB95cXj2bdre ['o'] = max ( 0, $links_level );
					if (preg_match ( '#(' . $AdSeH3KPw4 . ')#', $nBJII2x1AG_zc . $yCwTqe5GDcta, $Ufz4hdNjXhLx60oBsLt )) {
						$NYySB95cXj2bdre ['clm'] = $nNMzp2IgH7HiM [$Ufz4hdNjXhLx60oBsLt [1]] ['lm'];
						$NYySB95cXj2bdre ['f'] = $nNMzp2IgH7HiM [$Ufz4hdNjXhLx60oBsLt [1]] ['f'];
						$NYySB95cXj2bdre ['p'] = $nNMzp2IgH7HiM [$Ufz4hdNjXhLx60oBsLt [1]] ['p'];
					}
					if (! $NYySB95cXj2bdre ['lm'] && isset ( $G99nA35xjYQh ['headers'] ['last-modified'] ))
						$NYySB95cXj2bdre ['lm'] = $G99nA35xjYQh ['headers'] ['last-modified'];
					
					$urls_completed [] = $NYySB95cXj2bdre;
					$HknvIMZfUroGmi3 = $VTQP1ue8oY1PvdK - count ( $urls_completed );
				}
			} while ( false ); // zerowhile
			if ($url_ind >= $cnu) {
				unset ( $urls_list );
				$url_ind = 0;
				$urls_list = array_values ( array_unique ( array_diff ( $urls_list2, $urls_list_full ) ) );
				$urls_list_full = array_merge ( $urls_list_full, $urls_list );
				$cnu = count ( $urls_list );
				unset ( $ref_links2 );
				$ref_links2 = $ref_links;
				unset ( $ref_links );
				unset ( $urls_list2 );
				$ref_links = array ();
				$urls_list2 = array ();
				$links_level ++;
			}
			$pn ++;
			$pl = min ( $cnu - $url_ind, $HknvIMZfUroGmi3 );
			if (($cnu == $url_ind || $pl == 0 || $pn == 1 || ($pn % 20) == 0) || count ( $urls_completed ) >= $VTQP1ue8oY1PvdK) {
				if (strstr ( $fTr9xtaaPTXU ['content'], 'header' ))
					break;
				$yMBs2OPLVVuAK = explode ( " ", microtime () );
				$ctime = $yMBs2OPLVVuAK [0] + $yMBs2OPLVVuAK [1] - $TdLyzkK8x3Qv23IEX;
				if (function_exists ( 'memory_get_usage' ))
					$mu = memory_get_usage ();
				else {
					
					$mu = '-';
				
				}
				if (intval ( $mu ))
					$mu = number_format ( $mu / 1024, 1 ) . ' Kb';
				$urls_list2 = array_values ( array_unique ( $urls_list2 ) );
				$QmKaHsN_mnHEfYSpTEg = array ($ctime, // running time
str_replace ( $aRjeSjk24, '', $yCwTqe5GDcta ), // current URL
$pl, // urls left
$pn, // processed urls
$tsize, // bandwidth usage
$links_level, // depth level
$mu, // memory usage
count ( $urls_completed ), // added in sitemap
count ( $urls_list2 ) )// in the queue
;
				if ($r2uxsHQ7o ['bgexec'])
					EpCvw2zEnDD ( B0tchSNt2Krkc, Zl5g2LLgy3 ( $QmKaHsN_mnHEfYSpTEg ) );
				if ($LBgEBgVZ4z && ! $f)
					$LBgEBgVZ4z ( $QmKaHsN_mnHEfYSpTEg );
			}
			if ($grab_parameters ['xs_savestate_time'] > 0 && (($ctime - $av2KTAsuDctU > $grab_parameters ['xs_savestate_time']) || ($url_ind >= $cnu))) {
				$av2KTAsuDctU = $ctime;
				$h0KbcjRKxhS_ = compact ( 'url_ind', 'urls_list', 'urls_list2', 'cnu', 'ref_links', 'ref_links2', 'urls_list_full', 'urls_completed', 'urls_404', 'nt', 'tsize', 'pn', 'links_level', 'ctime' );
				$h0KbcjRKxhS_ ['time'] = time ();
				$m51TO___YwFjZX = Zl5g2LLgy3 ( $h0KbcjRKxhS_ );
				EpCvw2zEnDD ( fLu000jqfwiRF, $m51TO___YwFjZX );
				unset ( $h0KbcjRKxhS_ );
				unset ( $m51TO___YwFjZX );
			
			}
			if ($grab_parameters ['xs_delay_req'] && $grab_parameters ['xs_delay_ms'] && (($pn % $grab_parameters ['xs_delay_req']) == 0)) {
				sleep ( $grab_parameters ['xs_delay_ms'] );
			}
			if ($O3uIJNRGDfO4xO0Zen = file_exists ( $uNFFhEr_Ldjz6gLuOb = tuhOqyefnq6RVW . TpMaRXMDxB2 )) {
				if (@unlink ( $uNFFhEr_Ldjz6gLuOb ))
					break;
				else
					$O3uIJNRGDfO4xO0Zen = 0;
			}
		} while ( count ( $urls_completed ) < $VTQP1ue8oY1PvdK && $url_ind < $cnu );
		if ($_GET ['ddbgexit'])
			exit ();
		
		return array ('u404' => $urls_404, 'ctime' => $ctime, 'tsize' => $tsize, 'errmsg' => '', 'initurl' => $aRjeSjk24, 'initdir' => $nBJII2x1AG_zc, 'ucount' => count ( $urls_completed ), 'time' => time (), 'params' => $r2uxsHQ7o, 'interrupt' => $O3uIJNRGDfO4xO0Zen );
	}
}
$pUvA4zhAkYZK2Nd8A = new SiteCrawler ( );
function lG49emKQ8V() {
	@unlink ( tuhOqyefnq6RVW . B0tchSNt2Krkc );
}
?>