<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cf_banner_model extends MY_Model {

	function Cf_banner_model()
    {
        // Call the Model constructor
        parent::MY_Model();
    }
	
	//Parse any banner insert in the content
	function parse($page_content, $identifier) {
		//identifier contains full identifer block and code
		$identifier_blocks = array();
		$identifier_ids = array();
		if(is_array($identifier) && count($identifier) == 2) {
			if(isset($identifier[0]) && isset($identifier[1]))
			{
				$identifier_blocks = $identifier[0];
				$identifier_ids = $identifier[1];
			}
		}
		
		foreach($identifier_ids as $id) {
			$this->db->where('banner_id', (int)$id);
			$this->db->where('status', '1');
			$banner = $this->db->get('banner');
			$banner = $banner->result_array();
			
			if(count($banner)) {
				$html = '<div class="banner banner_id_'.(int)$id.'">'.$banner[0]['banner_html_text'].'</div>';
				$page_content = preg_replace('#{{banner '.(int)$id.'}}#isU', $html, $page_content);
			} else {
				$page_content = preg_replace('#{{banner '.(int)$id.'}}#isU', '', $page_content);
			}
		}

		return $page_content;
		//return $banner_string;
	}
	////
	
	/*
	 * Create Advertisement Block
	 */
	function get_advertisement($banner=array())
	{
		$ret = false;
		if(isset($banner['provider']) && !preg_match('/localhost/',$_SERVER['HTTP_HOST'])) {
			switch($banner['provider']) {
				default:
					$ret = $this->banner_adbrite($banner);
					break;
			}
		}
		return $ret;
	}
	
	function banner_adbrite($passed=array()) 
	{
		!is_array($passed)? $passed=array($passed) : '';
		
		$default = array(
						'sid' => '1066153',
						'zs' => '3436385f3630',
						'opid' => '1066153',
						'afsid' => '1',
						'size' => '468x60',
						'provider' => 'adbrite',
						//'location' => 'header',
						'AdBrite_Title_Color' => 'dedede',
						'AdBrite_Text_Color' => 'f3f3f3',
						'AdBrite_Background_Color' => '218B03',
						'AdBrite_Border_Color' => '218B03',
						'AdBrite_URL_Color' => '218B03',
						'AdBrite_Background_Color' => '218B03',
						'show_your_add_here' => false
						);
		
		$array = array_merge($default,$passed);
		
		echo '<!-- Begin: AdBrite, Generated: 2009-03-03 22:47:20  --><scr';
		echo 'ipt type="text/javascript">';
		echo 'var AdBrite_Title_Color = \'' . $array['AdBrite_Title_Color'] . '\';';
		echo 'var AdBrite_Text_Color = \'' . $array['AdBrite_Text_Color'] . '\';';
		echo 'var AdBrite_Background_Color = \'' . $array['AdBrite_Background_Color'] . '\';';
		echo 'var AdBrite_Border_Color = \'' . $array['AdBrite_Border_Color'] . '\';';
		echo 'var AdBrite_URL_Color = \'' . $array['AdBrite_URL_Color'] . '\';';
		echo 'try{var AdBrite_Iframe=window.top!=window.self?2:1;var AdBrite_Referrer=';
		echo 'document.referrer==\'\'?document.location:document.referrer;AdBrite_Referrer=encodeURIComponent';
		echo '(AdBrite_Referrer);}catch(e){var AdBrite_Iframe=\'\';var AdBrite_Referrer=\'\';}</scr';
		echo 'ipt><span style="white-space:nowrap;"><scr'.'ipt type="text/javascript">';
		echo 'document.write(String.fromCharCode(60,83,67,82,73,80,84));document.write(\' ';
		echo 'src="http://ads.adbrite.com/mb/text_group.php?sid=' . $array['sid'] . '&zs=' . $array['zs'] . '&';
		echo 'ifr=\'+AdBrite_Iframe+\'&ref=\'+AdBrite_Referrer+\'" type="text/javascript">\');';
		echo 'document.write(String.fromCharCode(60,47,83,67,82,73,80,84,62));</scr';
		echo 'ipt>';
		if($array['show_your_add_here'] == true) {
			echo '<a style="font-weight:bold;font-family:Arial;font-size:13px;" rel="external nofollow" target="_blank"';
			echo ' href="http://www.adbrite.com/mb/commerce/purchase_form.php?opid=' . $array['opid'] . '&afsid=' . $array['afsid'] . '">';
			if($array['size'] == '468x60') {
				echo '<img src="http://files.adbrite.com/mb/images/adbrite-your-ad-here-banner-w.gif" style="background-color:#' . $array['AdBrite_Background_Color'] . ';border:none;padding:0;margin:0;" alt="Your Ad Here" width="11" height="60" border="0" />';
			}
			if($array['size'] == '160x600') {
				echo 'Your Ad Here';
			}
			if($array['size'] == '728x90') {
				echo '<img src="http://files.adbrite.com/mb/images/adbrite-your-ad-here-leaderboard.gif"  style="background-color:#' . $array['AdBrite_Background_Color'] . ';border:none;padding:0;margin:0;" alt="Your Ad Here" width="14" height="90" border="0" />';
			}
			echo '</a>';
		}
		echo '</span><!-- End: AdBrite -->';
		
		return '';

	}
	
}
?>