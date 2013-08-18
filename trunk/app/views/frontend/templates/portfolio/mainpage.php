<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><?php

//Load Head Block
Library('block')->load('page_html/head'); ?>
<body>

<noscript><div id="js_disabled" class="error center"><strong>This site works better with javascript enabled</strong>.</div></noscript>

<div id="wrapper">
    <div id="header">
        <div id="logo">
            <h2><a title="Goto <?php echo $this->setting->site_name ?> Home" href="<?php echo site_url();?>"><?php echo strtoupper($this->setting->site_name); ?></a></h2>
        </div>
        <div id="pagenav"><?php
            //Load page menu horizontal block
            Library('block')->load('menu/page_horizontal', 'portfolio'); ?>
        </div>
    </div>

    <div id="main">

        <div class="container"><?php
			//Load message block
			Library('block')->load('page_html/message');

			//Load Content Block
			Library('block')->load($content_block, 'portfolio'); ?>
        </div>

    </div>

    <div id="footer">
        <div class="footernav">
            <ul>
            	<li class="page_item page-item-3 current_page_item">
                	<a href="<?php echo base_url(); ?>" title="Home">Home</a>
                </li>
            </ul>
        </div>

        <div class="copyright">
            &copy; 2011 Damodar Bashyal. All rights reserved. <br/>Powered By: <a href="http://codefight.org">Codefight CMS</a>
        </div>
    </div>

</div>
<script src="http://cdn.wibiya.com/Toolbars/dir_0586/Toolbar_586600/Loader_586600.js" type="text/javascript"></script>

<script type="text/javascript">Cufon.now();</script>
<p>&nbsp;</p>
<img style="display:none;" src="http://www.feedburner.com/fb/images/pub/feed-icon32x32.png" width="0" height="0" alt=""/>
</body></html>
