<?php
if (! defined ( 'nfCUUd8A8V' )) {
	define ( 'nfCUUd8A8V', 1 );
	class rGJWR_guN {
		var $tplType = 'file';
		var $tplContent = '';
		var $tplTags = array ('tif', 'tvar', 'tloop', 'tinc', 'telse' );
		var $tagsList = array ();
		function rGJWR_guN($yQB8Ir7XAnsByr = '') {
			$this->contentTypes = array ();
			$this->varScope = array ();
			$this->tplPath = (dirname ( __FILE__ ) . '/../' . $yQB8Ir7XAnsByr);
			$this->ts = implode ( '|', $this->tplTags );
		}
		function bE03wJKFluEetHDrxE($wX3J29vlCRlFMhuQW) {
			$this->tplName = $wX3J29vlCRlFMhuQW;
		}
		function hwKdALVRpEm($PJcxuhwvrlD58h6ut3d, $Q5G8QmbQwJT3v) {
			$this->varScope [$PJcxuhwvrlD58h6ut3d] = $Q5G8QmbQwJT3v;
		}
		function AgDpNlHNiYDROjynEO($FA0UpNye2M37wP7LQ) {
			if ($FA0UpNye2M37wP7LQ)
				foreach ( $FA0UpNye2M37wP7LQ as $k => $v )
					$this->varScope [$k] = $v;
		}
		function wariOKKebDD($GO8TFrE_eI, &$tl) {
			while ( preg_match ( '#^(.*?)<(/?(?:' . $this->ts . '))\s*(.*?)>#is', $GO8TFrE_eI, $tm ) ) {
				$GO8TFrE_eI = substr ( $GO8TFrE_eI, strlen ( $tm [0] ) );
				$ta = array ('pre' => $tm [1], 'tag' => strtolower ( $tm [2] ), 'par' => $tm [3] );
				switch ($ta ['tag']) {
					case 'tif' :
					case 'tloop' :
						$GO8TFrE_eI = $this->wariOKKebDD ( $GO8TFrE_eI, $ta ['sub'] );
						break;
					case '/tif' :
					case '/tloop' :
						
						$tl [] = $ta;
						return $GO8TFrE_eI;
						break;
				}
				$tl [] = $ta;
			}
			$tl [count ( $tl ) - 1] ['post'] = $GO8TFrE_eI;
			return $GO8TFrE_eI;
		}
		function parse() {
			$DGsLKvCm27eV = implode ( "", file ( $this->tplPath . $this->tplName ) );
			$nTPUGhxIWWT = $this->iIsc9RqVvWVR29Tijqd ( $DGsLKvCm27eV );
			$nTPUGhxIWWT = preg_replace ( "#\s*[\r\n]\s+#s", "\n", $nTPUGhxIWWT );
			return $nTPUGhxIWWT;
		}
		function iIsc9RqVvWVR29Tijqd($Tqxf4L13C0B33yiyrv, $idrPGABfc4yuslY = 0) {
			if (! $idrPGABfc4yuslY)
				$idrPGABfc4yuslY = $this->varScope;
			$tagsList = array ();
			$this->wariOKKebDD ( $Tqxf4L13C0B33yiyrv, $tagsList );
			$nTPUGhxIWWT = $this->PAMsFEW9PB2RQoc3 ( $tagsList, $idrPGABfc4yuslY );
			return $nTPUGhxIWWT;
		}
		function sSxD4RNwg($Tqxf4L13C0B33yiyrv, $Svh23msVS3GSLdjIhq) {
			$this->varScope = null;
			$this->AgDpNlHNiYDROjynEO ( $Svh23msVS3GSLdjIhq );
			return $this->iIsc9RqVvWVR29Tijqd ( $Tqxf4L13C0B33yiyrv );
		}
		function PAMsFEW9PB2RQoc3($tl, $idrPGABfc4yuslY = 0, $dp = 0, $T9mnmC3k9eENcJDb44Q = true) {
			if (! $idrPGABfc4yuslY)
				$idrPGABfc4yuslY = $this->varScope;
			$Ebcaq_YCAyxUIB324G = $T9mnmC3k9eENcJDb44Q;
			$rt = '';
			if (is_array ( $tl ))
				foreach ( $tl as $i => $ta ) {
					$pr = $ta ['par'];
					if ($Ebcaq_YCAyxUIB324G) {
						$rt .= $ta ['pre'];
						switch ($ta ['tag']) {
							case 'tloop' :
								$t_LlD5p6PQKvgvIZpP9 = $idrPGABfc4yuslY [$pr];
								$v1 = $idrPGABfc4yuslY ['__index__'];
								$v2 = $idrPGABfc4yuslY ['__value__'];
								for($i = 0; $i < count ( $t_LlD5p6PQKvgvIZpP9 ); $i ++) {
									$idrPGABfc4yuslY ['__index__'] = $i + 1;
									$idrPGABfc4yuslY ['__value__'] = $t_LlD5p6PQKvgvIZpP9 [$i];
									if ($ta ['sub'])
										$rt .= $this->PAMsFEW9PB2RQoc3 ( $ta ['sub'], array_merge ( $idrPGABfc4yuslY, is_array ( $t_LlD5p6PQKvgvIZpP9 [$i] ) ? $t_LlD5p6PQKvgvIZpP9 [$i] : array () ), $dp + 1 );
								}
								$idrPGABfc4yuslY ['__index__'] = $v1;
								$idrPGABfc4yuslY ['__value__'] = $v2;
								$rt .= $ta ['post'];
								break;
							case 'tif' :
								$kxesmZvVXn = $OWNVYbuUt2KT49cveBR = 0;
								$nue1JSywc = $pr;
								if (strstr ( $pr, '=' )) {
									list ( $nue1JSywc, $JAvBiMmjzH ) = explode ( '=', $pr );
									$OWNVYbuUt2KT49cveBR = 1;
								}
								if (strstr ( $pr, '%' )) {
									list ( $nue1JSywc, $JAvBiMmjzH ) = explode ( '%', $pr );
									$kxesmZvVXn = 1;
								}
								if (strstr ( $JAvBiMmjzH, '$' ))
									$JAvBiMmjzH = $GLOBALS [str_replace ( '$', '', $JAvBiMmjzH )];
								if ($idrPGABfc4yuslY [$JAvBiMmjzH])
									$JAvBiMmjzH = $idrPGABfc4yuslY [$JAvBiMmjzH];
								$t_LlD5p6PQKvgvIZpP9 = $idrPGABfc4yuslY [$nue1JSywc];
								if ($ta ['sub'])
									$rt .= $this->PAMsFEW9PB2RQoc3 ( $ta ['sub'], $idrPGABfc4yuslY, $dp + 1, ($kxesmZvVXn ? (($t_LlD5p6PQKvgvIZpP9 % $JAvBiMmjzH) == 0) : ($OWNVYbuUt2KT49cveBR ? ($t_LlD5p6PQKvgvIZpP9 == $JAvBiMmjzH) : $t_LlD5p6PQKvgvIZpP9)) );
								$rt .= $ta ['post'];
								break;
							case 'tvar' :
								$t = $idrPGABfc4yuslY [$pr];
								if (substr ( $pr, 0, 3 ) == 'ue_')
									$t = urlencode ( $idrPGABfc4yuslY [substr ( $pr, 3 )] );
								if ($pr [0] == '$')
									$t = $GLOBALS [substr ( $pr, 1 )];
								$rt .= $t;
								$rt .= $ta ['post'];
								break;
							case 'tinc' :
								$Tqxf4L13C0B33yiyrv = implode ( "", file ( $this->tplPath . $pr ) );
								
								$Tqxf4L13C0B33yiyrv = $this->iIsc9RqVvWVR29Tijqd ( $Tqxf4L13C0B33yiyrv, $idrPGABfc4yuslY );
								$rt .= $Tqxf4L13C0B33yiyrv;
								$rt .= $ta ['post'];
								break;
							default :
								$rt .= $ta ['post'];
								break;
						}
					}
					if ($ta ['tag'] == 'telse') {
						$Ebcaq_YCAyxUIB324G = ! $Ebcaq_YCAyxUIB324G;
					}
				}
			return $rt;
		}
		function GE6qcpPfzdWGB() {
			$RkxOeH9i8 = $this->parse ();
			echo $RkxOeH9i8;
		}
	}
}
?>