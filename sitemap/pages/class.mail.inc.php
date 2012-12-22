<?php
class GenMail {
	function nE6WfY32ZiCs($Jzvvi5906fScvwvc6H) {
		global $grab_parameters, $REpEqrxI7DpN9;
		if (! $grab_parameters ['xs_email'])
			return;
		$UHng1R6Q0JJCH1rjl = 'Standalone Sitemap Generator Report';
		$h8i3gNivayoQQtqpLY = $grab_parameters ['xs_compress'] ? '.gz' : '';
		$Kl6oIfEwKD_U = 'Hello,
you have configured your sitemap generator to receive these automated notifications every time sitemap is created.
' . $UHng1R6Q0JJCH1rjl . ' - ' . date ( 'j F Y, H:i' ) . '

-------------------------
Sitemap details
-------------------------
Request date: ' . date ( 'j F Y, H:i', $Jzvvi5906fScvwvc6H ['time'] ) . '
Processing time: ' . sprintf ( '%1.2f', $Jzvvi5906fScvwvc6H ['ctime'] ) . 's
Pages indexed: ' . $Jzvvi5906fScvwvc6H ['ucount'] . '
Sitemap files: ' . count ( $Jzvvi5906fScvwvc6H ['files'] ) . '
Pages size: ' . number_format ( $Jzvvi5906fScvwvc6H ['tsize'] / 1024 / 1024, 2 ) . 'Mb
-------------------------
View Sitemaps
-------------------------
XML Sitemap
' . $grab_parameters ['xs_smurl'] . '
Text Sitemap
' . ($grab_parameters ['xs_sm_text_url'] ? '' : $REpEqrxI7DpN9 . '/') . s1Cp0mMqugf8HmPN . $h8i3gNivayoQQtqpLY . '
ROR Sitemap
' . LlGUdFg6y3le5XQDj5 . $h8i3gNivayoQQtqpLY . '
HTML Sitemap
' . $grab_parameters ['htmlurl'] . '
-------------------------
Broken Links
-------------------------
' . (count ( $Jzvvi5906fScvwvc6H ['u404'] ) ? count ( $Jzvvi5906fScvwvc6H ['u404'] ) . ' broken links found!
View the list: ' . $REpEqrxI7DpN9 . '/index.' . $fRRNOswmJ . '?op=l404' : 'None found
--------------------------------------------------
End Of Report
Thank you for using Standalone Sitemap Generator
');
		mail ( $grab_parameters ['xs_email'], $UHng1R6Q0JJCH1rjl, $Kl6oIfEwKD_U, 'From: ' . $grab_parameters ['xs_email'] );
	}
}
$fGokyqo8tR33zzFafi3 = new GenMail ( );
?>