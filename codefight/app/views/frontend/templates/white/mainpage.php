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
    <div id="sharebox" class="">
        <div class="cfshare">
            <script type="text/javascript">
            jQuery(document).ready(function(){
                if(jQuery('div#sharebox').length > 0)
                {
                    jQuery('#sharebox').cfShare({
                        shareClients:['facebook','facebooksend','twitter', 'googleplusone', 'reddit', 'linkedin','digg',
                            'addthis'],
                        addthisId:'dbashyal',
                        startTop : 94,
                        animate : true,
                        fromPosition:'top'
                    });
                }
            })
        </script>
        </div>
    </div>
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

        <div class="menuLeft">
            <div class="blog_categories">
                <div class="title-h2">CATEGORIES</div><?php

                //Load Blog Categories block
                Library('block')->load('menu/blog_categories_vertical');?>
            </div>

            <p class="clear">&nbsp;</p>

            <div class="blog_roll">
                <div class="title-h2">BLOG ROLL</div><?php

                //Load Blog Roll block
                Library('block')->load('menu/blog_roll_vertical');?>
            </div>

            <p class="clear">&nbsp;</p>

            <div class="blog_roll">
                <div class="title-h2">FAVOURITE LINKS</div><?php

                //Load Favourite Links block
                Library('block')->load('menu/favorite_links_vertical');?>
            </div>

        </div>

        <div class="contents"><?php

            //Load Google Link Units
            //Library('block')->load('advertisements/banner_468x15');

            //Load Content Block
            Library('block')->load($content_block, 'white'); ?>

        </div>

        <div class="right_column">

            <div class="tag_cloud"><?php

                //Load Tag Cloud block
                Library('block')->load('tag_cloud'); ?>

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
</div>
<script src="http://cdn.wibiya.com/Toolbars/dir_0586/Toolbar_586600/Loader_586600.js" type="text/javascript"></script>
</body>
</html>

