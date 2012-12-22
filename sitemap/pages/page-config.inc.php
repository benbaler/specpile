<?php
if (! defined ( 'FyqopbSBljsknT1TH' ))
	exit ();
$HuD2wJN0EuqGM6r = $fDfweZzwnbqVpWJD9 = '';
if (! is_writable ( xGdDP35EpCBxUGx )) {
	$HuD2wJN0EuqGM6r .= '<br>Config file is not writable: <b>' . xGdDP35EpCBxUGx . '</b>';
}
if (! is_writable ( tuhOqyefnq6RVW )) {
	$HuD2wJN0EuqGM6r .= '<br>Datastorage folder is not writable: <b>' . tuhOqyefnq6RVW . '</b>';
}

if (isset ( $_POST ['save'] ) && is_writable ( xGdDP35EpCBxUGx )) {
	$grab_parameters ['xs_initurl'] = trim ( $_POST ['initurl'] );
	$grab_parameters ['xs_freq'] = $_POST ['freq'];
	$grab_parameters ['xs_lastmod'] = $_POST ['lastmod'];
	$grab_parameters ['xs_lastmodtime'] = $_POST ['lastmodtime'];
	$grab_parameters ['xs_priority'] = $_POST ['priority'];
	$grab_parameters ['xs_autopriority'] = $_POST ['autopriority'] ? 1 : 0;
	$grab_parameters ['xs_max_pages'] = $_POST ['max_pages'];
	$grab_parameters ['xs_max_depth'] = $_POST ['max_depth'];
	$grab_parameters ['xs_exec_time'] = $_POST ['exec_time'];
	$grab_parameters ['xs_memlimit'] = $_POST ['mem_limit'];
	$grab_parameters ['xs_savestate_time'] = $_POST ['savestate_time'];
	$grab_parameters ['xs_delay_req'] = $_POST ['delay_req'];
	$grab_parameters ['xs_delay_ms'] = $_POST ['delay_ms'];
	$grab_parameters ['xs_yping'] = $_POST ['hZahAndvJ'];
	$grab_parameters ['xs_smname'] = $_POST ['smname'];
	$grab_parameters ['xs_excl_urls'] = $_POST ['excl_urls'];
	$grab_parameters ['xs_incl_urls'] = $_POST ['incl_urls'];
	$grab_parameters ['xs_incl_only'] = $_POST ['incl_only'];
	$grab_parameters ['xs_ind_attr'] = $_POST ['ind_attr'];
	$grab_parameters ['xs_smurl'] = $_POST ['smurl'];
	$grab_parameters ['xs_login'] = $_POST ['xslogin'];
	$grab_parameters ['xs_password'] = $_POST ['xspassword'];
	$grab_parameters ['xs_email'] = $_POST ['xsemail'];
	$grab_parameters ['xs_gping'] = $_POST ['gping'] ? 1 : 0;
	$grab_parameters ['xs_chlog'] = $_POST ['gchlog'] ? 1 : 0;
	$grab_parameters ['xs_makeror'] = $_POST ['makeror'] ? 1 : 0;
	$grab_parameters ['xs_maketxt'] = $_POST ['maketxt'] ? 1 : 0;
	
	$grab_parameters ['xs_makehtml'] = $_POST ['makehtml'] ? 1 : 0;
	$grab_parameters ['xs_htmlname'] = $_POST ['htmlname'];
	$grab_parameters ['xs_htmlpart'] = $_POST ['htmlpart'];
	$grab_parameters ['xs_compress'] = $_POST ['compress'] ? 1 : 0;
	$grab_parameters ['xs_inc_skip'] = '\.(' . preg_replace ( '#\s+#', '|', trim ( $_POST ['incl'] ) ) . ')';
	$grab_parameters ['xs_exc_skip'] = '\.(' . preg_replace ( '#\s+#', '|', trim ( $_POST ['excl'] ) ) . ')';
	$grab_parameters ['xs_dumptype'] = $_POST ['storage'];
	$grab_parameters ['xs_ipconnection'] = $_POST ['ipaddr'];
	$grab_parameters ['xs_cleanpar'] = preg_replace ( '#\s+#', '|', trim ( $_POST ['cleanpar'] ) );
	$grab_parameters ['xs_metadesc'] = $_POST ['metadesc'] ? 1 : 0;
	$ws = "<?php\n\$" . "grab_parameters = " . gAJrAJst76NwxR ( $grab_parameters ) . ";\n?>";
	$pf = fopen ( xGdDP35EpCBxUGx, 'w' );
	fwrite ( $pf, $ws );
	fclose ( $pf );
	$fDfweZzwnbqVpWJD9 = 'Configuration has been saved';
}
$AbiyTr9Cb6H08SemlUw = pX3Aht4bffp5cql ();
if (count ( $AbiyTr9Cb6H08SemlUw ) > 0) {
	$pAo1GkXiqGnhFvayP = array_pop ( $AbiyTr9Cb6H08SemlUw );
	$Jzvvi5906fScvwvc6H = @unserialize ( s3wnrrYJ6M1Xfb6_g ( tuhOqyefnq6RVW . $pAo1GkXiqGnhFvayP ) );
}
$gnFe1_ACf3THo5fSVT = $grab_parameters ['xs_smname'];
if ($grab_parameters ['xs_compress'])
	$x0KYUlJb0P926oU = '.gz';
$DetHfLuiy2rm = $grab_parameters ['xs_sm_size'] ? $grab_parameters ['xs_sm_size'] : 50000;
for($i = 0; $i < ceil ( $Jzvvi5906fScvwvc6H ['ucount'] / $DetHfLuiy2rm ); $i ++) {
	$YU8s83esIfxy544ZH = (($Jzvvi5906fScvwvc6H ['ucount'] > $DetHfLuiy2rm) ? Z4L1ygR2lvr3j2UGWEK ( $i + 1, $gnFe1_ACf3THo5fSVT ) : $gnFe1_ACf3THo5fSVT) . $x0KYUlJb0P926oU;
	if (! is_writable ( $YU8s83esIfxy544ZH ) && ! is_writable ( dirname ( $YU8s83esIfxy544ZH ) ))
		$HuD2wJN0EuqGM6r .= '<br>Sitemap file is not writable: <b>' . $YU8s83esIfxy544ZH . '</b>';
}
$DetHfLuiy2rm = $grab_parameters ['xs_htmlpart'];
$gnFe1_ACf3THo5fSVT = $grab_parameters ['xs_htmlname'];
for($i = 0; $i < ceil ( $Jzvvi5906fScvwvc6H ['ucount'] / $DetHfLuiy2rm ); $i ++) {
	$YU8s83esIfxy544ZH = (($Jzvvi5906fScvwvc6H ['ucount'] > $DetHfLuiy2rm) ? Z4L1ygR2lvr3j2UGWEK ( $i + 1, $gnFe1_ACf3THo5fSVT, true ) : $gnFe1_ACf3THo5fSVT);
	if (! is_writable ( $YU8s83esIfxy544ZH ) && ! is_writable ( dirname ( $YU8s83esIfxy544ZH ) ))
		$HuD2wJN0EuqGM6r .= '<br>Sitemap file is not writable: <b>' . $YU8s83esIfxy544ZH . '</b>';
}
include KjGb5UkXhbELCFSf . 'page-top.inc.php';
?>
<div id="sidenote">
<?php
include KjGb5UkXhbELCFSf . 'page-sitemap-detail.inc.php';
?>
<div class="block1head">What is "Initial URL"?</div>
<div class="block1">Please enter the <b>full</b> http address for your
site, only the links within the starting directory will be included.</div>
<div class="block1head">What is "Change frequency"?</div>
<div class="block1">This value indicates how frequently the content at a
particular URL is likely to change.</div>
<div class="block1head">What is "Last Modified"?</div>
<div class="block1">The time the URL was last modified. You can let the
generator set this field from your server's response headers or to
specify your own date and time.</div>
<div class="block1head">What is "Priority"?</div>
<div class="block1">The priority of a particular URL relative to other
pages on the same site. The value for this tag is a number between 0.0
and 1.0.</div>
<div class="block1head">What is "Do not parse"?</div>
<div class="block1">These URLs will be included into sitemap, but not
fetched by the crawler.</div>
<div class="block1head">What is "Exclude extensions"?</div>
<div class="block1">These URLs will be skipped and not added to sitemap.
</div>
<div class="block1head">What is "Maximum pages"?</div>
<div class="block1">This will limit the number of pages crawled. You can
enter "-1" value for unlimited crawling.</div>
<div class="block1head">What is "Save sitemap to"?</div>
<div class="block1">Please enter the filename to store sitemap to. This
file should reside in the root folder of your website.</div>
<div class="block1head">What is "Inform Google.."?</div>
<div class="block1">It's required to let Google know that your sitemap
is ready. Specify your full sitemap URL to let script do this or apply
for this manually <a href="http://www.google.com/webmasters/sitemaps">here</a>.
</div>
</div>
<div id="shifted">
<?php
if ($HuD2wJN0EuqGM6r) {
	?>
<div class="block2head">An error occured</div>
<div class="block1">
<?php
	echo $HuD2wJN0EuqGM6r?>
</div>
<?php
}
?>
<?php

if ($fDfweZzwnbqVpWJD9) {
	?>
<div class="block1head">Note</div>
<div class="block1">
<?php
	echo $fDfweZzwnbqVpWJD9?>
</div>
<?php
}
?>
<h2>Configuration</h2>
<form action="index.<?php
echo $fRRNOswmJ?>" method="POST"><input
	type="hidden" name="op" value="<?php
	echo $op?>">
<h3>General Parameters</h3>
<div class="inptitle">Starting URL:</div>
<input type="text" name="initurl" size="70"
	value="<?php
	echo $grab_parameters ['xs_initurl']?>">
<div class="inptitle">Save sitemap to:</div>
<input type="text" name="smname" size="70"
	value="<?php
	echo $grab_parameters ['xs_smname']?>"> <br>
<small>
Current path to Sitemap generator is: <?php
echo dirname ( dirname ( __FILE__ ) )?>/
</small>
<div class="inptitle">Your Sitemap URL:</div>
<input type="text" name="smurl" size="70"
	value="<?php
	echo $grab_parameters ['xs_smurl']?>">
<div class="inptitle">Create Text Sitemap:</div>
<input type="checkbox" name="maketxt"
	<?php
	echo $grab_parameters ['xs_maketxt'] ? 'checked' : ''?> id="in11"><label
	for="in11"> Create sitemap in Text format</label>
<div class="inptitle">Create ROR Sitemap:</div>
<input type="checkbox" name="makeror"
	<?php
	echo $grab_parameters ['xs_makeror'] ? 'checked' : ''?> id="in13"><label
	for="in13"> Create sitemap in ROR format</label> <br>
<small>It will be stored in the same folder as XML sitemap, but with
different filename: ror.xml</small> <!--
<div class="inptitle">Create Google Base Feed (RSS):</div>
<input type="checkbox" name="makebase" <?php
echo $grab_parameters ['xs_makebase'] ? 'checked' : ''?> id="in113"><label for="in113"> Create feed for Google Base</label>
<br><small>It will be stored in the data/ folder with filename: gbase.xml</small>
-->
<div class="inptitle">Create HTML Sitemap:</div>
<input type="checkbox" name="makehtml"
	<?php
	echo $grab_parameters ['xs_makehtml'] ? 'checked' : ''?> id="in12"><label
	for="in12"> Create html site map for your normal visitors</label> <br>
<small>Please note that this option requires additional resources to
perform</small>
<div class="inptitle">HTML Sitemap filename:</div>
<input type="text" name="htmlname"
	value="<?php
	echo $grab_parameters ['xs_htmlname']?>" size="70"> <br />
<br />
<br />
<br />
<h3><a href="javascript:cgLIwWkdMqHAs('configattr')">[+]</a> Sitemap
Entry Attributes (optional section)</h3>
<div id="configattr">
<div class="inptitle">Change frequency:</div>
<select name="freq">
	<option value="">Do not specify</option>
<?php
$zSyg85rKFKJ8zd = array ('Always', 'Hourly', 'Daily', 'Weekly', 'Monthly', 'Yearly', 'Never' );
foreach ( $zSyg85rKFKJ8zd as $fa )
	echo '
<option value="' . strtolower ( $fa ) . '"' . (strtolower ( $fa ) == $grab_parameters ['xs_freq'] ? ' selected' : '') . '>' . $fa . '</option>';
?>
</select>
<?php
$F8eE_Rqcrb = substr ( str_replace ( '|', ' ', $grab_parameters ['xs_inc_skip'] ), 3, - 1 );
$fweJBhwTM1h = substr ( str_replace ( '|', ' ', $grab_parameters ['xs_exc_skip'] ), 3, - 1 );
$lm = $grab_parameters ['xs_lastmod'];
$J_IeOwjAksjM = $grab_parameters ['xs_lastmodtime'];
?>
<div class="inptitle">Last modification:</div>
<input <?php
echo $lm == 0 ? ' checked' : ''?> type="radio" name="lastmod"
	value="0" id="lm1"><label for="lm1"> None</label> <br>
<input <?php
echo $lm == 1 ? ' checked' : ''?> type="radio" name="lastmod"
	value="1" id="lm2"><label for="lm2"> Use server's response</label> <br>
<input <?php
echo $lm == 2 ? ' checked' : ''?> type="radio" name="lastmod"
	value="2" id="lm3"><label for="lm3"> Use current time</label> <br>
<input <?php
echo $lm == 3 ? ' checked' : ''?> type="radio" name="lastmod"
	value="3" id="lm4"><label for="lm4"> Use this date/time:</label> <input
	type="text" name="lastmodtime" size=30
	value="<?php
	echo $J_IeOwjAksjM ? $J_IeOwjAksjM : date ( 'Y-m-d H:i:s' )?>">
<div class="inptitle">Priority:</div>
<input type="text" name="priority" size="5"
	value="<?php
	echo $grab_parameters ['xs_priority']?>">
<div class="inptitle">Automatic Priority:</div>
<input type="checkbox" name="autopriority"
	<?php
	echo $grab_parameters ['xs_autopriority'] ? 'checked' : ''?>
	id="autopriority"><label for="autopriority"> Automatically assign
priority attribute</label> <br>
<small>Enable this option to automatically reduce priority depending on
the page's depth level</small>
<div class="inptitle">Individual attributes:</div>
<textarea name="ind_attr" rows="4" cols="40"><?php
echo $grab_parameters ['xs_ind_attr']?></textarea>
<br>
<small>define specific frequency and priority attributes here in the
following format: <br />
"url substring,lastupdate YYYY-mm-dd,frequency,priority". <br />
<b>example:</b> <br />
page.php?product=,2005-11-14,monthly,0.9 </small> <br />
<br />
<br />
</div>
<h3>Miscellaneous Definitions (optional section)</h3>
<div class="inptitle">Require authorization to access generator
interface:</div>
Login:<br />
<input type="text" name="xslogin"
	value="<?php
	echo $grab_parameters ['xs_login']?>" size="70"> <br />
Password:<br />
<input type="password" name="xspassword"
	value="<?php
	echo $grab_parameters ['xs_password']?>" size="70"> <br />
<div class="inptitle">Send email notifications:</div>
<input type="text" name="xsemail"
	value="<?php
	echo $grab_parameters ['xs_email']?>" size="70"> <br />
<div class="inptitle">Number of links per page in HTML sitemap:</div>
<input type="text" name="htmlpart" size="5"
	value="<?php
	echo $grab_parameters ['xs_htmlpart']?>"> <br>
<small>(that will split your sitemap on several pages)</small>
<div class="inptitle">Compress sitemap using GZip:</div>
<input type="checkbox" name="compress"
	<?php
	echo $grab_parameters ['xs_compress'] ? 'checked' : ''?> id="in1"><label
	for="in1"> Use sitemap files compression</label> <br>
<small>(".gz" will be added to all filenames automatically)</small>
<div class="inptitle">Inform (ping) Search Engines upon completion
(Google, Yahoo, Ask, Moreover):</div>
<input type="checkbox" name="gping"
	<?php
	echo $grab_parameters ['xs_gping'] ? 'checked' : ''?> id="in2"><label
	for="in2"> Ping Search Engines when generation is done</label> <br>
<div class="inptitle">Calculate changelog:</div>
<input type="checkbox" name="gchlog"
	<?php
	echo $grab_parameters ['xs_chlog'] ? 'checked' : ''?> id="in3"><label
	for="in3"> Calculate Change Log after completion</label> <br>
<small>please note that this option requires more resources to complete</small>
<br />
<br />
<h3>Narrow Indexed Pages Set (optional section)</h3>
<div class="inptitle">Exclude from sitemap extensions:</div>
<input type="text" name="excl" size="90"
	value="<?php
	echo $fweJBhwTM1h?>"> <br>
<small>these URLs are NOT included in sitemap</small>
<div class="inptitle">Do not parse extensions:</div>
<input type="text" name="incl" size="90"
	value="<?php
	echo $F8eE_Rqcrb?>"> <br>
<small>these URLs ARE included in sitemap, although not retrieved from
server</small>
<div class="inptitle">Exclude URLs:</div>
<textarea name="excl_urls" rows="4" cols="40"><?php
echo $grab_parameters ['xs_excl_urls']?></textarea>
<br>
<small>do NOT include URLs that contain these substrings, one string per
line</small>
<div class="inptitle">Do not parse URLs:</div>
<textarea name="incl_urls" rows="3" cols="40"><?php
echo $grab_parameters ['xs_incl_urls']?></textarea>
<br>
<small>do not retrieve pages that contain these substrings in URL, but
still INCLUDE them in sitemap</small>
<div class="inptitle">"Include ONLY" URLs:</div>
<input type="text" name="incl_only" size="90"
	value="<?php
	echo $grab_parameters ['xs_incl_only']?>"> <br>
<small>leave this field empty by default. Fill it if you would like to
include into sitemap ONLY those URls that match the specified string.</small>
<br />
<br />
<br />
<h3><a href="javascript:cgLIwWkdMqHAs('configopt')">[+]</a> Crawler
Limitations, Finetune (optional section)</h3>
<div id="configopt">
<div class="inptitle">Maximum pages:</div>
<input type="text" name="max_pages" size="5"
	value="<?php
	echo $grab_parameters ['xs_max_pages']?>"> <small>"0" for
unlimited</small>
<div class="inptitle">Maximum depth level:</div>
<input type="text" name="max_depth" size="5"
	value="<?php
	echo $grab_parameters ['xs_max_depth']?>"> <small>"0" for
unlimited</small>
<div class="inptitle">Maximum execution time, seconds:</div>
<input type="text" name="exec_time" size="5"
	value="<?php
	echo $grab_parameters ['xs_exec_time']?>"> <small>"0" for
unlimited</small>
<div class="inptitle">Maximum memory usage, MB:</div>
<input type="text" name="mem_limit" size="5"
	value="<?php
	echo $grab_parameters ['xs_memlimit']?>"> <small>"0" for
default. Note: might not work depending on the server configuration.</small>
<div class="inptitle">Save the script state, every X seconds:</div>
<input type="text" name="savestate_time" size="5"
	value="<?php
	echo $grab_parameters ['xs_savestate_time']?>"> <small>this
option allows to resume crawling operation if it was interrupted. "0"
for no saves</small>
<div class="inptitle">Make a delay between requests, X seconds after
each N requests:</div>
<input type="text" name="delay_ms" size="5"
	value="<?php
	echo $grab_parameters ['xs_delay_ms']?>"> s after each <input
	type="text" name="delay_req" size="5"
	value="<?php
	echo $grab_parameters ['xs_delay_req']?>"> requests <br />
<small>This option allows to reduce the load on your webserver. "0" for
no delay</small></div>
<h3><a href="javascript:cgLIwWkdMqHAs('configopt2')">[+]</a> Advanced
Settings (optional section)</h3>
<div id="configopt2">
<div class="inptitle">Extract meta description tag</div>
<input type="checkbox" name="metadesc"
	<?php
	echo $grab_parameters ['xs_metadesc'] ? 'checked' : ''?>
	id="inmetadesc"><label for="inmetadesc"> enable META descriptions</label>
<br />
<small>Note: this option may significantly increase memory usage and is
not recommended for larger sitemaps</small>
<div class="inptitle">Use IP address for crawling:</div>
<input type="text" name="ipaddr" size="40"
	value="<?php
	echo $grab_parameters ['xs_ipconnection']?>">
<?
$ZzK9F0w61vlwMN = str_replace ( '|', ' ', $grab_parameters ['xs_cleanpar'] );
?>
<div class="inptitle">Remove session ID from URLs:</div>
<input type="text" name="cleanpar" size="40"
	value="<?php
	echo $ZzK9F0w61vlwMN?>"> <br />
<small>common session parameters (separate with spaces): PHPSESSID, sid,
osCsid</small>
<div class="inptitle">Progress state storage type:</div>
<input type="radio" name="storage" value="serialize" id="stor01"
	<?php
	echo $grab_parameters ['xs_dumptype'] == 'serialize' ? ' checked' : ''?>><label
	for="stor01"> serialize</label> <input type="radio" name="storage"
	value="varexport" id="stor02"
	<?php
	echo $grab_parameters ['xs_dumptype'] != 'serialize' ? ' checked' : ''?>><label
	for="stor02"> var_export</label> <br />
<small>try to change this option in case of memory usage issues</small>
</div>
<div class="inptitle"><input class="button" type="submit" name="save"
	value="Save" style="width: 150px; height: 30px"></div>
</form>
<script language="Javascript">
<!--
function cgLIwWkdMqHAs(eid)
{
gel = document.getElementById(eid)
gel.style.display = gel.style.display ? '' : 'none'
}
cgLIwWkdMqHAs('configopt')
cgLIwWkdMqHAs('configopt2')
cgLIwWkdMqHAs('configattr')

</script></div>
<?php
include KjGb5UkXhbELCFSf.'page-bottom.inc.php';
?>