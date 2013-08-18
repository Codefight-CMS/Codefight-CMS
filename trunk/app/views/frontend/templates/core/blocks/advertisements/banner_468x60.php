<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Get Advertisement
$banner = array(
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
			'show_your_add_here' => false
			);

echo Model('banner')->get_advertisement($banner);
