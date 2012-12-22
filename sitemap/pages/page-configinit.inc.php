<?php
if (! defined ( 'FyqopbSBljsknT1TH' ))
	exit ();
if (! $grab_parameters ['xs_htmlname'])
	$grab_parameters ['xs_htmlname'] = dirname ( dirname ( __FILE__ ) ) . '/data/sitemap.html';
if (! $grab_parameters ['xs_htmlpart'])
	$grab_parameters ['xs_htmlpart'] = 1000;
$dlUE6X_RWe = 'http://' . $_SERVER ['HTTP_HOST'] . dirname ( dirname ( $_SERVER ['REQUEST_URI'] . '-' ) );
$REpEqrxI7DpN9 = 'http://' . $_SERVER ['HTTP_HOST'] . dirname ( ($_SERVER ['REQUEST_URI'] . '-') );
$dlUE6X_RWe = preg_replace ( '#/$#', '', $dlUE6X_RWe );
if ($grab_parameters ['xs_notconfigured'] && is_writable ( xGdDP35EpCBxUGx )) {
	$grab_parameters ['xs_initurl'] = $dlUE6X_RWe;
	$grab_parameters ['xs_smname'] = dirname ( dirname ( dirname ( __FILE__ ) ) ) . '/sitemap.xml';
	$grab_parameters ['xs_smurl'] = $dlUE6X_RWe . '/sitemap.xml';
	$grab_parameters ['xs_notconfigured'] = 0;
	$ws = "<?php\n\$grab_parameters = " . gAJrAJst76NwxR ( $grab_parameters ) . ";\n?>";
	$pf = fopen ( xGdDP35EpCBxUGx, 'w' );
	fwrite ( $pf, $ws );
	fclose ( $pf );
}
$h8i3gNivayoQQtqpLY = $grab_parameters ['xs_compress'] ? '.gz' : '';
$wJu5NxAjkFkQBpMse = dirname ( $grab_parameters ['xs_htmlname'] );
$lPT6M7drPhQPL = dirname ( dirname ( __FILE__ ) ) . '/data';
$lPT6M7drPhQPL = str_replace ( '\\', '/', $lPT6M7drPhQPL );
$wJu5NxAjkFkQBpMse = str_replace ( '\\', '/', $wJu5NxAjkFkQBpMse );
$dn = (dirname ( ($_SERVER ['REQUEST_URI'] ? $_SERVER ['REQUEST_URI'] : $_SERVER ['PHP_SELF']) . '-' ));
if ($dn == '.')
	$dn = '';
$kEM8KMpb9E = 'http://' . $_SERVER ['HTTP_HOST'] . $dn . '/data';
$kEM8KMpb9E = preg_replace ( '#/$#', '', $kEM8KMpb9E );
$SWPRyjxwK34hBwC = strlen ( $lPT6M7drPhQPL ) + 1;
while ( $lPT6M7drPhQPL != $wJu5NxAjkFkQBpMse && ! strstr ( $wJu5NxAjkFkQBpMse, $lPT6M7drPhQPL ) && strlen ( $lPT6M7drPhQPL ) < $SWPRyjxwK34hBwC ) {
	$SWPRyjxwK34hBwC = strlen ( $lPT6M7drPhQPL );
	$lPT6M7drPhQPL = dirname ( $lPT6M7drPhQPL );
	$kEM8KMpb9E = dirname ( $kEM8KMpb9E );
}
$kEM8KMpb9E .= str_replace ( $lPT6M7drPhQPL, '', $wJu5NxAjkFkQBpMse );
$DetHfLuiy2rm = $grab_parameters ['xs_htmlpart'];
$gnFe1_ACf3THo5fSVT = basename ( $grab_parameters ['xs_htmlname'] );
$YU8s83esIfxy544ZH = (($Jzvvi5906fScvwvc6H ['ucount'] > $DetHfLuiy2rm) ? Z4L1ygR2lvr3j2UGWEK ( 1, $gnFe1_ACf3THo5fSVT, true ) : $gnFe1_ACf3THo5fSVT);
$grab_parameters ['htmlurl'] = $kEM8KMpb9E . '/' . $YU8s83esIfxy544ZH;
?>