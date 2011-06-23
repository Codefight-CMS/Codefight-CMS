<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
$menu = array(
			'menu_type' => 'favourite-links',
			'ul_param' => 'class="favourite_links"',
			'a_param' => 'rel="external nofollow"'
		);
$menu = $this->cf_menu_lib->get($menu);
if(!empty($menu))
{
	//echo '<div class="round15 sidebar-header">Blog Categories</div>';
	echo $menu;
}