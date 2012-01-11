<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php
/*
 * Check app/modules folder for adding/removing menu items.
 * Menu is controlled from config files,
 * so its easy to add and remove.
 * Those configs are read every page visit in admin,
 * @todo::which will be cached in later versions to improve more performance.
 */
 error_reporting(E_ALL);
//$menu_item = $this->cf_module_lib->_getAdminNav();
$menu_item = $this->cf_module_lib->get_nav_from_db();
//$cache = $this->cf_cache_lib->cache(60);
//print_r(get_class_vars(get_class($cache)));
//$test = $cache->_display(json_encode($menu_item), 'blahblah_id');
//print_r($test);
?>
<script type="text/javascript"> 
jQuery(document).ready(function(){
    jQuery("ul#main-nav li").find("ul").children(".current").parents('li').addClass('active');
    jQuery("ul#main-nav li").hover(
        function() {
            $ul = jQuery(this).find("ul.child").css('overflow', 'visible');
            $ul.stop()
                    .slideDown('fast')
                    .show()
                    .parent()
                    .addClass('over')
                    //.css('overflow', 'visible')
                    //.parent()
                    //.find("ul.child:visible")
                    //.not(this)
                    //.hide()
                    ;
            $ul.find('li').hover(
                    function()
                    {
                        $cul = jQuery(this).find("ul.grand-child").css('overflow', 'visible');
                        $cul.not(':visible')
                                .stop()
                                .slideDown('fast')
                                .show()
                                //.css('overflow', 'visible')
                                ;
                    },
                    function()
                    {
                        jQuery(this).find("ul.grand-child")
                                .stop()
                                .slideUp('fast');//.hide();
                    }
            );
        },
        function () {
            $ul = jQuery(this).find("ul.child");
            $ul.stop()
                    .slideUp('fast')
                    .parent()
                    .removeClass('over');//.hide();
            //$ul.css('overflow', 'visible');
        }
    );
});
</script>
<style type="text/css">
#top-menu-wrapper{background: #222;}
ul#main-nav {
	list-style: none;
	padding: 0 20px;
	margin: 0;
	float: left;
	min-width: 950px;
	background: #222;
	font-size: 12px;
    z-index: 10;
}
ul#main-nav li {
	float: left;
	margin: 0;
    overflow: visible;
	padding: 0 15px 0 0;
	position: relative;
}
ul#main-nav li a{
	padding: 10px 5px;
	color: #fff;
	display: block;
	text-decoration: none;
	float: left;
}
ul#main-nav li.over,
ul#main-nav li.active,
ul#main-nav li.current,
ul#main-nav li a:hover{
	background: #444;
}
ul#main-nav li ul.child,
ul#main-nav li ul.grand-child {
	list-style: none;
	position: absolute;
	left: 0;
    top: 35px;
	background: #444;
	margin: 0;
    padding: 0;
	display: none;
	float: left;
	width: 180px;
	border: 1px solid #555;
    z-index: 20;
}
ul#main-nav li ul.child li{
	margin: 0;
    padding: 0;
	border-top: 1px solid #444;
	border-bottom: 1px solid #333;
	clear: both;
	width: 180px;
}
ul#main-nav  li ul.child li.current a{background: #222;}
html ul#main-nav li ul.child li a {
	float: left;
	width: 145px;
	background: #333;
	padding-left: 20px;
}
html ul#main-nav li ul.child li.active a,
html ul#main-nav li ul.child li a:hover {background: #222;}
ul#main-nav li.over ul {display: block;}
ul#main-nav li.over ul ul {display: none;}
ul#main-nav li.over ul li.over ul {display: block;}
ul#main-nav li ul.grand-child {
    left: 120px;
    top: 5px;
    z-index: 30;
}
html ul#main-nav li ul.child li ul.grand-child li a{background: #333;}
html ul#main-nav li ul.child li ul.grand-child li.active a,
html ul#main-nav li ul.child li ul.grand-child li a:hover {background: #222;}
</style>
<div id="wrap">
    <div id="top-menu-wrapper">
        <div class="roundfg">
            <ul id="main-nav">
<?php
//print_r($menu_item);
$child_menu = '';
$admin = 'admin/'; /*@todo:: make admin url dynamic so, it doesn't need to be /admin/ */
$current_url = substr(trim(uri_string(), '/'), strlen($admin));

foreach ($menu_item as $k => $v)
{
    $class = 'cf' . preg_replace('/[^a-z0-9]/isU', '-', $v['url']) . (($v['url'] == $current_url) ? ' current' : '');

    echo '<li class="'.$class.'">';
    $attr = '';
    if($v['void'])
    {
        $attr = 'onclick="return false;"';
    }
    echo anchor($admin.$v['url'], __($v['title']), $attr);
    if(isset($v['child']) && is_array($v['child']) && count($v['child']) > 0)
    {
        echo '<ul class="child">';
        foreach($v['child'] as $ck => $cv)
        {
            $class = 'cf' . preg_replace('/[^a-z0-9]/isU', '-', $cv['url']) . (($cv['url'] == $current_url) ? '
            current' : '');
            echo '<li class="'.$class.'">';
			$attr = '';
			if($cv['void'])
			{
				$attr = 'onclick="return false;"';
			}
            echo anchor($admin.$cv['url'], __($cv['title']), $attr);
            if(isset($cv['child']) && is_array($cv['child']) && count($cv['child']) > 0)
            {
                echo '<ul class="grand-child">';
                foreach($cv['child'] as $gk => $gv)
                {
                    $class = 'cf' . preg_replace('/[^a-z0-9]/isU', '-', $gv['url']) . (($gv['url'] == $current_url) ? '
                    current' : '');
                    echo '<li class="'.$class.'">';
					$attr = '';
					if($gv['void'])
					{
						$attr = 'onclick="return false;"';
					}
                    echo anchor($admin.$gv['url'], __($gv['title']), $attr);
                    echo '</li>';
                }
                echo '</ul>';
            }
            echo '</li>';
        }
        echo '</ul>';
    }
    echo '</li>';
}
    ?>
            </ul>
            <p class="clear">&nbsp;</p>
        </div>
        <!-- End roundfg -->
    </div>
    <!-- End main-handle-->
    <p class="clear">&nbsp;</p>
</div>
<!-- End wrap -->
