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
$menu_item = Library('module')->get_nav_from_db();
//$cache = Library('cache')->cache(60);
//print_r(get_class_vars(get_class($cache)));
//$test = $cache->_display(json_encode($menu_item), 'blahblah_id');
//print_r($test);
// navbar-fixed-top
?>
<nav class="navbar navbar-inverse codefight-main-navbar">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php echo anchor('admin/', 'Codefight CMS', ' class="navbar-brand"');?>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                //print_r($menu_item);
                $child_menu = '';
                $admin = 'admin/'; /*@todo:: make admin url dynamic so, it doesn't need to be /admin/ */
                $current_url = substr(trim(uri_string(), '/'), strlen($admin));

                foreach ($menu_item as $k => $v)
                {
                    if(isset($v['is_menu']) && (int)$v['is_menu'] < 1){
                        continue;
                    }
                    $class = 'cf' . preg_replace('/[^a-z0-9]/isU', '-', $v['url']) . (($v['url'] == $current_url) ? ' current' : '');

                    $attr = '';
                    $caret = '';
                    if($v['void'])
                    {
                        $attr = 'class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"';
                        $class = "dropdown {$class}";
                        $caret = ' <span class="caret"></span>';
                    }
                    echo '<li class="'.$class.'">';
                    echo anchor($admin.$v['url'], __($v['title']) . $caret, $attr);
                    if(isset($v['child']) && is_array($v['child']) && count($v['child']) > 0)
                    {
                        echo '<ul class="dropdown-menu child" style="overflow: visible !important;">';
                        foreach($v['child'] as $ck => $cv)
                        {
                            if(isset($cv['is_menu']) && (int)$cv['is_menu'] < 1){
                                continue;
                            }
                            $class = 'cf' . preg_replace('/[^a-z0-9]/isU', '-', $cv['url']) . (($cv['url'] == $current_url) ? '
            current' : '');
                            $attr = '';
                            $caret = '';
                            if($cv['void'])
                            {
                                $attr = 'class="dropdown-toggle" data-toggle="dropdown-child" role="button" aria-haspopup="true" aria-expanded="false"';
                                $class = "dropdown {$class}";
                                $caret = ' <span class="caret"></span>';
                            }
                            echo '<li class="'.$class.'">';
                            echo anchor($admin.$cv['url'], __($cv['title']) . $caret, $attr);
                            if(isset($cv['child']) && is_array($cv['child']) && count($cv['child']) > 0)
                            {
                                echo '<ul class="grand-child">';
                                foreach($cv['child'] as $gk => $gv)
                                {
                                    if(isset($gv['is_menu']) && (int)$gv['is_menu'] < 1){
                                        continue;
                                    }
                                    $class = 'cf' . preg_replace('/[^a-z0-9]/isU', '-', $gv['url']) . (($gv['url'] == $current_url) ? '
                    current' : '');
                                    $attr = '';
                                    $caret = '';
                                    if($gv['void'])
                                    {
                                        $attr = 'onclick="return false;"';
                                        $class = "dropdown {$class}";
                                        $caret = ' <span class="caret"></span>';
                                    }
                                    echo '<li class="'.$class.'">';
                                    echo anchor($admin.$gv['url'], __($gv['title']) . $caret, $attr);
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
            <ul class="nav navbar-nav navbar-right">
                <li><?php

                    //Login or Logout Link | @todo:: Probably move to general helper
                    if ($this->session->userdata('logged_in') === '1') {

                        $loggedData = $this->session->userdata('loggedData');

                        echo '<a href="javascript:void(0);">' . $loggedData['firstname'] . ' ' . $loggedData['lastname'] . " ( '" . $loggedData['group_title'] . "' ) </a></li><li> " . anchor('registration/logout', 'Logout');

                    }
                    else
                    {

                        echo anchor('registration/login', 'Login');

                    }
                    ?></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>