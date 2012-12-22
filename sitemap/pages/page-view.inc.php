<?php
include KjGb5UkXhbELCFSf . 'page-top.inc.php';
?>
<div id="sidenote">
<?php
include KjGb5UkXhbELCFSf . 'page-sitemap-detail.inc.php';
?>
</div>
<div id="shifted">
<h2>View Sitemap</h2>
<div class="inptitle">HTML SiteMap</div>
<h4><a href="<?php
echo $grab_parameters ['htmlurl']?>"><?php
echo $grab_parameters ['htmlurl']?></a></h4>
<div class="inptitle">Text SiteMap</div>
<h4><a href="<?php
echo s1Cp0mMqugf8HmPN . $h8i3gNivayoQQtqpLY;
?>"><?php
echo $grab_parameters ['xs_sm_text_url'] ? '' : $REpEqrxI7DpN9 . '/'?><?php

echo s1Cp0mMqugf8HmPN . $h8i3gNivayoQQtqpLY;
?></a></h4>
<div class="inptitle">ROR SiteMap</div>
<h4><a href="<?php
echo LlGUdFg6y3le5XQDj5;
?>"><?php
echo LlGUdFg6y3le5XQDj5;
?></a></h4>
<!--<div class="inptitle">Google Base Feed (RSS)</div>
<h4><a href="<?php
echo WaHQCDK4QrZX . $h8i3gNivayoQQtqpLY;
?>"><?php
echo $kEM8KMpb9E . '/'?><?php

echo WaHQCDK4QrZX . $h8i3gNivayoQQtqpLY;
?></a></h4>
-->
<?php
for($i = 0; $i < count ( $Jzvvi5906fScvwvc6H ['files'] ); $i ++) {
	$W5mf7Y9Huk0KaQU6 = $Jzvvi5906fScvwvc6H ['files'] [$i];
	$fl = tuhOqyefnq6RVW . basename ( $W5mf7Y9Huk0KaQU6 );
	$C1ZRyst7ZYH = $i == 0 && count ( $Jzvvi5906fScvwvc6H ['files'] ) > 1;
	$D1tXUjHdde7g1 = strstr ( $fl, '.gz' ) ? implode ( '', gzfile ( $fl ) ) : s3wnrrYJ6M1Xfb6_g ( $fl );
	?>
<div class="inptitle"><?php
	echo $i + 1?>. XML SiteMap <?php
	echo $C1ZRyst7ZYH ? 'Index' : 'File'?></div>
<h4><a href="<?php
	echo $W5mf7Y9Huk0KaQU6?>"><?php
	echo $W5mf7Y9Huk0KaQU6?></a>
</h4>
<textarea style="width: 100%; height: 300px"><?php
	echo htmlspecialchars ( $D1tXUjHdde7g1 )?></textarea>
<?php
}
?>
</div>
<?php
include KjGb5UkXhbELCFSf . 'page-bottom.inc.php';
?>