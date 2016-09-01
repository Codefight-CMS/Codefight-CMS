<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php
$menu = array(
    'menu_type' => 'teaser',
    'ul_param' => 'class="nav nav-pills nav-stacked teaser_links"',
    'a_param' => ' class="v4-tease" rel="external nofollow"'
);
$menu = Library('menu')->get($menu);
if (!empty($menu)) {
    echo $menu;
} else { ?>
<a href="https://github.com/Codefight-CMS/Codefight-CMS/releases" class="v4-tease">Download Latest Codefight CMS From Github</a>
<?php } ?>