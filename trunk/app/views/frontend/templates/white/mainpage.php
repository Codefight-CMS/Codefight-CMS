<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://ogp.me/ns/fb#" xml:lang="en" lang="en"><?php

//Load Head Block
Library('block')->load('page_html/head'); ?>
<body class="codefight-body" id="<?php echo $bodyId; ?>">

<noscript>
    <div id="js_disabled" class="error center"><strong>This site works better with javascript enabled</strong>.</div>
</noscript>
<div class="top_menu_container">
    <div class="logo_text"><a title="Goto <?php echo $this->setting->site_name ?> Home"
                              href="<?php echo site_url();?>"><?php echo strtoupper($this->setting->site_name); ?></a>
    </div>
    <div class="menu_top">
        <?php

        //Load page menu horizontal block
        Library('block')->load('menu/page_horizontal'); ?>
        <p class="clear">&nbsp;</p>
    </div>
    <p class="clear">&nbsp;</p>

</div>
<div class="siteContainer">
    <?php
    //Load Language Selection Block
    Library('block')->load('languages');

    //Load message block
    Library('block')->load('page_html/message'); ?>

    <?php
    /*
     * <div class="header">
        <div class="userLogged">

            //Load Template Select Block
            Library('block')->load('template_select');

            //Load welcome block
            Library('block')->load('welcome');

        </div>
    </div>
    */
    ?>

    <div class="pageContainer">



        <div class="contents"><?php

            //Load Google Link Units
            //Library('block')->load('advertisements/banner_468x15');

            //Load Content Block
            Library('block')->load($content_block, 'white');

            //Load Affiliate Ads Block
            //Library('block')->load('advertisements/banner_728x90');

            ?>
            <p class="clear">&nbsp;</p>
            <p>&nbsp;</p>
            <iframe allowtransparency="true" frameborder="0" scrolling="no"
                    src="//platform.twitter.com/widgets/follow_button.html?screen_name=dbashyal&button=grey&show_count=true"
                    style="width:300px; height:20px;"></iframe>
            <p class="clear">&nbsp;</p>
            <!-- Place this tag where you want the badge to render -->
            <g:plus href="https://plus.google.com/109700463845406051057" rel="publisher" width="300" height="131" theme="light"></g:plus>

        </div>

        <div class="right_column">

            <div class="menuLeft">
                <div class="blog_categories">
                    <div class="title-h2"><?php echo __('CATEGORIES') ?></div><?php

                    //Load Blog Categories block
                    Library('block')->load('menu/blog_categories_vertical');?>
                </div>

                <p class="clear">&nbsp;</p>

                <div class="blog_roll">
                    <div class="title-h2">FAVOURITE LINKS</div><?php

                    //Load Favourite Links block
                    Library('block')->load('menu/favorite_links_vertical');?>
                </div>

                <p class="clear">&nbsp;</p>
            </div>

            <p class="clear">&nbsp;</p>

            <div class="tag_cloud"><?php

                //Load Tag Cloud block
                Library('block')->load('tag_cloud');

                //Load Affiliate Ads Block
                Library('block')->load('aff_ads');

                //Load Text Link Ads Block
                Library('block')->load('text_link_ads');

                //Load Banner 160 X 600 block
                //Library('block')->load('banner_160x600'); ?>

            </div>

            <p class="clear">&nbsp;</p>
        </div>

        <p class="clear">&nbsp;</p>
    </div>

    <p class="clear">&nbsp;</p>

    <div id="footer-wrapper">
        <div id="footer">
            <div class="footer_recent_entry">
                <div class="title-h2">Recent Posts</div><?php

                //Load Footer Block
                Library('block')->load('blog_recent'); ?>
            </div>
            <div class="footer_most_popular">
                <div class="title-h2">Most Popular</div><?php

                //Load Footer Block
                Library('block')->load('blog_popular'); ?>
            </div>
            <div class="footer_ontheweb_popular">
                <div class="title-h2">Sponsors</div><?php

                //Load Footer Block
                Library('block')->load('menu/sponsored_links_vertical'); ?>
            </div>
            <p class="clear">&nbsp;</p>
        </div>
    </div>
</div>
<div class="absolute-footer-wrapper">
    <div class="absolute-footer">
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
</div><?php

//Load Powered By Block: I hope you keep as it is. Thanks.
Library('block')->load('seo/wibiya'); ?>
<a href="https://github.com/dbashyal/Codefight-CMS" target="_blank"><img style="position: absolute; top: 0; left: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_left_red_aa0000.png" alt="Fork me on GitHub"></a>
</body>
</html>

