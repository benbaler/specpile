<?php
include KjGb5UkXhbELCFSf . 'page-top.inc.php';
$UhW8Rxuh0rGTpQQ = $_REQUEST ['crawl'];
if ($_GET ['act'] == 'interrupt') {
	EpCvw2zEnDD ( TpMaRXMDxB2, '' );
	echo '<h2>The "stop" signal has been sent to a crawler.</h2><a href="index.' . $fRRNOswmJ . '?op=crawl">Return to crawler page</a>';
} else if (file_exists ( $fn = tuhOqyefnq6RVW . B0tchSNt2Krkc ) && (time () - filemtime ( $fn ) < 10 * 60)) {
	$NgdBMzLLVP5 = true;
	$UhW8Rxuh0rGTpQQ = 1;
}
if ($UhW8Rxuh0rGTpQQ) {
	if ($NgdBMzLLVP5)
		echo '<h4>Crawling already in progress.<br/>Last log access time: ' . date ( 'Y-m-d H:i:s', @filemtime ( $fn ) ) . '<br><small><a href="index.' . $fRRNOswmJ . '?op=crawl&act=interrupt">Click here</a> to interrupt it.</small></h4>';
	else {
		echo '<h4>Please wait. Sitemap generation in progress...</h4>';
		if ($_POST ['bg'])
			echo '<div class="block2head">Please note! The script will run in the background until completion, even if browser window is closed.</div>';
	}
	?>
<iframe style="width: 100%; height: 300px; border: 0px" frameborder=0
	src="index.<?php
	echo $fRRNOswmJ?>?op=crawlproc&bg=<?php
	echo $_POST ['bg']?>&resume=<?php
	echo $_POST ['resume']?>"></iframe>
<?php
} else if (! $qIAc2k9fh0vlEajUm) {
	?>
<div id="sidenote">
<?php
	include KjGb5UkXhbELCFSf . 'page-sitemap-detail.inc.php';
	?>
</div>
<div id="shifted">
<h2>Crawling</h2>
<form action="index.<?php
	echo $fRRNOswmJ?>" method="POST"><input
	type="hidden" name="op" value="crawl">
<div class="inptitle">Run in background</div>
<input type="checkbox" name="bg" value="1" id="in1"><label for="in1"> Do
not interrupt the script even after closing the browser window until the
crawling is complete</label>
<?php
	if (@file_exists ( tuhOqyefnq6RVW . fLu000jqfwiRF )) {
		$h0KbcjRKxhS_ = @twb3vL6xHv65 ( s3wnrrYJ6M1Xfb6_g ( tuhOqyefnq6RVW . fLu000jqfwiRF ) );
		?>
<div class="inptitle">Resume last session</div>
<input type="checkbox" name="resume" value="1" id="in2"><label for="in2"> Continue the interrupted session (<?php
		echo date ( 'Y-m-d H:i:s', filemtime ( tuhOqyefnq6RVW . fLu000jqfwiRF ) )?>, URLs added: <?=count ( $h0KbcjRKxhS_ ['urls_completed'] )?>, estimated URLs left: <?=count ( $h0KbcjRKxhS_ ['urls_list'] ) + count ( $h0KbcjRKxhS_ ['urls_list2'] )?>)</label>
<?php
	}
	?>
<div class="inptitle">Click button below to start crawl manually:</div>
<div class="inptitle"><input class="button" type="submit" name="crawl"
	value="Run" style="width: 150px; height: 30px"></div>
</form>
<h2>Cron job setup</h2>
You can use the following command line to setup the cron job for sitemap
generator:
<div class="inptitle">/usr/local/bin/php <?php
	echo dirname ( dirname ( __FILE__ ) ) . '/runcrawl.php'?></div>
</div>
<?php
}
include KjGb5UkXhbELCFSf . 'page-bottom.inc.php';
?>