<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://ogp.me/ns/fb#" xml:lang="en" lang="en"><?php

Library('block')->load('page_html/head'); //Load Head Block ?>
<body class="codefight-body">

<div class="siteContainer">
    <div class="pageContainer">

        <div class="header">

            <div class="logo">

                <?php Library('block')->load('page_html/logo', 'magicland'); //Load logo block ?>

            </div>

            <div class="google_468_60_top">

                <?php Library('block')->load('advertisements/banner_468x60', 'magicland'); //Load Banner 468 X 60 block ?>

            </div>

        </div>

        <div class="userLogged">

            <div class="feed_counter">

                <?php Library('block')->load('feed/feed_counter'); //Load Feed Counter block ?>

            </div>

            <?php Library('block')->load('welcome'); //Load welcome block ?>

            <p class="clear">&nbsp;</p>

        </div>

        <?php Library('block')->load('page_html/message'); //Load message block ?>

        <div class="menu_top">

            <?php //Library('block')->load('template_select'); //Load Template Select Block ?>

            <?php Library('block')->load('menu/page_horizontal'); //Load page menu horizontal block ?>

            <p class="clear">&nbsp;</p>

        </div>

        <p class="clear">&nbsp;</p>

        <div class="contents">

            <div class="contentBlock">

                <?php Library('block')->load($content_block, 'magicland'); //Load Content Block ?>

            </div>

            <p class="clear">&nbsp;</p>

        </div>

        <div class="menuLeft">

            <div class="blog_categories">

                <h2>CATEGORIES</h2>

                <?php Library('block')->load('menu/blog_categories_vertical'); //Load Blog Categories block ?>

            </div>

            <div class="blog_roll">

                <h2>BLOG ROLL</h2>

                <?php Library('block')->load('menu/blog_roll_vertical'); //Load Blog Roll block ?>

            </div>

            <div class="tag_cloud">

                <?php Library('block')->load('tag_cloud'); //Load Tag Cloud block ?>

            </div>

            <p class="clear">&nbsp;</p>

        </div>

        <div class="right_column">

            <?php Library('block')->load('advertisements/banner_160x600', 'magicland'); //Load Banner 160 X 600 block ?>

            <p class="clear">&nbsp;</p>

        </div>

        <p class="clear">&nbsp;</p>

        <div id="footer">

            <div class="footer_banner">

                <?php Library('block')->load('advertisements/banner_728x90'); //Load Banner 728 X 90 Block ?>

            </div>

            <div class="footer_links">

                <?php Library('block')->load('page_html/footer'); //Load Footer Block ?>

            </div>

            <p class="clear">&nbsp;</p>

            <div class="copyright">

                <?php Library('block')->load('page_html/copyright'); //Load copyright Block ?>

            </div>

            <p class="clear">&nbsp;</p>

            <div class="powered_by">

                <?php Library('block')->load('page_html/powered_by'); //Powered By: Hope to get some credit. ?>

            </div>

            <div class="branch">&nbsp;</div>

            <p>Theme designed by <a title="Organic Search Engine Optimization" href="http://www.seoatsea.com/"
                                    rel="external nofollow">OSEO</a> Coder <a title="Current CD Rates"
                                                                              href="http://www.current-cd-rates.com/"
                                                                              rel="external nofollow">CCR</a> and
                presented by <a title="Make Money Online" href="http://www.successwithauctions.com/"
                                rel="external nofollow">MMO</a></p>

        </div>

    </div>
</div>
</body>
</html>

