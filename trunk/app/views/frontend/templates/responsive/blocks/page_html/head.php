<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php if(!isset($meta) || !is_array($meta)): ?>
<?php $meta['title'] = $this->setting->meta_title; ?>
<?php $meta['description'] = $this->setting->meta_description; ?>
<?php $meta['keywords'] = $this->setting->meta_keyword; ?>
<?php endif; ?>

<?php
if(isset($this->setting->meta_suffix))
	$meta_suffix = $this->setting->meta_suffix;
else
	$meta_suffix = ' - ' . strtolower($_SERVER['HTTP_HOST']);
?>

<head profile="http://gmpg.org/xfn/11">




<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php echo $meta['title'] . $meta_suffix; ?></title>

	<base href="<?php echo base_url(); ?>" />

	<meta name="description" content="<?php echo $meta['description']; ?>" />
	<meta name="keywords" content="<?php echo $meta['keywords']; ?>" />
	<?php $corrupted = substr(current_url(), -5); ?>

	<?php if(($this->uri->segment(1) == 'ontheweb') || (isset($noindex) && $noindex == 'yes') || ($corrupted == '_html')): ?>
    <meta name="robots" content="noindex, follow"/>
    <meta name="robots" content="noarchive">
        <?php $noindex = true ?>
	<?php else: ?>
        <?php $noindex = false ?>
    <meta name="robots" content="index, follow"/>
	<?php endif; ?>
    <link rel='canonical' href="<?php echo get_canonical_url($meta); ?>" />
	<meta name="robots" content="noodp,noydir" />
	<meta name="revisit-after" content="1 days"/>
	<meta name="generator" content="Codefight CMS" />
    <meta name="vendor" content="<?php echo $this->setting->site_name ?>" />
    <meta name="Language" content="en"/>

    <!-- Add the following three tags inside head -->
    <meta itemprop="name" content="<?php echo $meta['title'] . $meta_suffix; ?>">
    <meta itemprop="description" content="<?php echo $meta['description']; ?>">
    <meta itemprop="image" content="<?php echo getCurrentPageScreenshot($noindex) ?>">

    <meta property="og:title" content="<?php echo $meta['title'] . $meta_suffix; ?>" />
    <meta property="og:description" content="<?php echo $meta['description']; ?>" />
    <meta property="og:image" content="<?php echo getCurrentPageScreenshot($noindex) ?>" />

    <link href="https://plus.google.com/<?php echo $this->setting->google_plus ?>" rel="publisher" />

    <!-- twitter card starts -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@codefight">
    <meta name="twitter:creator" content="@dbashyal">
    <meta name="twitter:url" content="<?php echo get_canonical_url(); ?>">
    <meta name="twitter:title" content="<?php echo $meta['title'] . $meta_suffix; ?>">
    <meta name="twitter:description" content="<?php echo $meta['description']; ?>">
    <meta name="twitter:image" content="<?php echo getCurrentPageScreenshot($noindex) ?>">
    <!-- twitter card ends -->


 	<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo site_url('feed'); ?>" /><?php

	//Get Assets (js|css)
	Library('asset')->get();

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
