<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php
$menu = array(
    'menu_type' => 'blog',
    'ul_param' => 'class="blog_categories"',
    //'a_param' => 'rel="external nofollow"'
);
$menu = Library('menu')->get($menu);
if (!empty($menu)) {
    //echo '<div class="round15 sidebar-header">Blog Categories</div>';
    echo $menu;
}
