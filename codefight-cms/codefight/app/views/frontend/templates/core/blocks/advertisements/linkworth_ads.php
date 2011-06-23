<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php if(base_url() == 'http://codefight.org/'): //Load only if the site is codefight.org

echo file_get_contents('http://feeds.chiej.com/?440e5d8575ff7ca6c3d9fdbf4ee97aeb437');

endif; ?>