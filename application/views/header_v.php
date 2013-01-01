<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<html>

<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# 
website: http://ogp.me/ns/website#">

<meta name="description" content="Specpile is the place to search and compare products by specifications">
<meta name="keywords" content="specs, specifications, products specs, products details, products catalog, products compare, iphone vs android, iphone vs galaxy s3, smartphones specs, cell phones specs, cameras specs, tablets specs, specpile">

<meta property="fb:app_id" content="192299124240358"> 
<meta property="og:title" content="<?= $title ?>"/>
<meta property="og:type" content="website"/>
<?php if(isset($images)) : ?>
	<?php foreach ($images as $image) : ?>
	<meta property="og:image" content="<?= base_url($image) ?>"/>
<?php endforeach; ?>
<?php endif; ?>
<meta property="og:site_name" content="Specpile"/>
<?php if(isset($desc)) : ?>
	<meta property="og:description" content="<?= $desc ?>"/>
<?php endif; ?>
<meta name="viewport" content="width=device-width" />

<title><?= $title ?></title>

<link href="/assets/images/favicon.ico" rel="shortcut icon" />
<link rel="apple-touch-icon" href="/assets/images/apple.jpg"/>

<link href="/assets/stylesheets/foundation.css" rel="stylesheet" type="text/css">
<link href="/assets/stylesheets/jquery-ui-1.9.2.custom.css" rel="stylesheet" type="text/css">
<link href="/assets/stylesheets/app.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Varela' rel='stylesheet' type='text/css'>

<script src="/assets/javascripts/libs/head.js" type="text/javascript"></script>
<script src="/assets/javascripts/<?= $app ?>.js" type="text/javascript"></script>

<meta name="google-translate-customization" content="179884778e6bd6e3-c81f9a5c01d3555f-g454c1036cd186837-c"></meta>

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

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=192299124240358";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	</script>

	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
