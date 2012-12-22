<?php
$op = $_REQUEST ['op'] = 'crawlproc';
if (isset ( $_SERVER ['REQUEST_METHOD'] )) {
	echo 'This tool can be executed in command line mode only';
	exit ();
}
$wBZSjAu6USLv869OfXK = true;
chdir ( dirname ( __FILE__ ) );
$_REQUEST ['bg'] = true;
$_REQUEST ['resume'] = true;
include './index.php';
?>