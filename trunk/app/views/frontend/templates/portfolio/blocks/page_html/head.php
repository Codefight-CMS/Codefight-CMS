<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php if(!isset($meta) || !is_array($meta)): ?>
<?php $meta['title'] = $this->setting->meta_title; ?>
<?php $meta['description'] = $this->setting->meta_description; ?>
<?php $meta['keywords'] = $this->setting->meta_keyword; ?>
<?php endif; ?>

<head>
	<title><?php echo $meta['title']; ?></title>

	<base href="<?php echo base_url(); ?>" />

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="description" content="<?php echo $meta['description']; ?>" />
	<meta name="keywords" content="<?php echo $meta['keywords']; ?>" />
	<?php $corrupted = substr(current_url(), -5); ?>

	<?php if(($this->uri->segment(1) == 'ontheweb') || (isset($noindex) && $noindex == 'yes') || ($corrupted == '_html')): ?>
		<meta name="robots" content="noindex, follow"/>
		<meta name="robots" content="noarchive">
	<?php else: ?>
		<meta name="robots" content="index, follow"/>
	<?php endif; ?>
		<link rel='canonical' href="<?php echo get_canonical_url($meta); ?>" />
	<meta name="robots" content="noodp,noydir" />
	<meta name="revisit-after" content="1 days"/>
	<meta name="generator" content="Codefight CMS" />
    <meta name="vendor" content="<?php echo $this->setting->site_name ?>" />
    <meta name="Language" content="en"/>
	<link href="https://plus.google.com/<?php echo $this->setting->google_plus ?>" rel="publisher" />

 	<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo site_url('feed'); ?>" />

    <!-- twitter card starts -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@codefight">
    <meta name="twitter:creator" content="@dbashyal">
    <meta name="twitter:url" content="<?php echo get_canonical_url(); ?>">
    <meta name="twitter:title" content="<?php echo $meta['title'] . $meta_suffix; ?>">
    <meta name="twitter:description" content="<?php echo $meta['description']; ?>">
    <meta name="twitter:image" content="http://codefight.org/skin/global/images/logo.png">
    <!-- twitter card ends -->



    <link rel="stylesheet" href="<?php echo $this->config->item('skin_url'); ?>skin/frontend/portfolio/css/reset.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?php echo $this->config->item('skin_url'); ?>skin/frontend/portfolio/css/page.css" type="text/css" media="screen">


<!--[if IE 6]> <script src="<?php echo $this->config->item('skin_url'); ?>skin/frontend/portfolio/js/DD_belatedPNG.js"></script> <script>/* EXAMPLE */
		  DD_belatedPNG.fix('*');</script> <link
rel="stylesheet" media="screen" href="ie6.css"/> <![endif]--> <script type="text/javascript" src="<?php echo $this->config->item('skin_url'); ?>skin/frontend/portfolio/js/cufon-yui.js"></script> <script type="text/javascript" src="<?php echo $this->config->item('skin_url'); ?>skin/frontend/portfolio/js/Museo.font.js"></script>

<script type="text/javascript" src="<?php echo $this->config->item('skin_url'); ?>skin/frontend/portfolio/js/DD_roundies.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('skin_url'); ?>skin/frontend/portfolio/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('skin_url'); ?>skin/frontend/portfolio/js/hoverIntent.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('skin_url'); ?>skin/frontend/portfolio/js/superfish.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('skin_url'); ?>skin/frontend/portfolio/js/s3Slider.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('skin_url'); ?>skin/frontend/portfolio/js/custom.js"></script>
<script type="text/javascript">jQuery(document).ready(function($) {
			if($('#slider').length)
			{
				$('#slider').s3Slider({
					timeOut: 5000
				});
			}
		});</script>
<script type='text/javascript' src='<?php echo $this->config->item('skin_url'); ?>skin/frontend/portfolio/js/l10n.js?ver=20101110'></script> <script type='text/javascript' src='<?php echo $this->config->item('skin_url'); ?>skin/frontend/portfolio/js/comment-reply.js?ver=20090102'></script>

	<?php

	//Get Assets (js|css)
	//Library('asset')->get();

	//If head text variable is set, echo it.
	if(isset($head_text)) echo (string)$head_text;

	//Load General_js.php file
	Library('block')->load('includes/general_js');

	//Load Google Analytics
	Library('block')->load('seo/google_analytics'); ?>

	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<script>
		(adsbygoogle = window.adsbygoogle || []).push({
			google_ad_client: "ca-pub-9567128729272204",
			enable_page_level_ads: true
		});
	</script>

</head>
