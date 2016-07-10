<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><?php

//Load Head Block
Library('block')->load('page_html/head'); ?>
<body>

<noscript><div id="js_disabled" class="error center"><strong>This site works better with javascript enabled</strong>.</div></noscript>
<!-- Header -->
<div id="header_wrap">
  <div id="header">
      <h2 class="logo"><a class="logo" title="Goto <?php echo $this->setting->site_name ?> Home" href="<?php echo site_url();?>"><?php echo strtoupper($this->setting->site_name); ?></a></h2>
    <ul class="top_navigation">
        <li><a href="http://codefight.org/">Download Codefight CMS</a> </li>
    </ul>
  </div>
  <div id="navigation_wrap"><div id="navigation_wrap_inner">
    <div id="navigation">
    	<?php
            //Load page menu horizontal block
            Library('block')->load('menu/page_horizontal', 'sketchawebsite'); ?>
    </div>
    <div class="search_form">
      <form method="get" action="<?php echo site_url() ?>">
        <fieldset>
          <input id="search_term" type="text" onclick="if(this.value == 'Search...') this.value='';" onblur="if(this.value.length == 0) this.value='Search...';" value="Search..." name="s" />
          <input class="submit_button" type="submit" value="Search" />
        </fieldset>
      </form>
    </div>
  </div></div>
</div>
<!-- [END] Header -->
<!-- Content Wrap -->
<div id="content_wrap">
  <!-- Content -->
  <div id="content" class="clearfix">
    <!-- Page Wrap -->
    <div class="page_wrap">
    <!-- Leader Board -->
    <div id="leader-board-wrap">
        <div class="leader_board">
        	<script type="text/javascript"><!--
google_ad_client = "ca-pub-9567128729272204";
/* 728x90, created 11/20/10 */
google_ad_slot = "1611025004";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
        </div>
    </div>
    <!-- [END] Leader Board -->
      <!-- Page -->
      <div id="page" class="single_post">
        <div class="page_inner">
            <div class="post post_inner_article">
                <div class="category-page-columns-frame">
                    <?php
			//Load message block
			Library('block')->load('page_html/message');

			//Load Content Block
			Library('block')->load($content_block, 'sketchawebsite'); ?>
                </div>

                <p>&nbsp;</p>

                <div id="pagination"><?php if(isset($data->pagination)) echo str_replace('http://templates.zoosper.org/cat', site_url() . uri_segment(1), $data->pagination); ?></div>

            </div>
            <div class="comments"></div>
        </div>
      </div>
      <!-- [END] Page -->
    </div>
    <!-- [END] Page Wrap -->
    <!-- sidebar -->
    <div id="sidebar">
      <!-- Subscriptions -->
      <div class="sidebar_subscribe"></div>
    <!-- [END] Subscriptions -->
    <!-- Sidebar Ad Zone -->
    <div id="ads">
    	<div class="ad336x280"><script type="text/javascript"><!--
google_ad_client = "ca-pub-9567128729272204";
/* 336x280, created 1/22/11 */
google_ad_slot = "9685992773";
google_ad_width = 336;
google_ad_height = 280;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
		</div>
        <br />
    	<div class="ad336x280"><script type="text/javascript"><!--
google_ad_client = "ca-pub-9567128729272204";
/* 336x280, created 1/22/11 */
google_ad_slot = "9685992773";
google_ad_width = 336;
google_ad_height = 280;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
		</div>
        <br />
    	<div class="ad336x280"><!-- YB: sketch336x280 (336x280) -->
			<script type="text/javascript"><!--
            yieldbuild_site = 13208;
            yieldbuild_loc = "sketch336x280";
            //--></script>
            <script type="text/javascript" src="http://hook.yieldbuild.com/s_ad.js"></script>
		</div>
        <br />
    	<div class="ad336x280"><!-- YB: sketch336x280 (336x280) -->
			<script type="text/javascript"><!--
            yieldbuild_site = 13208;
            yieldbuild_loc = "sketch336x280";
            //--></script>
            <script type="text/javascript" src="http://hook.yieldbuild.com/s_ad.js"></script>
		</div>
    </div>
    <!-- [END] Sidebar Ad Zone -->
    <!-- Social Networking -->
    <div id="social_networking">social</div>
    <!-- [END] Social Networking -->
    </div>
    <!-- [END] Sidebar -->
  </div>
  <!-- [END] Content -->
</div>
<!-- [END] Content Wrap -->

<!-- Footer -->
<div id="footer_wrap">
  <div id="footer">
    <div class="footer_inner">
      <ul class="footer_links">
        <li class="first">
            Copyright &copy; 2011 <a href="<?php echo base_url() ?>">Zoosper Groups</a>
        </li>
        <li>
            Powered by: <a title="Codefight CMS is a simple Codeigniter CMS" href="http://codefight.org/" target="_blank">Codefight CMS</a> &amp; <a title="Codeigniter php framework is used as base for Codefight CMS" href="http://www.codeigniter.com/" target="_blank">Codeigniter</a>
          </li>
          <li>
              A <a href="http://damodarbashyal.com/" title="Damodar Bashyal is a Sydney, Australia Based PHP web developer." target="_blank">Damodar Bashyal</a> Creation.
          </li>
      </ul>
      <p>&nbsp;</p>
    </div>
  </div>
</div>
<!-- [END] Footer -->
<script src="http://cdn.wibiya.com/Toolbars/dir_0586/Toolbar_586600/Loader_586600.js" type="text/javascript"></script>
<img style="display:none;" src="http://www.feedburner.com/fb/images/pub/feed-icon32x32.png" width="0" height="0" alt=""/>
<img style="display:none;" src="http://houseforlove.com/hfl.jpg" width="0" height="0" alt=""/>
<a class="bottom-right-fix-ad" href="http://spn.tw/pyoB" target="_blank">
<span class="close"><span onclick="jQuery('a.bottom-right-fix-ad').hide(); return false;">X</span></span><img src="http://img831.imageshack.us/img831/7159/twitterdollar125x125.jpg" alt="SponsoredTweets hire me badge" style="border: 0;" width="125" height="125" /></a>
</body>
</html>
