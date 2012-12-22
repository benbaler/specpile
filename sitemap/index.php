<?php
function gAJrAJst76NwxR($BkTM7Bu3D4VxM) {
	$rt = 'array(';
	foreach ( $BkTM7Bu3D4VxM as $k => $v )
		$rt .= "
'$k' => '" . addslashes ( $v ) . "',";
	$rt .= ")";
	return $rt;
}
error_reporting ( E_ALL & ~ E_NOTICE );
@ini_set ( "include_path", ini_get ( "include_path" ) . '.;pages/;' . (dirname ( __FILE__ ) . '\\pages') . '' );
@ini_set ( "serialize_precision", 5 );
define ( 'fLu000jqfwiRF', 'crawl_dump.log' );
define ( 'B0tchSNt2Krkc', 'crawl_state.log' );
define ( 'TpMaRXMDxB2', 'interrupt.log' );
define ( 'V0U1xekryqgXAM', dirname ( __FILE__ ) . '/' );
define ( 'KjGb5UkXhbELCFSf', dirname ( __FILE__ ) . '/pages/' );
define ( 'N6He2nKWL8cY', 9911 );
preg_match ( '#index\.([a-z0-9]+)$#', __FILE__, $pm );
$fRRNOswmJ = $pm [1] ? $pm [1] : 'php';
define ( 'xGdDP35EpCBxUGx', dirname ( __FILE__ ) . '/config.inc.php' );
define ( 'tuhOqyefnq6RVW', dirname ( __FILE__ ) . '/data/' );
$QoPlLvVWe = implode ( '', file ( xGdDP35EpCBxUGx ) );

@include xGdDP35EpCBxUGx;
define ( 'K3D58WhS_Kbefnm', $grab_parameters ['xs_sm_text_filename'] ? $grab_parameters ['xs_sm_text_filename'] : tuhOqyefnq6RVW . 'urllist.txt' );
define ( 's1Cp0mMqugf8HmPN', $grab_parameters ['xs_sm_text_url'] ? $grab_parameters ['xs_sm_text_url'] : 'data/urllist.txt' );
define ( 'QYWCGBQX7GggVu4', preg_replace ( '#[^\\/]+?\.xml$#', 'ror.xml', $grab_parameters ['xs_smname'] ) );
define ( 'LlGUdFg6y3le5XQDj5', preg_replace ( '#[^\\/]+?\.xml$#', 'ror.xml', $grab_parameters ['xs_smurl'] ) );
define ( 'PkfyLzw4OGa', tuhOqyefnq6RVW . 'gbase.xml' );
define ( 'WaHQCDK4QrZX', 'data/gbase.xml' );
if (! $_GET && $HTTP_GET_VARS)
	$_GET = $HTTP_GET_VARS;
if (! $_POST && $HTTP_POST_VARS)
	$_POST = $HTTP_POST_VARS;
if (function_exists ( 'ini_set' )) {
	if ($grab_parameters ['xs_memlimit'])
		@ini_set ( "memory_limit", $grab_parameters ['xs_memlimit'] . 'M' );
	if ($grab_parameters ['xs_exec_time'])
		@ini_set ( "max_execution_time", $grab_parameters ['xs_exec_time'] );
	@ini_set ( "magic_quotes_runtime", 'Off' );
	@ini_set ( "session.save_handler", 'files' );
}

if (@ini_get ( "magic_quotes_gpc" )) {
	if ($_GET)
		foreach ( $_GET as $k => $v ) {
			$_GET [$k] = stripslashes ( $v );
		}
	if ($_POST)
		foreach ( $_POST as $k => $v ) {
			$_POST [$k] = stripslashes ( $v );
		}
}

$op = $_REQUEST ['op'];
if (function_exists ( 'session_start' ))
	@session_start ();
if ($op == 'logout') {
	$_SESSION ['is_admin'] = false;
	setcookie ( 'sm_log', '' );
	unset ( $op );
}
if (! isset ( $op ))
	$op = 'config';
if (! $_SESSION ['is_admin'])
	$_SESSION ['is_admin'] = ($_COOKIE ['sm_log'] == md5 ( $grab_parameters ['xs_login'] ) . '-' . md5 ( $grab_parameters ['xs_password'] ));
if (! $_SESSION ['is_admin'] && $op != 'crawlproc') {
	include V0U1xekryqgXAM . 'pages/page-login.inc.php';
	if (! $_SESSION ['is_admin'])
		exit ();
}
define ( 'FyqopbSBljsknT1TH', true );
include V0U1xekryqgXAM . 'pages/page-configinit.inc.php';
include V0U1xekryqgXAM . 'pages/class.utils.inc.php';
include V0U1xekryqgXAM . 'pages/class.http.inc.php';
switch ($op) {
	case 'crawl' :
	case 'crawlproc' :
	case 'config' :
	case 'view' :
	case 'analyze' :
	case 'chlog' :
	case 'l404' :
	case 'proc' :
		include V0U1xekryqgXAM . 'pages/page-' . $op . '.inc.php';
		break;
	case 'pinfo' :
		phpinfo ();
		break;
}