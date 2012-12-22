<?php
$_SESSION ['is_admin'] = ($grab_parameters ['xs_login'] == $_POST ['user']) && ($grab_parameters ['xs_password'] == $_POST ['pass']);
if ($_POST ['user'])
	setcookie ( 'sm_log', md5 ( $_POST ['user'] ) . '-' . md5 ( $_POST ['pass'] ) );
if (! $_SESSION ['is_admin']) {
	define ( 'FyqopbSBljsknT1TH', 1 );
	include KjGb5UkXhbELCFSf . 'page-top.inc.php';
	?>
<div id="sidenote"></div>
<div id="shifted">
<h2>Login</h2>
<form action="index.<?php
	echo $fRRNOswmJ?>" method="POST">
<div class="inptitle">Username:</div>
<input type="text" name="user" size="30" value="">
<div class="inptitle">Password:</div>
<input type="password" name="pass" size="30" value="">
<div class="inptitle"><input class="button" type="submit" name="login"
	value="Login" style="width: 150px; height: 30px"></div>
</form>
</div>
<?php
	include KjGb5UkXhbELCFSf . 'page-bottom.inc.php';
}
?>