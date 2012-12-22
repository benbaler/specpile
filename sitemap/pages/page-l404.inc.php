<?php
include KjGb5UkXhbELCFSf . 'page-top.inc.php';
$AbiyTr9Cb6H08SemlUw = pX3Aht4bffp5cql ();
$pAo1GkXiqGnhFvayP = array_pop ( $AbiyTr9Cb6H08SemlUw );
$Jzvvi5906fScvwvc6H = @unserialize ( s3wnrrYJ6M1Xfb6_g ( tuhOqyefnq6RVW . $pAo1GkXiqGnhFvayP ) );
?>
<div id="maincont">
<h2>Broken Links</h2>
<table>
	<tr class=block1head>
		<th>No</th>
		<th>Broken Link (Code 404)</th>
		<th>Referred from</th>
	</tr>
<?php
for($i = 0; $i < count ( $Jzvvi5906fScvwvc6H ['u404'] ); $i ++) {
	$u4 = $Jzvvi5906fScvwvc6H ['u404'] [$i];
	?>
<tr class=block1>
		<td><?php
	echo $i + 1?></td>
		<td><a
			href="<?php
	echo $Jzvvi5906fScvwvc6H ['initdir']?><?php

	echo $u4 [0]?>"><?php
	echo $u4 [0]?></a></td>
		<td><a
			href="<?php
	echo $Jzvvi5906fScvwvc6H ['initdir']?><?php

	echo $u4 [1]?>"><?php
	echo $u4 [1]?></a></td>
	</tr>
<?php
}
?>
</table>
</div>
<?php
include KjGb5UkXhbELCFSf . 'page-bottom.inc.php';
?>