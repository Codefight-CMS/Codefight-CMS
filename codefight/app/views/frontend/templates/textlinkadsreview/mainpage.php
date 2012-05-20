<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://ogp.me/ns/fb#" xml:lang="en" lang="en"><?php

//Load Head Block
Library('block')->load('page_html/head'); ?>

<body class="codefight-body">
<div class="wrapper">
    <div class="inner-wrapper"><?php
            //Load message block
        Library('block')->load('page_html/message'); ?>

        <div class="round20 header">
            <div class="logo"><a title="Goto <?php echo $this->setting->site_name ?> Home"
                                 href="<?php echo site_url();?>"><?php echo strtoupper($this->setting->site_name); ?></a>
            </div>

            <div class="banner"><?php

                //Load Banner 728 X 90 Block
                Library('block')->load('advertisements/banner_728x90'); ?>
            </div>

            <p class="clear">&nbsp;</p>

            <div class="round4 nav">
                <div class="menu"><?php

                    //Load page menu horizontal block
                    Library('block')->load('menu/page_horizontal'); ?>

                    <div class="search-field"><?php

                        //Load google Search block
                        Library('block')->load('search/google_search');?>
                    </div>
                    <p class="clear">&nbsp;</p>
                </div>
            </div>
        </div>

        <div class="round15 content">
            <div class="content-main">
                <!-- div class="featured-area"></div -->

                <div class="recent-posts-container"><?php

                    //Load Content Block
                    Library('block')->load($content_block, 'textlinkadsreview'); ?>
                    <!-- div class="recent-post"></div -->
                </div>

                <!-- div class="advertisement-divider"></div -->

                <p class="clear"></p>
            </div>

            <div class="sidebar">

                <!-- div class="sidebar-email-form"></div -->

                <!-- div class="intro-social-container">Follow FB TWT</div --><?php

                //Load Categories Block
                Library('block')->load('menu/blog_categories_vertical', 'textlinkadsreview');

                //Load Tag Cloud block
                Library('block')->load('tag_cloud', 'textlinkadsreview');

                //Load Blog Roll block
                Library('block')->load('menu/blog_roll_vertical', 'textlinkadsreview');?>

            </div>

            <p class="clear"></p>
        </div>

        <div class="round15 footer">
            <div class="footer-links">
                <div class="blog_categories">
                    <h2>Recent Posts</h2><?php

                    //Load Blog Categories block
                    Library('block')->load('blog_recent');?>
                </div>

                <div class="blog_roll">
                    <h2>FAVOURITE LINKS</h2><?php

                    //Load Favourite Links block
                    Library('block')->load('menu/favorite_links_vertical');?>
                </div>

                <div class="footer_most_popular">
                    <h2>Most Popular</h2><?php

                    //Load Footer Block
                    Library('block')->load('blog_popular'); ?>
                </div>

            </div>
            <p class="clear">&nbsp;</p>

            <div class="copyright-text"><?php

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
</div>
</body>
</html>
