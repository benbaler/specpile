<?php
include KjGb5UkXhbELCFSf . 'page-top.inc.php';
$AbiyTr9Cb6H08SemlUw = pX3Aht4bffp5cql ();
if ($grab_parameters ['xs_chlogorder'] == 'desc')
	rsort ( $AbiyTr9Cb6H08SemlUw );
$sc_VvX5jelp2 = $_GET ['log'];
if ($sc_VvX5jelp2) {
	?>
<div id="sidenote">
<div class="block1head">Crawler logs</div>
<div class="block1">
<?php
	for($i = 0; $i < count ( $AbiyTr9Cb6H08SemlUw ); $i ++) {
		$Jzvvi5906fScvwvc6H = @unserialize ( s3wnrrYJ6M1Xfb6_g ( tuhOqyefnq6RVW . $AbiyTr9Cb6H08SemlUw [$i] ) );
		if ($i + 1 == $sc_VvX5jelp2)
			echo '<u>';
		?>
<a href="index.<?php
		echo $fRRNOswmJ?>?op=chlog&log=<?php
		echo $i + 1?>"
	title="View details"><?php
		echo date ( 'Y-m-d H:i', $Jzvvi5906fScvwvc6H ['time'] )?></a>
( +<?php
		echo count ( $Jzvvi5906fScvwvc6H ['newurls'] )?> -<?php
		echo count ( $Jzvvi5906fScvwvc6H ['losturls'] )?>)
</u> <br>
<?php
	}
	?>
</div>
</div>
<?php
}
?>
<div id="shifted">
<h2>ChangeLog</h2>
<?php
if ($sc_VvX5jelp2) {
	$Jzvvi5906fScvwvc6H = @unserialize ( s3wnrrYJ6M1Xfb6_g ( tuhOqyefnq6RVW . $AbiyTr9Cb6H08SemlUw [$sc_VvX5jelp2 - 1] ) );
	?><h4><?php
	echo date ( 'j F Y, H:i', $Jzvvi5906fScvwvc6H ['time'] )?></h4>
<div class="inptitle">New URLs (<?php
	echo count ( $Jzvvi5906fScvwvc6H ['newurls'] )?>)</div>
<textarea style="width: 100%; height: 300px"><?php
	echo @htmlspecialchars ( implode ( "\n", $Jzvvi5906fScvwvc6H ['newurls'] ) )?></textarea>
<div class="inptitle">Removed URLs (<?php
	echo count ( $Jzvvi5906fScvwvc6H ['losturls'] )?>)</div>
<textarea style="width: 100%; height: 300px"><?php
	echo @htmlspecialchars ( implode ( "\n", $Jzvvi5906fScvwvc6H ['losturls'] ) )?></textarea>
<?php
} else {
	?>
<table>
	<tr class=block1head>
		<th>No</th>
		<th>Date/Time</th>
		<th>Total pages</th>
		<th>Proc.time</th>
		<th>Bandwidth</th>
		<th>New URLs</th>
		<th>Removed URLs</th>
		<th>Broken links</th>
	</tr>
<?php
	$HcbfVH7j0 = array ();
	for($i = 0; $i < count ( $AbiyTr9Cb6H08SemlUw ); $i ++) {
		$Jzvvi5906fScvwvc6H = @unserialize ( s3wnrrYJ6M1Xfb6_g ( tuhOqyefnq6RVW . $AbiyTr9Cb6H08SemlUw [$i] ) );
		if (! $Jzvvi5906fScvwvc6H)
			continue;
		foreach ( $Jzvvi5906fScvwvc6H as $k => $v )
			if (! is_array ( $v ))
				$HcbfVH7j0 [$k] += $v;
			else
				$HcbfVH7j0 [$k] += count ( $v );
		?>
<tr class=block1>
		<td><?php
		echo $i + 1?></td>
		<td><a href="index.php?op=chlog&log=<?php
		echo $i + 1?>"
			title="View details"><?php
		echo date ( 'Y-m-d H:i', $Jzvvi5906fScvwvc6H ['time'] )?></a></td>
		<td><?php
		echo number_format ( $Jzvvi5906fScvwvc6H ['ucount'] )?></td>
		<td><?php
		echo number_format ( $Jzvvi5906fScvwvc6H ['ctime'], 2 )?>s</td>
		<td><?php
		echo number_format ( $Jzvvi5906fScvwvc6H ['tsize'] / 1024 / 1024, 2 )?></td>
		<td><?php
		echo count ( $Jzvvi5906fScvwvc6H ['newurls'] )?></td>
		<td><?php
		echo count ( $Jzvvi5906fScvwvc6H ['losturls'] )?></td>
		<td><?php
		echo count ( $Jzvvi5906fScvwvc6H ['u404'] )?></td>
	</tr>
<?php
	}
	?>
<tr class=block1>
		<th colspan=2>Total</th>
		<th><?php
	echo number_format ( $HcbfVH7j0 ['ucount'] )?></th>
		<th><?php
	echo number_format ( $HcbfVH7j0 ['ctime'], 2 )?>s</th>
		<th><?php
	echo number_format ( $HcbfVH7j0 ['tsize'] / 1024 / 1024, 2 )?> Mb</th>
		<th><?php
	echo ($HcbfVH7j0 ['newurls'])?></th>
		<th><?php
	echo ($HcbfVH7j0 ['losturls'])?></th>
		<th>-</th>
	</tr>
</table>
<?php
}
?>
</div>
<?php
include KjGb5UkXhbELCFSf.'page-bottom.inc.php';
?>