<?php  if (!defined('BASEPATH')) {
    exit('No direct access allowed');
}

$theme = array();

// load css files
$theme['css'] = array('helper', 'bootstrap.min', 'highlight.default', 'bootstrap-theme.min', 'font-awesome.min', 'codefight');

// load js files
$theme['js'] = array('jquery', 'jquery-ui.min', 'bootstrap.min', 'bootstrap-alert', 'codefight-bootstrap');
