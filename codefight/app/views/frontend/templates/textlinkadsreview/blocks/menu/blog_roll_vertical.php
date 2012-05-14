<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>

<?php
$menu = array(
    'menu_type' => 'blog-roll',
    'ul_param' => 'class="blog_roll"',
    'a_param' => 'rel="external nofollow"'
);
$menu = $this->cf_menu_lib->get($menu);
if (!empty($menu)) {
    echo '<div class="round15 sidebar-header">I like to visit</div>';
    echo $menu;
}