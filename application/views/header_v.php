<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<html>
<head>
	<meta name="viewport" content="width=device-width" />
	
	<link href="/assets/stylesheets/foundation.css" rel="stylesheet" type="text/css">
	<link href="/assets/stylesheets/jquery-ui-1.9.2.custom.css" rel="stylesheet" type="text/css">
	<link href="/assets/stylesheets/app.css" rel="stylesheet" type="text/css">

	<script src="/assets/javascripts/libs/head.js" type="text/javascript"></script>
	<script src="/assets/javascripts/<?= $app ?>.js" type="text/javascript"></script>
</head>
<body>
	<script type="text/javascript">

	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-36162016-1']);
	_gaq.push(['_setDomainName', 'specpile.com']);
	_gaq.push(['_trackPageview']);

	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();

	</script>
