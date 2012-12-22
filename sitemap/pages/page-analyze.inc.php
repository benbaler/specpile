<?php
include KjGb5UkXhbELCFSf . 'page-top.inc.php';
?>
<div id="sidenote">
<?php
include KjGb5UkXhbELCFSf . 'page-sitemap-detail.inc.php';
?>
</div>
<div id="shifted">
<h2>Analyze Site Structure</h2>
<?php
if ($Jzvvi5906fScvwvc6H) {
	$ULNLM9sV968 = str_replace ( '.log', '.proc', $pAo1GkXiqGnhFvayP );
	if (! file_exists ( tuhOqyefnq6RVW . $ULNLM9sV968 )) {
		echo 'Analysis in progress...';
		flush ();
		include KjGb5UkXhbELCFSf . 'class.xml-creator.inc.php';
		$gnFe1_ACf3THo5fSVT = basename ( $grab_parameters ['xs_smname'] );
		$JnjWLFycu->fapp = $grab_parameters ['xs_compress'] ? '.gz' : '';
		$urls_list = $JnjWLFycu->t3jvxqdXKF32_lYX ( $gnFe1_ACf3THo5fSVT );
		$OG_mULAWKT_xD4fsdPN = preg_replace ( '#/$#', '', $Jzvvi5906fScvwvc6H ['initdir'] );
		$m8SP2ZxC0d0O2hA4w = $dULsz8pA0Aoo = $AxQrHpWAhbF = array ();
		for($i = 0; $i < count ( $urls_list ); $i ++) {
			$jmTPqK4UHmexxwYuYDf = str_replace ( $OG_mULAWKT_xD4fsdPN, '', $urls_list [$i] );
			NViMq57zsWhY_W ( $jmTPqK4UHmexxwYuYDf );
		
		}
		sort ( $AxQrHpWAhbF );
		$qf18BjEtnRVInkiG = array ($m8SP2ZxC0d0O2hA4w, $dULsz8pA0Aoo, $AxQrHpWAhbF );
		EpCvw2zEnDD ( $ULNLM9sV968, serialize ( $qf18BjEtnRVInkiG ) );
		echo 'DONE<br>';
	} else
		list ( $m8SP2ZxC0d0O2hA4w, $dULsz8pA0Aoo, $AxQrHpWAhbF ) = @unserialize ( s3wnrrYJ6M1Xfb6_g ( tuhOqyefnq6RVW . $ULNLM9sV968 ) );
	?>
<div class="inptitle">Site folders structure</div>
<script>
function qhFBjW3y01(eln)
{
el=document.getElementById('sp'+eln)
el.style.display=el.style.display?'':'none'
}
</script> <pre>
<?php
	$w7NW0sRCh2KBF74Bo = 0;
	uzjs4PE_fXSJ_wHAtG ( $m8SP2ZxC0d0O2hA4w ['elem'], 0, $OG_mULAWKT_xD4fsdPN );
	?>
</pre>
<?php
}
?>
</div>
<?php
include KjGb5UkXhbELCFSf . 'page-bottom.inc.php';
function uzjs4PE_fXSJ_wHAtG($sl, $yyq7fDoK_cBPACC6n1 = 0, $rc3b9mqz2jbp = '', $Tl5grrNPKv7IY = true) {
	global $w7NW0sRCh2KBF74Bo;
	echo '<span id="sp' . ($w7NW0sRCh2KBF74Bo ++) . '"' . ($yyq7fDoK_cBPACC6n1 > 0 ? ' style="display:none"' : '') . '>';
	ksort ( $sl );
	$ls = $yyq7fDoK_cBPACC6n1 * 2;
	foreach ( $sl as $sk => $sn ) {
		
		echo str_repeat ( ' ', $ls ) . ($sn ['elem'] ? '<a href="javascript:qhFBjW3y01(\'' . $w7NW0sRCh2KBF74Bo . '\')">[x]</a>' : '') . ($Tl5grrNPKv7IY ? '<a href="' . $rc3b9mqz2jbp . $sk . '">' . $sk . '</a>' : $sk) . str_repeat ( ' ', max ( 0, 30 - $ls - ($sn ['elem'] ? 3 : 0) - strlen ( $sk ) ) ) . ' - ' . $sn ['cnt'] . ($sn ['tcnt'] > $sn ['cnt'] ? ' (' . $sn ['tcnt'] . ')' : '') . "\n";
		if ($sn ['elem'])
			uzjs4PE_fXSJ_wHAtG ( $sn ['elem'], $yyq7fDoK_cBPACC6n1 + 1, $rc3b9mqz2jbp . $sk, $Tl5grrNPKv7IY );
	}
	echo '</span>';
}
function NViMq57zsWhY_W($IFy8IvAAwMb4K) {
	global $m8SP2ZxC0d0O2hA4w, $dULsz8pA0Aoo, $nZPP1mn5ss7dro;
	for($i = 0; $i < count ( $nZPP1mn5ss7dro ); $i ++)
		if (preg_match ( '#' . $nZPP1mn5ss7dro [$i] . '#', $IFy8IvAAwMb4K )) {
			$dULsz8pA0Aoo ['elem'] [$nZPP1mn5ss7dro [$i]] ['cnt'] ++;
			$dULsz8pA0Aoo ['tcnt'] ++;
			break;
		}
	$aBb5M7SvBOsEIqI7t = &$m8SP2ZxC0d0O2hA4w;
	$lv = 0;
	while ( ($ps = strpos ( $IFy8IvAAwMb4K, '/' )) !== false ) {
		$ns = substr ( $IFy8IvAAwMb4K, 0, $ps + 1 );
		$aBb5M7SvBOsEIqI7t = &$aBb5M7SvBOsEIqI7t ['elem'] [$ns];
		$aBb5M7SvBOsEIqI7t ['tcnt'] ++;
		$IFy8IvAAwMb4K = substr ( $IFy8IvAAwMb4K, $ps + 1 );
	}
	$aBb5M7SvBOsEIqI7t ['cnt'] ++;
}
?>