<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php
$menu = array(
    'menu_type' => 'sponsored-links',
    'ul_param' => 'class="nav nav-pills nav-stacked sponsored_links"',
    'a_param' => 'rel="external nofollow"'
);
$menu = Library('menu')->get($menu);
if (!empty($menu)) {
    //echo '<div class="round15 sidebar-header">Blog Categories</div>';
    echo $menu;
}
