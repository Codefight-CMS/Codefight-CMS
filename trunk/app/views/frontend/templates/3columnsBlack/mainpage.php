<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://ogp.me/ns/fb#" xml:lang="en" lang="en"><?php

//Load Head Block
Library('block')->load('page_html/head'); ?>

<?php
$bg_image = '';
/*
$bg = get_random_bg();
if ($bg) {
    $bg_image = "background-image:url('{$bg}')";
}
*/
?>
<body class="codefight-body" style="<?php echo $bg_image; ?>">

<noscript>
    <div id="js_disabled" class="error center"><strong>This site works better with javascript enabled</strong>.</div>
</noscript>
<div class="top_menu_container">

    <div class="menu_top">
        <div class="logo_text"><a title="Goto <?php echo $this->setting->site_name ?> Home" href="<?php echo site_url();?>"><?php echo strtoupper($this->setting->site_name); ?></a>
        </div><?php

        //Load page menu horizontal block
        Library('block')->load('menu/page_horizontal'); ?>
        <p class="clear">&nbsp;</p>
    </div>
    <p class="clear">&nbsp;</p>

</div>
<div class="siteContainer">
<?php

//Load Downloads Block
//Library('block')->load('downloads');

//Load Language Selection Block
//Library('block')->load('languages');

//Load message block
Library('block')->load('page_html/message'); ?>

<div class="header"></div>

<div class="pageContainer">

    <div class="contents">
        <div class="text-link-ads">
            <ul>
                <li>
                    <iframe allowtransparency="true" frameborder="0" scrolling="no"
                            src="//platform.twitter.com/widgets/follow_button.html?screen_name=dbashyal&button=grey&show_count=true"
                            style="width:300px; height:20px;"></iframe>

                    <div class="google_translate_element" style="float:right;">
                        <div id="google_translate_element"></div>
                        <script>
                            function googleTranslateElementInit() {
                                new google.translate.TranslateElement({
                                    pageLanguage: 'en',
                                    gaTrack: true,
                                    gaId: 'UA-852764-25',
                                    layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                                }, 'google_translate_element');
                            }
                        </script>
                        <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                    </div>
                </li>
            </ul>
        </div>

        <?php
        //Load Content Block
        Library('block')->load($content_block, '3columnsBlack'); ?>

        <p class="clear">&nbsp;</p>

        <div class="text-link-ads">
            <ul>
                <?php if(current_url() != base_url()){ ?>
                <li>
                    <a href="http://coupongiftdeals.com/coupon" rel="external nofollow" target="_blank">
                        <strong>Coupon Gift Deals</strong> |
                        <span>Find coupon or deal that you are looking for.</span>
                    </a>
                </li>
                <li>
                    <!-- AfterComments -->
                    <div id='div-gpt-ad-1336730094607-0' style='width:728px; height:90px;'>
                        <script type='text/javascript'>
                            googletag.cmd.push(function() { googletag.display('div-gpt-ad-1336730094607-0'); });
                        </script>
                    </div>
                </li>
                <li>
                    <script type="text/javascript"><!--
                    google_ad_client = "ca-pub-9567128729272204";
                    /* ltat */
                    google_ad_slot = "8761210017";
                    google_ad_width = 728;
                    google_ad_height = 15;
                    //-->
                    </script>
                    <script type="text/javascript"
                            src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
                    </script>
                </li>
                <?php } ?>
                <li>
                    <iframe allowtransparency="true" frameborder="0" scrolling="no"
                            src="//platform.twitter.com/widgets/follow_button.html?screen_name=dbashyal&button=grey&show_count=true"
                            style="width:300px; height:20px;"></iframe>
                </li>
            </ul>
        </div>

    </div>

    <div class="sidebar-wrapper"><?php

        //Load Social Icons
        Library('block')->load('social-and-search', '3columnsBlack'); ?>

        <p class="clear">&nbsp;</p>

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

        <div class="right_column">
            <div class="favorite_links">
                <?php
                //Load Affiliate Ads Block
                Library('block')->load('aff_ads'); ?>

                <!-- h2>SPONSORED LINKS</h2><?php /*

				//Load Sponsored Links block
				Library('block')->load('menu/sponsored_links_vertical');*/?> -->

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
