<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php 
if(isset($content) && is_array($content) && count($content) > 0) foreach ($content as $v)
{
		//Show heading of the content, ...
		echo '<h1>' . $v['title'] . '</h1>';
		
		if($this->uri->segment(1) == 'contact-us') echo '<div class="contact_us">';
		
		//Show author and published date
		if(isset($v['author_date'])) echo $v['author_date'];
		
		//Show content
		echo $v['content'];
		if($this->uri->segment(1) == 'contact-us') echo '</div>';
		
		//Display Addthis button
		if(isset($v['addthis'])) echo $v['addthis'];
		
		//Show Comment
		if(isset($v['comment'])) echo $v['comment'];
		
		//Show tag of the post
		//echo $v['tag'];

}
else
{
	$seachQ = $this->uri->uri_string();
	$seachQ = preg_replace('/[^a-z0-9]/i', ' ', $seachQ); ?>
    <h1><?php echo ucwords($seachQ); ?></h1>

    <div class="banner b_336x280" style="float:none;"><!-- Yieldbuild: 336x280 (336x280) -->
    <script type="text/javascript"><!--
    yieldbuild_site = 11828;
    yieldbuild_loc = "336x280";
    //--></script>
    <script type="text/javascript" src="http://hook.yieldbuild.com/s_ad.js"></script>
    </div>
    
    <p class="clear">&nbsp;</p>
    
    <br /><br />
    
    <h3>404 page not found!</h3>
    <p>The page either doesn't exist or has moved.</p>
    
   <p>Search The web:</p>
    <form action="http://zoosper.org/" id="cse-search-box">
      <div>
        <input type="hidden" name="cx" value="partner-pub-9567128729272204:1779645421" />
        <input type="hidden" name="cof" value="FORID:10" />
        <input type="hidden" name="ie" value="UTF-8" />
        <input type="text" name="q" size="55" value="<?php echo $seachQ; ?>" style="border: 15px solid #FFFFFF;display: block;font-size: 30px;margin: 10px 0;width: 550px;" />
        <input type="submit" name="sa" value="Search" class="myButton" />
      </div>
    </form>

<script type="text/javascript" src="http://www.google.com/coop/cse/brand?form=cse-search-box&amp;lang=en"></script>
   
   <p>&nbsp;</p>
   
   <h2>Popular Searches:</h2>
   <script type="text/javascript" src="http://www.google.com/cse/query_renderer.js"></script>
<div id="queries"></div>
<script src="http://www.google.com/cse/api/partner-pub-9567128729272204/cse/1779645421/queries/js?oe=UTF-8&amp;callback=(new+PopularQueryRenderer(document.getElementById(%22queries%22))).render"></script>

   <?php
} ?>
<style type="text/css">
.myButton {
	-moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
	-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
	box-shadow:inset 0px 1px 0px 0px #ffffff;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ededed), color-stop(1, #dfdfdf) );
	background:-moz-linear-gradient( center top, #ededed 5%, #dfdfdf 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#dfdfdf');
	background-color:#ededed;
	-moz-border-radius:8px;
	-webkit-border-radius:8px;
	border-radius:8px;
	border:2px solid #dcdcdc;
	display:inline-block;
	color:#777777;
	font-family:arial;
	font-size:15px;
	font-weight:bold;
	padding:6px 24px;
	text-decoration:none;
	text-shadow:1px 1px 0px #ffffff;
}.myButton:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #dfdfdf), color-stop(1, #ededed) );
	background:-moz-linear-gradient( center top, #dfdfdf 5%, #ededed 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#dfdfdf', endColorstr='#ededed');
	background-color:#dfdfdf;
}.myButton:active {
	position:relative;
	top:1px;
}
</style>
<p class="clear">&nbsp;</p>

<?php if(isset($pagination)) echo $pagination; ?>