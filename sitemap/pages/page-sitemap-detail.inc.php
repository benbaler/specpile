<?php
if (! defined ( 'FyqopbSBljsknT1TH' ))
	exit ();
$AbiyTr9Cb6H08SemlUw = pX3Aht4bffp5cql ();
if (count ( $AbiyTr9Cb6H08SemlUw ) > 0) {
	$pAo1GkXiqGnhFvayP = array_pop ( $AbiyTr9Cb6H08SemlUw );
	@set_time_limit ( 60 * 60 );
	$Jzvvi5906fScvwvc6H = @unserialize ( s3wnrrYJ6M1Xfb6_g ( tuhOqyefnq6RVW . $pAo1GkXiqGnhFvayP ) );
	if (filesize ( tuhOqyefnq6RVW . $pAo1GkXiqGnhFvayP ) > 2000000) {
		$Jzvvi5906fScvwvc6H ['newurls'] = $Jzvvi5906fScvwvc6H ['losturls'] = $Jzvvi5906fScvwvc6H ['aproc'] = array ();
		EpCvw2zEnDD ( $pAo1GkXiqGnhFvayP, serialize ( $Jzvvi5906fScvwvc6H ) );
	}
	?>
<div class="block1head">Sitemap details</div>
<div class="block1"><b>Request date:</b><br>
<?php
	echo date ( 'j F Y, H:i', $Jzvvi5906fScvwvc6H ['time'] )?><br>
<b>Processing time:</b><br>
<?php
	echo sprintf ( '%1.2f', $Jzvvi5906fScvwvc6H ['ctime'] )?>s<br>
<b>Pages indexed:</b><br>
<?php
	echo $Jzvvi5906fScvwvc6H ['ucount']?><br>
<b>Sitemap files:</b><br>
<?php
	echo count ( $Jzvvi5906fScvwvc6H ['files'] )?><br>
<b>Pages size:</b><br>
<?php
	echo number_format ( $Jzvvi5906fScvwvc6H ['tsize'] / 1024 / 1024, 2 )?>Mb<br>
<b>Download:</b><br>
<a href="<?php
	echo $grab_parameters ['xs_smurl']?>">XML sitemap</a> <br />
<a href="<?php
	echo s1Cp0mMqugf8HmPN . $h8i3gNivayoQQtqpLY;
	?>">In text
format</a> <br />
<a href="<?php
	echo LlGUdFg6y3le5XQDj5 . $h8i3gNivayoQQtqpLY;
	?>">In ROR
format</a> <!--
<br/>
<a href="<?php
	echo WaHQCDK4QrZX . $h8i3gNivayoQQtqpLY;
	?>">In Google Base format</a>
--> <br />
<a href="<?php
	echo $grab_parameters ['htmlurl']?>">HTML sitemap</a></div>
<?php
	if (count ( $Jzvvi5906fScvwvc6H ['u404'] )) {
		?>
<div class="block2head">Broken links</div>
<div class="block1"><b><?php
		echo count ( $Jzvvi5906fScvwvc6H ['u404'] )?> broken links</b>
found! <br>
<a href="index.<?php
		echo $fRRNOswmJ?>?op=l404">View the list</a>.</div>
<?php
	}
} else {
	?>
<div class="block2head">No sitemaps found</div>
<div class="block1">Sitemap was not generated yet, please go to <a
	href="index.<?php
	echo $fRRNOswmJ?>?op=crawl">Crawling</a> page to
start crawler manually or to setup a cron job.</div>
<?php
}
?>
