<?php  if (!defined('BASEPATH')) {
    exit('No direct access allowed');
}

$theme = array();

// load css files
$theme['css'] = array('bootstrap-responsive.min', 'bootstrap.min', 'codefight', 'shThemeDefault', 'shCore');

// load js files
$theme['js'] = array('jquery', 'jquery-ui.min', 'bootstrap.min', 'bootstrap-alert', 'shCore', 'shBrushPhp', 'general', 'codefight-bootstrap');


// remove default loaded css/js
// $theme['remove']['css'] = array('shCore');