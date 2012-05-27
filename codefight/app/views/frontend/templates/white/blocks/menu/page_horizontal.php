<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php
$menu = array(
    'menu_type' => 'page',
    'ul_param' => 'class=""',
);
$menu = Library('menu')->get($menu);
if (!empty($menu)) {
    //echo '<div class="round15 sidebar-header">Blog Categories</div>';
    echo $menu;
}
