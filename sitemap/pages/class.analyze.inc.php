<?php
if (! defined ( 'FyqopbSBljsknT1TH' ))
	exit ();
set_time_limit ( 30 * 60 * 60 );
echo 'Analysis in progress...';
flush ();
if ($gYT2DH5A_)
	$nZPP1mn5ss7dro = split ( "[\r\n]+", $gYT2DH5A_ );
$gnFe1_ACf3THo5fSVT = basename ( $grab_parameters ['xs_smname'] );
$x0KYUlJb0P926oU = $grab_parameters ['xs_compress'] ? '.gz' : '';
$YU8s83esIfxy544ZH = tuhOqyefnq6RVW . $gnFe1_ACf3THo5fSVT . $x0KYUlJb0P926oU;
$A1D6v6ZnT2du = tuhOqyefnq6RVW . $gnFe1_ACf3THo5fSVT . '.proc';
preg_match ( '#(.*?//[^/]*)#', $grab_parameters ['xs_initurl'], $tm );
$OG_mULAWKT_xD4fsdPN = $tm [1];
$GmkHSl9d0wHkwtimWX = '\w\d\.\,\-\/\!\(\) \_\[\]';
if (file_exists ( $A1D6v6ZnT2du ) && filemtime ( $A1D6v6ZnT2du ) > filemtime ( $YU8s83esIfxy544ZH )) {
	list ( $m8SP2ZxC0d0O2hA4w, $dULsz8pA0Aoo, $AxQrHpWAhbF ) = @unserialize ( s3wnrrYJ6M1Xfb6_g ( $A1D6v6ZnT2du ) );
} else {
	$cn = '';
	for($i = 0; file_exists ( $PvFdgEcx0laOpBsp = tuhOqyefnq6RVW . Z4L1ygR2lvr3j2UGWEK ( $i, $gnFe1_ACf3THo5fSVT ) . $x0KYUlJb0P926oU ); $i ++) {
		$cn .= $x0KYUlJb0P926oU ? implode ( '', gzfile ( $PvFdgEcx0laOpBsp ) ) : s3wnrrYJ6M1Xfb6_g ( $PvFdgEcx0laOpBsp );
	}
	preg_match_all ( '#<loc>(.*?)</loc>#', $cn, $um );
	$o6tTsvNFXN = $um [1];
	$m8SP2ZxC0d0O2hA4w = $dULsz8pA0Aoo = $AxQrHpWAhbF = array ();
	for($i = 0; $i < count ( $o6tTsvNFXN ); $i ++) {
		$jmTPqK4UHmexxwYuYDf = str_replace ( $OG_mULAWKT_xD4fsdPN, '', $o6tTsvNFXN [$i] );
		NViMq57zsWhY_W ( $jmTPqK4UHmexxwYuYDf );
		if (preg_match ( '#[^' . $GmkHSl9d0wHkwtimWX . ']#', $jmTPqK4UHmexxwYuYDf ))
			$AxQrHpWAhbF [] = $jmTPqK4UHmexxwYuYDf;
	
	}
	sort ( $AxQrHpWAhbF );
	$wc = serialize ( array ($m8SP2ZxC0d0O2hA4w, $dULsz8pA0Aoo, $AxQrHpWAhbF ) );
	$pf = fopen ( $A1D6v6ZnT2du, 'w' );
	fwrite ( $pf, $wc );
	fclose ( $pf );
}
if ($R3KrNLbTLhbCIjjBe7F)
	return;
echo 'DONE<br>';
?><pre>
<script>
function qhFBjW3y01(eln)
{
el=document.all['sp'+eln]
el.style.display=el.style.display?'':'none'
}
</script>
<?php

$w7NW0sRCh2KBF74Bo = 1;
function uzjs4PE_fXSJ_wHAtG($sl, $yyq7fDoK_cBPACC6n1 = 0, $rc3b9mqz2jbp = '', $Tl5grrNPKv7IY = true) {
	global $w7NW0sRCh2KBF74Bo;
	echo '<span id="sp' . ($w7NW0sRCh2KBF74Bo ++) . '"' . ($yyq7fDoK_cBPACC6n1 > 2 ? ' style="display:none"' : '') . '>';
	ksort ( $sl );
	$ls = $yyq7fDoK_cBPACC6n1 * 2;
	foreach ( $sl as $sk => $sn ) {
		
		echo str_repeat ( ' ', $ls ) . ($sn ['elem'] ? '<a href="javascript:qhFBjW3y01(\'' . $w7NW0sRCh2KBF74Bo . '\')">[x]</a>' : '') . ($Tl5grrNPKv7IY ? '<a href="' . $rc3b9mqz2jbp . $sk . '">' . $sk . '</a>' : $sk) . str_repeat ( ' ', max ( 0, 30 - $ls - strlen ( $sk ) ) ) . ' - ' . $sn ['cnt'] . ($sn ['tcnt'] > $sn ['cnt'] ? ' (' . $sn ['tcnt'] . ')' : '') . "\n";
		if ($sn ['elem'])
			uzjs4PE_fXSJ_wHAtG ( $sn ['elem'], $yyq7fDoK_cBPACC6n1 + 1, $rc3b9mqz2jbp . $sk, $Tl5grrNPKv7IY );
	}
	echo '</span>';
}
uzjs4PE_fXSJ_wHAtG ( array ('Custom groups' => $dULsz8pA0Aoo ), 0, $OG_mULAWKT_xD4fsdPN, false );
uzjs4PE_fXSJ_wHAtG ( $m8SP2ZxC0d0O2hA4w ['elem'], 0, $OG_mULAWKT_xD4fsdPN );
foreach ( $AxQrHpWAhbF as $ns ) {
	preg_match_all ( '#([^' . $GmkHSl9d0wHkwtimWX . '])#', $ns, $mt );
	$PvFTCmFE6 = array_merge ( $PvFTCmFE6, $mt [1] );
}
$PvFTCmFE6 = array_unique ( $PvFTCmFE6 );
?>
</pre>
<h4>non-standard formatted urls (<?php
echo count ( $AxQrHpWAhbF )?>)</h4>
<?php
sort ( $PvFTCmFE6 );
echo count ( $PvFTCmFE6 ) . ' : ' . implode ( ' | ', $PvFTCmFE6 ) . '<br>';
echo implode ( '<br>', $AxQrHpWAhbF );
function NViMq57zsWhY_W($IFy8IvAAwMb4K) {
	global $m8SP2ZxC0d0O2hA4w, $dULsz8pA0Aoo, $nZPP1mn5ss7dro;
	for($i = 0; $i < count ( $nZPP1mn5ss7dro ); $i ++)
		if (preg_match ( '#' . $nZPP1mn5ss7dro [$i] . '#', $IFy8IvAAwMb4K )) {
			$dULsz8pA0Aoo ['elem'] [$nZPP1mn5ss7dro [$i]] ['cnt'] ++;
			$dULsz8pA0Aoo ['tcnt'] ++;
			break;
		}
	$aBb5M7SvBOsEIqI7t = &$m8SP2ZxC0d0O2hA4w;
	$kuEVOM4cxiF = $IFy8IvAAwMb4K;
	$lv = 0;
	while ( ($ps = strpos ( $IFy8IvAAwMb4K, '/' )) !== false ) {
		$ns = substr ( $IFy8IvAAwMb4K, 0, $ps + 1 );
		$aBb5M7SvBOsEIqI7t = &$aBb5M7SvBOsEIqI7t ['elem'] [$ns];
		$aBb5M7SvBOsEIqI7t ['tcnt'] ++;
		$IFy8IvAAwMb4K = substr ( $IFy8IvAAwMb4K, $ps + 1 );
	}
	$aBb5M7SvBOsEIqI7t ['cnt'] ++;
	$aBb5M7SvBOsEIqI7t ['pages'] [] = $kuEVOM4cxiF;
}
?>