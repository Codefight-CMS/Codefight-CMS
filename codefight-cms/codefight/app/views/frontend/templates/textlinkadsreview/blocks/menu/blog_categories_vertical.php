<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<?php
$menu = array(
			'menu_type' => 'blog',
			'ul_param' => 'class="blog_categories"',
			//'a_param' => 'rel="external nofollow"'
		);
$menu = $this->cf_menu_lib->get($menu);
if(!empty($menu))
{
	echo '<div class="round15 sidebar-header">Blog Categories</div>';
	echo $menu;
}