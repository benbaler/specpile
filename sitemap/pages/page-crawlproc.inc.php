<?php

?><html>
<head>
<title>XML Sitemaps - Generation</title>
<meta http-equiv="Content-type" content="text/html;charset=iso-8859-15" />
<link rel=stylesheet type="text/css" href="pages/style.css">
</head>
<body>
<?php
if (! defined ( 'FyqopbSBljsknT1TH' ))
	exit ();
if (file_exists ( $fn = tuhOqyefnq6RVW . B0tchSNt2Krkc ) && (time () - filemtime ( $fn ) < 10 * 60)) {
	$NgdBMzLLVP5 = true;
	?>
<h4>Already in progress. Current process state is displayed:</h4><?php
}
if (! $wBZSjAu6USLv869OfXK) {
	?><div id="glog">Links depth: <b><span id="llevel">-</span></b> <br>
Current page: <span id="cpage">-</span> <br>
Pages added to sitemap: <span id="compno">-</span> <br>
Pages scanned: <span id="pdone">-</span> (<span id="bdone">-</span> KB)
<br>
Pages left: <span id="pleft">-</span> (+ <span id="l2">-</span> queued
for the next depth level) <br>
Time passed: <span id="tdone">-</span> <br>
Time left: <span id="tleft">-</span> <br>
Memory usage: <span id="musage">-</span></div>
<script language="Javascript">
function xVgfDLYutp(id,txt)
{
el = document.all[id]
el.innerHTML = txt
}
function zPw5WDkamQ(txt1,txt2,txt3,txt4,txt5,txt6,txt7,txt8,txt9,txt10)
{
xVgfDLYutp('cpage',txt1)
xVgfDLYutp('pleft',txt2)
xVgfDLYutp('pdone',txt3)
xVgfDLYutp('bdone',txt4)
xVgfDLYutp('tdone',txt5)
xVgfDLYutp('tleft',txt6)
xVgfDLYutp('llevel',txt7)
xVgfDLYutp('musage',txt8)
xVgfDLYutp('compno',txt9)
xVgfDLYutp('l2',txt10)
}
</script>
<?php
}
include KjGb5UkXhbELCFSf . 'class.grab.inc.php';
include KjGb5UkXhbELCFSf . 'class.xml-creator.inc.php';
include KjGb5UkXhbELCFSf . 'class.gping.inc.php';
if ($NgdBMzLLVP5) {
	$rc = @twb3vL6xHv65 ( s3wnrrYJ6M1Xfb6_g ( $fn ) );
	xiXlFjjdb5NC_o2wn ( $rc );
	exit ();
}
if (file_exists ( tuhOqyefnq6RVW . TpMaRXMDxB2 ))
	@unlink ( tuhOqyefnq6RVW . TpMaRXMDxB2 );
$Jzvvi5906fScvwvc6H = $pUvA4zhAkYZK2Nd8A->ANwqywRuJwV ( array ('initurl' => $grab_parameters ['xs_initurl'], 'progress_callback' => 'xiXlFjjdb5NC_o2wn', 'maxpg' => $grab_parameters ['xs_max_pages'], 'bgexec' => $_REQUEST ['bg'], 'resume' => $_REQUEST ['resume'], 'maxdepth' => $grab_parameters ['xs_max_depth'] ), $urls_completed );
if ($Jzvvi5906fScvwvc6H ['errmsg'] || $Jzvvi5906fScvwvc6H ['interrupt']) {
	echo '<h4>An error occured: ' . $Jzvvi5906fScvwvc6H ['errmsg'] . '</h4>';
	?>
<script>
top.location = 'index.<?php
	echo $fRRNOswmJ?>?op=config&errmsg=<?php
	echo urlencode ( $Jzvvi5906fScvwvc6H ['interrupt'] ? 'The process has been interrupted by user' : $Jzvvi5906fScvwvc6H ['errmsg'] )?>'
</script>
<?php
	exit ();
}
echo '<h4>Completed</h4>Total pages indexed: ' . count ( $urls_completed );
if ($grab_parameters ['xs_chlog'])
	echo '<br>Calculating changelog...';
flush ();
$Jzvvi5906fScvwvc6H = $JnjWLFycu->RYsvKg3BLnSvTb ( $grab_parameters, $urls_completed, $Jzvvi5906fScvwvc6H );
if ($grab_parameters ['xs_makehtml']) {
	include KjGb5UkXhbELCFSf . 'class.html-creator.inc.php';
}
@unlink ( tuhOqyefnq6RVW . fLu000jqfwiRF );
if ($grab_parameters ['xs_gping'])
	$Mq7SpvssgXyM->rpvTbIkAm ( $Jzvvi5906fScvwvc6H ['files'] );
if ($grab_parameters ['xs_email']) {
	echo '<br>Sending email notification...';
	flush ();
	include KjGb5UkXhbELCFSf . 'class.mail.inc.php';
	$fGokyqo8tR33zzFafi3->nE6WfY32ZiCs ( $Jzvvi5906fScvwvc6H );
}

?>
<script>
top.location = 'index.<?php
echo $fRRNOswmJ?>?op=view'
</script>
<?php
exit ();

function xiXlFjjdb5NC_o2wn($QmKaHsN_mnHEfYSpTEg) {
	global $wBZSjAu6USLv869OfXK, $AbOnA9dFxAZFArqSEam;
	list ( $ctime, $l_kNDRia9T1o, $Nm21UoK4Q2QYWx7O, $pn, $tsize, $links_level, $mu, $Zq0MnQmsD6T2lLLfU, $l2 ) = $QmKaHsN_mnHEfYSpTEg;
	$zdUTg22HNObKCXmp = $pn ? ($Nm21UoK4Q2QYWx7O / $pn) * $ctime : 0;
	$QFUVsYC4MD0X8x = intval ( str_replace ( ',', '', $mu ) );
	
	if ($wBZSjAu6USLv869OfXK)
		echo "$pn | $Nm21UoK4Q2QYWx7O | " . number_format ( $tsize / 1024, 1 ) . " | " . h9EmToufL4h9OSGalBd ( $ctime ) . " | " . h9EmToufL4h9OSGalBd ( $zdUTg22HNObKCXmp ) . " | $links_level | $mu | $Zq0MnQmsD6T2lLLfU | $l2 | " . ($QFUVsYC4MD0X8x - $AbOnA9dFxAZFArqSEam) . "\n";
	else
		echo "<script>zPw5WDkamQ('" . $l_kNDRia9T1o . "',
'" . $Nm21UoK4Q2QYWx7O . "',
'" . $pn . "',
'" . number_format ( $tsize / 1024, 1 ) . "',
'" . h9EmToufL4h9OSGalBd ( $ctime ) . "',
'" . h9EmToufL4h9OSGalBd ( $zdUTg22HNObKCXmp ) . "',
'" . $links_level . "',
'" . $mu . "',
'" . $Zq0MnQmsD6T2lLLfU . "',
'" . $l2 . "'
);</script>
";
	$AbOnA9dFxAZFArqSEam = $QFUVsYC4MD0X8x;
	flush ();
}
?>