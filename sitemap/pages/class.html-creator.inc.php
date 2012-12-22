<?php
echo '<br>Creating HTML sitemap...';
flush ();
$OG_mULAWKT_xD4fsdPN = $grab_parameters ['xs_initurl'];
if (substr_count ( $OG_mULAWKT_xD4fsdPN, '/' ) > 2)
	$OG_mULAWKT_xD4fsdPN = substr ( $OG_mULAWKT_xD4fsdPN, 0, strrpos ( $OG_mULAWKT_xD4fsdPN, '/' ) );
$W4Xzu7_XRKxGlHA = '';
$rO1mQuOaCrNFolA0Y = array ();
$CIob_g5skJ = 0;
$BdQWNTcmByBXtJ = ceil ( count ( $urls_completed ) / $grab_parameters ['xs_htmlpart'] );
$m8SP2ZxC0d0O2hA4w = $dULsz8pA0Aoo = $AxQrHpWAhbF = array ();
for($i = 0; $i < count ( $urls_completed ); $i ++) {
	T8apKdJmos1WZGtLE9 ( $urls_completed [$i] );
}
function T8apKdJmos1WZGtLE9($ur) {
	global $m8SP2ZxC0d0O2hA4w, $dULsz8pA0Aoo, $nZPP1mn5ss7dro, $OG_mULAWKT_xD4fsdPN, $grab_parameters;
	$IFy8IvAAwMb4K = str_replace ( $OG_mULAWKT_xD4fsdPN, '', $ur ['link'] );
	for($i = 0; $i < count ( $nZPP1mn5ss7dro ); $i ++)
		if (preg_match ( '#' . $nZPP1mn5ss7dro [$i] . '#', $IFy8IvAAwMb4K )) {
			$dULsz8pA0Aoo ['elem'] [$nZPP1mn5ss7dro [$i]] ['cnt'] ++;
			$dULsz8pA0Aoo ['tcnt'] ++;
			break;
		}
	$aBb5M7SvBOsEIqI7t = &$m8SP2ZxC0d0O2hA4w;
	$kuEVOM4cxiF = $IFy8IvAAwMb4K;
	$lv = 0;
	if ($grab_parameters ['xs_htmlnameorder']) {
		$ns = substr ( $IFy8IvAAwMb4K, 0, strrpos ( $IFy8IvAAwMb4K, '/' ) );
		$aBb5M7SvBOsEIqI7t = &$aBb5M7SvBOsEIqI7t ['elem'] [$ns];
		$aBb5M7SvBOsEIqI7t ['tcnt'] ++;
	} else
		while ( ($ps = strpos ( $IFy8IvAAwMb4K, '/' )) !== false ) {
			$ns = substr ( $IFy8IvAAwMb4K, 0, $ps + 1 );
			$aBb5M7SvBOsEIqI7t = &$aBb5M7SvBOsEIqI7t ['elem'] [$ns];
			$aBb5M7SvBOsEIqI7t ['tcnt'] ++;
			$IFy8IvAAwMb4K = substr ( $IFy8IvAAwMb4K, $ps + 1 );
		}
	$aBb5M7SvBOsEIqI7t ['cnt'] ++;
	$aBb5M7SvBOsEIqI7t ['pages'] [] = $ur;
}
function k0JkfAlSqyCZ_($sk, $GuFDO93OPpTOQkSZ77, $yyq7fDoK_cBPACC6n1, $kD52SIPb2Kr_e) {
	$kD52SIPb2Kr_e = "<table>\n" . $kD52SIPb2Kr_e . "\n</table>";
	return "
<tr valign=\"top\">" . str_repeat ( "\n<td class=\"lbullet\">&nbsp;&nbsp;&nbsp;&nbsp;</td>", $yyq7fDoK_cBPACC6n1 ) . "
<td class=\"lpart\" colspan=\"" . (100 - $yyq7fDoK_cBPACC6n1) . "\"><div class=\"lhead\">$sk
<span class=\"lcount\">" . $GuFDO93OPpTOQkSZ77 . " pages</span></div>
$kD52SIPb2Kr_e
</td>
</tr>
";
}
function KR1YwC8Id($sl, $yyq7fDoK_cBPACC6n1 = 0, &$PYyS9SPDWu0Pb3bvG8) {
	global $w7NW0sRCh2KBF74Bo, $grab_parameters, $W4Xzu7_XRKxGlHA, $rO1mQuOaCrNFolA0Y, $CIob_g5skJ;
	$nU8Mj5ZUWIEjvw = '';
	ksort ( $sl );
	$ls = $yyq7fDoK_cBPACC6n1 * 2;
	foreach ( $sl as $sk => $sn ) {
		$kD52SIPb2Kr_e = "";
		$yQTjPXCGcUnHW = array ();
		if ($sn ['pages'])
			foreach ( $sn ['pages'] as $pg ) {
				$t = $pg ['t'] ? $pg ['t'] : basename ( $pg ['link'] );
				$yQTjPXCGcUnHW [] = array ('link' => $pg ['link'], 'title' => $t, 'desc' => $pg ['d'], 'title_clean' => str_replace ( '&amp;amp;', '&amp;', htmlspecialchars ( $t ) ), 'file' => basename ( $pg ['link'] ) );
				$kD52SIPb2Kr_e .= "\n<tr><td class=\"lpage\"><a href=\"" . $pg ['link'] . "\" title=\"" . str_replace ( '&amp;amp;', '&amp;', htmlspecialchars ( $t ) ) . "\">" . $t . "</a></td></tr>";
				$PYyS9SPDWu0Pb3bvG8 ++;
				if (($PYyS9SPDWu0Pb3bvG8 % $grab_parameters ['xs_htmlpart']) == 0) {
					$W4Xzu7_XRKxGlHA .= k0JkfAlSqyCZ_ ( $sk, $sn ['cnt'], $yyq7fDoK_cBPACC6n1, $kD52SIPb2Kr_e );
					$rO1mQuOaCrNFolA0Y [] = array ('folder' => str_replace ( '/', ' ', $sk ), 'cnt' => $sn ['cnt'], 'cntmulti' => $sn ['cnt'] > 1, 'level' => $yyq7fDoK_cBPACC6n1, 'alevel' => range ( 0, $yyq7fDoK_cBPACC6n1 ), 'level100' => 100 - $yyq7fDoK_cBPACC6n1, 'pages' => $yQTjPXCGcUnHW );
					$kD52SIPb2Kr_e = '';
					$yQTjPXCGcUnHW = array ();
					AkOw5hp0Ju4beT ( $W4Xzu7_XRKxGlHA, $rO1mQuOaCrNFolA0Y );
					$CIob_g5skJ ++;
					$W4Xzu7_XRKxGlHA = '';
					$rO1mQuOaCrNFolA0Y = array ();
				}
			}
		if ($kD52SIPb2Kr_e) {
			$W4Xzu7_XRKxGlHA .= k0JkfAlSqyCZ_ ( $sk, $sn ['cnt'], $yyq7fDoK_cBPACC6n1, $kD52SIPb2Kr_e );
			$rO1mQuOaCrNFolA0Y [] = array ('folder' => str_replace ( '/', ' ', $sk ), 'cnt' => $sn ['cnt'], 'cntmulti' => $sn ['cnt'] > 1, 'level' => $yyq7fDoK_cBPACC6n1, 'alevel' => range ( 0, $yyq7fDoK_cBPACC6n1 ), 'level100' => 100 - $yyq7fDoK_cBPACC6n1, 'pages' => $yQTjPXCGcUnHW );
		}
		if ($sn ['elem'])
			KR1YwC8Id ( $sn ['elem'], $yyq7fDoK_cBPACC6n1 + 1, $PYyS9SPDWu0Pb3bvG8 );
	}
	if ($yyq7fDoK_cBPACC6n1 == 0 && $W4Xzu7_XRKxGlHA)
		AkOw5hp0Ju4beT ( $W4Xzu7_XRKxGlHA, $rO1mQuOaCrNFolA0Y );
}
$PYyS9SPDWu0Pb3bvG8 = 0;
KR1YwC8Id ( $m8SP2ZxC0d0O2hA4w ['elem'], 0, $PYyS9SPDWu0Pb3bvG8 );
include KjGb5UkXhbELCFSf . 'class.templates.inc.php';
function AkOw5hp0Ju4beT($ht, $hv) {
	global $grab_parameters, $OG_mULAWKT_xD4fsdPN, $urls_completed, $CIob_g5skJ, $BdQWNTcmByBXtJ;
	$CaVSdh0LSmJ5J = new rGJWR_guN ( "pages/" );
	$CaVSdh0LSmJ5J->bE03wJKFluEetHDrxE ( 'sitemap_tpl.html' );
	$gnFe1_ACf3THo5fSVT = $grab_parameters ['xs_htmlname'];
	$GemKMfObNXtkeAmJ = basename ( $grab_parameters ['xs_htmlname'] );
	$a1WM9_ZFATayi = '';
	$xQLpfjCqrIGqiBnOk = array ();
	if ($BdQWNTcmByBXtJ > 1) {
		for($i1 = 0; $i1 < $BdQWNTcmByBXtJ; $i1 ++) {
			$w1CLxCPhUy9qzof = Z4L1ygR2lvr3j2UGWEK ( $i1 + 1, $GemKMfObNXtkeAmJ, true );
			$a1WM9_ZFATayi .= ($i1 == $CIob_g5skJ) ? ' [' . ($i1 + 1) . ']' : ' <a href="' . $w1CLxCPhUy9qzof . '">' . ($i1 + 1) . '</a>';
			$xQLpfjCqrIGqiBnOk [] = array ('current' => ($i1 == $CIob_g5skJ), 'link' => $w1CLxCPhUy9qzof, 'num' => $i1 + 1 );
		}
		$a1WM9_ZFATayi = '<span class="pager">' . $a1WM9_ZFATayi . '</span>';
	}
	$PGvQRa41twTzn3 = "<table cellpadding=\"0\" border=\"0\">\n" . $ht . "\n</table>\n";
	$CaVSdh0LSmJ5J->hwKdALVRpEm ( 'slots', $hv );
	$CaVSdh0LSmJ5J->hwKdALVRpEm ( 'LASTUPDATE', date ( $grab_parameters ['xs_dateformat'] ? $grab_parameters ['xs_dateformat'] : 'Y, F j' ) );
	$CaVSdh0LSmJ5J->hwKdALVRpEm ( 'TOPURL', $OG_mULAWKT_xD4fsdPN );
	$CaVSdh0LSmJ5J->hwKdALVRpEm ( 'PAGE', $BdQWNTcmByBXtJ ? ' Page ' . ($CIob_g5skJ + 1) : '' );
	$CaVSdh0LSmJ5J->hwKdALVRpEm ( 'PAGES', $a1WM9_ZFATayi );
	$CaVSdh0LSmJ5J->hwKdALVRpEm ( 'APAGER', $xQLpfjCqrIGqiBnOk );
	$CaVSdh0LSmJ5J->hwKdALVRpEm ( 'TOTALURLS', count ( $urls_completed ) );
	$wX3J29vlCRlFMhuQW = $CaVSdh0LSmJ5J->parse ();
	$wX3J29vlCRlFMhuQW = preg_replace ( array ('#%SITEMAP%#', '#%LASTUPDATE%#', '#%TOPURL%#', '#%PAGE%#', '#%PAGER%#', '#%TOTALURLS%#' ), array ($PGvQRa41twTzn3, date ( 'Y, F j' ), $OG_mULAWKT_xD4fsdPN, $BdQWNTcmByBXtJ ? ' Page ' . ($CIob_g5skJ + 1) : '', $a1WM9_ZFATayi, count ( $urls_completed ) ), $wX3J29vlCRlFMhuQW );
	$w1CLxCPhUy9qzof = $BdQWNTcmByBXtJ > 1 ? Z4L1ygR2lvr3j2UGWEK ( $CIob_g5skJ + 1, $gnFe1_ACf3THo5fSVT, true ) : $gnFe1_ACf3THo5fSVT;
	$pf = fopen ( $w1CLxCPhUy9qzof, 'w' );
	fwrite ( $pf, $wX3J29vlCRlFMhuQW );
	fclose ( $pf );
}
?>