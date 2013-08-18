<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://ogp.me/ns/fb#" xml:lang="en" lang="en"><?php

Library('block')->load('page_html/head'); //Load Head Block ?>
<body class="codefight-body">

<div class="siteContainer">

    <div class="header">

        <div class="logo"><?php Library('block')->load('page_html/logo'); //Load logo block ?></div>

        <div class="userLogged">

            <div class="feed_counter"><?php Library('block')->load('feed/feed_counter'); //Load Feed Counter block ?></div>

            <?php Library('block')->load('welcome'); //Load welcome block ?>

        </div>

    </div>
    <?php

    //Load message block
    Library('block')->load('page_html/message'); ?>

    <div class="pageContainer">

        <div class="menu_top">

            <?php Library('block')->load('menu/page_horizontal'); //Load page menu horizontal block ?>

            <p class="clear">&nbsp;</p>

        </div>

        <p class="clear">&nbsp;</p>

        <div class="contents">

            <?php Library('block')->load($content_block); //Load Content Block ?>

        </div>

        <p class="clear">&nbsp;</p>

    </div>

    <p class="clear">&nbsp;</p>

    <div id="footer">

        <p class="clear">&nbsp;</p>

        <div class="copyright">

            <?php Library('block')->load('page_html/copyright'); //Load copyright Block ?>

        </div>

        <p class="clear">&nbsp;</p>

        <div class="powered_by">

            <?php Library('block')->load('page_html/powered_by'); //Powered By: Please give me some credit :) ?>

        </div>

    </div>

</div>
</body>
</html>

