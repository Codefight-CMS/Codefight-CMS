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

<a href="https://github.com/Codefight-CMS/Codefight-CMS/releases" class="v4-tease">Download Latest Codefight CMS From Github</a>

<div class="container">
<?php
//Load message block
Library('block')->load('page_html/message'); ?>

<div class="pageContainer">

    <div class="row">
        <div class="col-md-9" role="main"><?php
            //Load Content Block
            Library('block')->load($content_block, 'responsive'); ?>
        </div>

        <div class="col-md-3" role="complementary">
            <nav class="codefight-frontend-sidebar">
                <div class="blog_categories">
                    <h5>CATEGORIES</h5><?php

                    //Load Blog Categories block
                    Library('block')->load('menu/blog_categories_vertical');?>
                </div>

                <p class="clear">&nbsp;</p>

                <div class="tag_cloud"><?php

                    //Load Tag Cloud block
                    Library('block')->load('tag_cloud'); ?>

                </div>
            </nav>
        </div>
    </div>
</div>

<p class="clear">&nbsp;</p>

    <footer>
        <div class="row">
            <div class="container">
                <div class="col-md-12">
                    <?php

                    //Load Footer Block
                    Library('block')->load('page_html/footer'); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="container well well-sm">
                <div class="col-md-4">
                    <h5>Recent Posts</h5><?php

                    //Load Footer Block
                    Library('block')->load('blog_recent'); ?>
                </div>
                <div class="col-md-4">
                    <h5>Most Popular</h5><?php

                    //Load Footer Block
                    Library('block')->load('blog_popular'); ?>
                </div>
                <div class="col-md-4">
                    <h5>Sponsors</h5><?php

                    //Load Footer Block
                    Library('block')->load('menu/sponsored_links_vertical'); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="container well well-sm">
                <div class="col-md-12 text-center">
                    <?php

                    //Load copyright Block
                    Library('block')->load('page_html/copyright'); ?>
                </div>
                <div class="col-md-12 text-center">
                    <?php

                    //Load Powered By Block: I hope you keep as it is. Thanks.
                    Library('block')->load('page_html/powered_by'); ?>
                </div>
            </div>
        </div>
    </footer>

</div>
<?php Library('block')->load('seo/wibiya'); ?>
</body>
</html>
