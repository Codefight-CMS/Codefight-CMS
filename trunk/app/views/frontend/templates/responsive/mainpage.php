<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<?php

//Load Head Block
Library('block')->load('page_html/head'); ?>

<body class="codefight-body">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<noscript>
    <div id="js_disabled" class="error center"><strong>This site works better with javascript enabled</strong>.</div>
</noscript>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo site_url();?>" title="Goto <?php echo $this->setting->site_name ?> Home"><?php echo strtoupper($this->setting->site_name); ?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <?php

            //Load page menu horizontal block
            Library('block')->load('menu/page_horizontal'); ?>
        </div><!--/.navbar-collapse -->
    </div>
</nav>

<div class="container">
<?php
//Load message block
Library('block')->load('page_html/message'); ?>

<div class="header"></div>

<div class="pageContainer">

    <div class="row"><?php
        //Load Content Block
        Library('block')->load($content_block, 'responsive'); ?>
    </div>



    <div class="sidebar-wrapper">

        <div class="menuLeft">
            <div class="blog_categories">
                <h2>CATEGORIES</h2><?php

                //Load Blog Categories block
                Library('block')->load('menu/blog_categories_vertical');?>
            </div>

            <p class="clear">&nbsp;</p>

            <div class="blog_roll">
                <h2>BLOG ROLL</h2><?php

                //Load Blog Roll block
                Library('block')->load('menu/blog_roll_vertical');?>
            </div>

            <p class="clear">&nbsp;</p>

            <div class="blog_roll">
                <h2>FAVOURITE LINKS</h2><?php

                //Load Favourite Links block
                Library('block')->load('menu/favorite_links_vertical');?>
            </div>

            <p class="clear">&nbsp;</p>

            <div class="tag_cloud"><?php

                //Load Tag Cloud block
                Library('block')->load('tag_cloud'); ?>

            </div>

        </div>
    </div>

    <p class="clear">&nbsp;</p>
</div>

<p class="clear">&nbsp;</p>


<div id="footer">
    <div class="footer_links"><?php

        //Load Footer Block
        Library('block')->load('page_html/footer'); ?>
    </div>
    <p class="clear">&nbsp;</p>

    <div class="footer_recent_entry">
        <h2>Recent Posts</h2><?php

        //Load Footer Block
        Library('block')->load('blog_recent'); ?>
    </div>
    <div class="footer_most_popular">
        <h2>Most Popular</h2><?php

        //Load Footer Block
        Library('block')->load('blog_popular'); ?>
    </div>
    <div class="footer_ontheweb_popular">
        <h2>Sponsors</h2><?php

        //Load Footer Block
        Library('block')->load('menu/sponsored_links_vertical'); ?>
    </div>
    <p class="clear">&nbsp;</p>

    <div class="copyright"><?php

        //Load copyright Block
        Library('block')->load('page_html/copyright'); ?>
    </div>
    <p class="clear">&nbsp;</p>

    <div class="powered_by"><?php

        //Load Powered By Block: I hope you keep as it is. Thanks.
        Library('block')->load('page_html/powered_by'); ?>
    </div>
</div>

</div>
<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
<img style="display:none;" src="http://www.feedburner.com/fb/images/pub/feed-icon32x32.png" width="0" height="0"
     alt=""/>
<script type="text/javascript" src="http://s.skimresources.com/js/45041X1159517.skimlinks.js"></script>
<?php Library('block')->load('seo/wibiya'); ?>
</body>
</html>
