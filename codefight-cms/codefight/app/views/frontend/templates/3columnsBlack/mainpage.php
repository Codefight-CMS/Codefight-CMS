<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><?php 

//Load Head Block
$this->cf_block_lib->load('page_html/head');

$this->cf_block_lib->load('includes/general_js'); ?>

<?php
$bg_image = '';
$bg = get_random_bg();
if($bg)
{
	$bg_image = "background-image:url('{$bg}')";
}
?>
<body style="<?php echo $bg_image; ?>">

<noscript><div id="js_disabled" class="error center"><strong>This site works better with javascript enabled</strong>.</div></noscript>
<div class="top_menu_container">

	<div class="menu_top">
		<div class="logo_text"><a title="Goto <?php echo $this->setting->site_name ?> Home" href="<?php echo site_url();?>"><?php echo strtoupper($this->setting->site_name); ?></a></div>
		<?php

		//Load page menu horizontal block
		$this->cf_block_lib->load('menu/page_horizontal'); ?>
		<p class="clear">&nbsp;</p>
	</div>
	<p class="clear">&nbsp;</p>

</div>
<div class="siteContainer">
	<?php
	
	//Load Downloads Block
	$this->cf_block_lib->load('downloads');
	
	//Load Language Selection Block
	$this->cf_block_lib->load('languages');
	
	//Load message block
	$this->cf_block_lib->load('page_html/message'); ?>
	
	<div class="header">
		<div class="userLogged"><?php
				
			//Load Template Select Block
			$this->cf_block_lib->load('template_select');
			
			//Load welcome block
			$this->cf_block_lib->load('welcome'); ?>
			
		</div>
	</div>

	<div class="pageContainer">
		
		<div class="menuLeft">
			<div class="blog_categories">
				<h2>CATEGORIES</h2><?php
				
				//Load Blog Categories block
				$this->cf_block_lib->load('menu/blog_categories_vertical');?>
			</div>
			
			<p class="clear">&nbsp;</p>
			
			<div class="blog_roll">
				<h2>BLOG ROLL</h2><?php
				
				//Load Blog Roll block
				$this->cf_block_lib->load('menu/blog_roll_vertical');?>
			</div>
			
			<p class="clear">&nbsp;</p>
			
			<div class="blog_roll">
				<h2>FAVOURITE LINKS</h2><?php
			
			//Load Favourite Links block
			$this->cf_block_lib->load('menu/favorite_links_vertical');?>
			</div>
			
			<p class="clear">&nbsp;</p>
			
			<div class="tag_cloud"><?php
				
				//Load Tag Cloud block
				$this->cf_block_lib->load('tag_cloud'); ?>
				
			</div>
			
		</div>
		
		<div class="contents"><?php
			
			//Load Google Link Units
			$this->cf_block_lib->load('advertisements/banner_468x15');
			
			//Load Content Block
			$this->cf_block_lib->load($content_block, '3columnsBlack'); ?>
			
		</div>
		
		<div class="right_column">
			<div class="google_search"><?php
				
				//Load google Search block
				$this->cf_block_lib->load('google_search');?>
				</div>
			
			<div class="favorite_links">
				<h2>Codefight CMS</h2><?php
				
				//Load Text Link Ads Block
				$this->cf_block_lib->load('advertisements/text_link_ads');
				
				//Load Linkworth Ads Block
				$this->cf_block_lib->load('advertisements/linkworth_ads');
				
				//Load Affiliate Ads Block
				$this->cf_block_lib->load('advertisements/aff_ads');
				
				//Load Banner 160 X 600 block
				$this->cf_block_lib->load('advertisements/banner_160x600'); ?>
					
				<!-- h2>SPONSORED LINKS</h2><?php /*
				
				//Load Sponsored Links block
				$this->cf_block_lib->load('menu/sponsored_links_vertical');*/?> -->
				
			</div>
			
		</div>
		
		 <p class="clear">&nbsp;</p>
	</div>
	
	 <p class="clear">&nbsp;</p>
	 
	<div id="footer">
		<div class="footer_banner"><?php
			
			//Load Banner 728 X 90 Block
			$this->cf_block_lib->load('advertisements/banner_728x90'); ?>
		</div>
		<p class="clear">&nbsp;</p>
		<div class="footer_links"><?php
			
			//Load Footer Block
			$this->cf_block_lib->load('page_html/footer'); ?>
		</div>
		<p class="clear">&nbsp;</p>
		<div class="footer_recent_entry">
			<h2>Recent Posts</h2><?php
			
			//Load Footer Block
			$this->cf_block_lib->load('blog_recent'); ?>
		</div>
		<div class="footer_most_popular">
			<h2>Most Popular</h2><?php
			
			//Load Footer Block
			$this->cf_block_lib->load('blog_popular'); ?>
		</div>
		<div class="footer_ontheweb_popular">
			<h2>Sponsors</h2><?php
			
			//Load Footer Block
			$this->cf_block_lib->load('menu/sponsored_links_vertical'); ?>
		</div>
		<p class="clear">&nbsp;</p>
		
		<div class="copyright"><?php
			
			//Load copyright Block
			$this->cf_block_lib->load('page_html/copyright'); ?>
		</div>
		<p class="clear">&nbsp;</p>
		<div class="powered_by"><?php
			
			//Load Powered By Block: I hope you keep as it is. Thanks.
			$this->cf_block_lib->load('page_html/powered_by'); ?>
		</div>
	</div>
	
</div>
</body>
</html>

