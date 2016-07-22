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

	<title><?php echo $meta['title'] . $meta_suffix; ?></title>

	<base href="<?php echo base_url(); ?>" />

	<meta name="description" content="<?php echo $meta['description']; ?>" />
	<meta name="keywords" content="<?php echo $meta['keywords']; ?>" />
	<?php $corrupted = substr(current_url(), -5); ?>

	<?php if(($this->uri->segment(1) == 'ontheweb') || (isset($noindex) && $noindex == 'yes') || ($corrupted == '_html')): ?>
    <meta name="robots" content="noindex, nofollow"/>
    <meta name="robots" content="noarchive">
	<?php else: ?>
    <meta name="robots" content="index, follow"/>
	<?php endif; ?>
    <link rel='canonical' href="<?php echo get_canonical_url(); ?>" />
	<meta name="robots" content="noodp,noydir" />
	<meta name="revisit-after" content="1 days"/>
	<meta name="generator" content="Codefight CMS" />
    <meta name="vendor" content="<?php echo $this->setting->site_name ?>" />
    <meta name="Language" content="en"/>

    <!-- Add the following three tags inside head -->
    <meta itemprop="name" content="<?php echo $meta['title'] . $meta_suffix; ?>">
    <meta itemprop="description" content="<?php echo $meta['description']; ?>">
    <meta itemprop="image" content="https://chart.googleapis.com/chart?chs=500x500&cht=qr&choe=UTF-8&chl=<?php echo urlencode(current_url()) ?>">

    <meta property="og:title" content="<?php echo $meta['title'] . $meta_suffix; ?>" />
    <meta property="og:description" content="<?php echo $meta['description']; ?>" />
    <meta property="og:image" content="https://chart.googleapis.com/chart?chs=500x500&cht=qr&choe=UTF-8&chl=<?php echo urlencode(current_url()) ?>" />

    <link href="https://plus.google.com/<?php echo $this->setting->google_plus ?>" rel="publisher" />

    <!-- twitter card starts -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@codefight">
    <meta name="twitter:creator" content="@dbashyal">
    <meta name="twitter:url" content="<?php echo get_canonical_url(); ?>">
    <meta name="twitter:title" content="<?php echo $meta['title'] . $meta_suffix; ?>">
    <meta name="twitter:description" content="<?php echo $meta['description']; ?>">
    <meta name="twitter:image" content="https://chart.googleapis.com/chart?chs=500x500&cht=qr&choe=UTF-8&chl=<?php echo urlencode(current_url()) ?>">
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

        <script type="text/javascript" src="<?php echo skin_url('global') ?>js/share.mini.js"></script>

<!-- Place this tag in the <head> of your document -->
<script type="text/javascript">
window.___gcfg = {lang: 'en'};
(function()
{var po = document.createElement("script");
po.type = "text/javascript"; po.async = true;po.src = "https://apis.google.com/js/plusone.js";
var s = document.getElementsByTagName("script")[0];
s.parentNode.insertBefore(po, s);
})();</script>

<!-- Double Click -->
    <script type='text/javascript'>
        var googletag = googletag || {};
        googletag.cmd = googletag.cmd || [];
        (function() {
            var gads = document.createElement('script');
            gads.async = true;
            gads.type = 'text/javascript';
            var useSSL = 'https:' == document.location.protocol;
            gads.src = (useSSL ? 'https:' : 'http:') +
                '//www.googletagservices.com/tag/js/gpt.js';
            var node = document.getElementsByTagName('script')[0];
            node.parentNode.insertBefore(gads, node);
        })();
    </script>

    <script type='text/javascript'>
        googletag.cmd.push(function() {
            googletag.defineSlot('/1041902/AfterComments', [728, 90], 'div-gpt-ad-1336730094607-0').addService(googletag.pubads());
            googletag.defineSlot('/1041902/LearnTips-728x90', [728, 90], 'div-gpt-ad-1336656460674-0').addService(googletag.pubads());
            googletag.defineSlot('/1041902/LearnTips-728x90-AP', [728, 90], 'div-gpt-ad-1336656460674-1').addService(googletag.pubads());
            googletag.defineSlot('/1041902/Learn-tips-300-250', [300, 250], 'div-gpt-ad-1357216295046-0').addService(googletag.pubads());
            googletag.enableServices();
        });
    </script>
</head>
