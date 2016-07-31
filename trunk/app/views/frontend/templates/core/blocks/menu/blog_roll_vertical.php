<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php
$menu = array(
    'menu_type' => 'blog-roll',
    'ul_param' => 'class="nav blog_roll"',
    'a_param' => 'rel="external nofollow"'
);
$menu = Library('menu')->get($menu);
if (!empty($menu)) {
    //echo '<div class="round15 sidebar-header">Blog Categories</div>';
    echo $menu;
}
