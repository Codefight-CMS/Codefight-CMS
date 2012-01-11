<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php $this->cf_block_lib->load('page_html/head'); //Load Head Block ?>
<body>

<div class="siteContainer">

    <div class="header">

        <div class="logo"><?php $this->cf_block_lib->load('page_html/logo'); //Load logo block ?></div>

        <div class="userLogged">

            <div class="feed_counter"><?php $this->cf_block_lib->load('feed/feed_counter'); //Load Feed Counter block ?></div>

            <?php $this->cf_block_lib->load('welcome'); //Load welcome block ?>

        </div>

    </div>
    <?php

    //Load message block
    $this->cf_block_lib->load('page_html/message'); ?>

    <div class="pageContainer">

        <div class="menu_top">

            <?php $this->cf_block_lib->load('menu/page_horizontal'); //Load page menu horizontal block ?>

            <p class="clear">&nbsp;</p>

        </div>

        <p class="clear">&nbsp;</p>

        <div class="contents">

            <?php $this->cf_block_lib->load($content_block); //Load Content Block ?>

        </div>

        <p class="clear">&nbsp;</p>

    </div>

    <p class="clear">&nbsp;</p>

    <div id="footer">

        <p class="clear">&nbsp;</p>

        <div class="copyright">

            <?php $this->cf_block_lib->load('page_html/copyright'); //Load copyright Block ?>

        </div>

        <p class="clear">&nbsp;</p>

        <div class="powered_by">

            <?php $this->cf_block_lib->load('page_html/powered_by'); //Powered By: Please give me some credit :) ?>

        </div>

    </div>

</div>
</body>
</html>

