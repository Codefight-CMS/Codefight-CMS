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
		<link rel='canonical' href="<?php echo get_canonical_url(); ?>" />
	<meta name="robots" content="noodp,noydir" />
	<meta name="revisit-after" content="1 days"/>
	<meta name="generator" content="Codefight CMS" />
    <meta name="vendor" content="<?php echo $this->setting->site_name ?>" />
	<meta name="Language" content="en" />

 	<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo site_url('tools/feed'); ?>" /><?php

	//Get Assets (js|css)
	$this->cf_asset_lib->get();
	
	//If head text variable is set, echo it.
	if(isset($head_text)) echo (string)$head_text;

	//Load General_js.php file
	$this->cf_block_lib->load('includes/general_js');

	//Load Google Analytics
	$this->cf_block_lib->load('seo/google_analytics'); ?>
	
</head>