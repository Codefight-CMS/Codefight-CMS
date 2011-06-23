<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
//Get Advertisement
$banner = array(
			'sid' => '1066176',
			'zs' => '3732385f3930',
			'opid' => '1066176',
			'afsid' => '1',
			'size' => '728x90',
			'provider' => 'adbrite',
			//'location' => 'header',
			'AdBrite_Title_Color' => '88c7d0',
			'AdBrite_Text_Color' => '85c322',
			'AdBrite_Background_Color' => 'e3e0b3',
			'AdBrite_Border_Color' => 'e3e0b3',
			'AdBrite_URL_Color' => 'e3e0b3',
			'show_your_add_here' => true
			);
//Display Banner Here
echo $this->cf_banner_model->get_advertisement($banner); ?>