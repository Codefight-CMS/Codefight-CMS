<?php
if (!defined('BASEPATH')) {
    exit(__('No direct script access allowed'));
}

if (!isset($meta) || !is_array($meta)) {
    $meta['title']       = $this->setting->meta_title;
    $meta['description'] = $this->setting->meta_description;
    $meta['keywords']    = $this->setting->meta_keyword;
}

if (isset($this->setting->meta_suffix)) {
    $meta_suffix = $this->setting->meta_suffix;
} else {
    $meta_suffix = ' - ' . strtolower($_SERVER['HTTP_HOST']);
}
?>
<head profile="http://gmpg.org/xfn/11">
    <title><?php echo $meta['title'] . $meta_suffix; ?></title>
    <base href="<?php echo base_url(); ?>"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="chrome=1" />
    <meta name="description" content="<?php echo $meta['description']; ?>"/>
    <meta name="keywords" content="<?php echo $meta['keywords']; ?>"/>
    <?php $corrupted = substr(current_url(), -5); ?>
    <?php if (($this->uri->segment(1) == 'ontheweb') || (isset($noindex) && $noindex == 'yes') || ($corrupted == '_html')) { ?>
    <meta name="robots" content="noindex, follow"/>
    <meta name="robots" content="noarchive">
    <?php } else { ?>
    <meta name="robots" content="index, follow"/>
    <?php } ?>
    <link rel='canonical' href="<?php echo get_canonical_url($meta); ?>"/>
    <meta name="robots" content="noodp,noydir"/>
    <meta name="revisit-after" content="1 days"/>
    <meta name="generator" content="Codefight CMS"/>
    <meta name="vendor" content="<?php echo $this->setting->site_name ?>"/>
    <meta name="Language" content="en"/>
    <link href="https://plus.google.com/<?php echo $this->setting->google_plus ?>" rel="publisher" />
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo site_url('feed'); ?>"/>

    <!-- twitter card starts -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@codefight">
    <meta name="twitter:creator" content="@dbashyal">
    <meta name="twitter:url" content="<?php echo get_canonical_url(); ?>">
    <meta name="twitter:title" content="<?php echo $meta['title'] . $meta_suffix; ?>">
    <meta name="twitter:description" content="<?php echo $meta['description']; ?>">
    <meta name="twitter:image" content="http://codefight.org/skin/global/images/logo.png">
    <!-- twitter card ends -->


    <?php
    //Get Assets (js|css)
    Library('asset')->get();

    //If head text variable is set, echo it.
    if (isset($head_text)) {
        echo (string)$head_text;
    }

    //Load General_js.php file
    Library('block')->load('includes/general_js');

    //Load Google Analytics
    Library('block')->load('seo/google_analytics'); ?>

    <script type="text/javascript" src="<?php echo skin_url('global') ?>js/share.mini.js"></script>
</head>
