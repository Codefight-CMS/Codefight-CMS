<?php  if (!defined('BASEPATH')) {
    exit('No direct access allowed');
}

$theme = array();

// load css files
$theme['css'] = array('video-js.min', 'bootstrap.min', 'highlight.default', 'bootstrap-theme.min', 'font-awesome.min', 'codefight');

// load js files
$theme['js'] = array(
    'vendor/jquery-1.11.2',
    'highlight.pack',
    'vendor/modernizr-2.8.3-respond-1.4.2.min',
    'vendor/bootstrap.min',
    'plugins',
    'videojs-ie8.min',
    'video.min',
    'Videojs.Youtube.min',
    'codefight'
);

$theme['remove']['css'] = array('bootstrap-responsive.min', 'bootstrap.min', 'codefight', 'shThemeDefault', 'shCore');
$theme['remove']['js'] = array('jquery', 'jquery-ui.min', 'bootstrap.min', 'bootstrap-alert', 'shCore', 'shBrushPhp', 'general', 'codefight-bootstrap');