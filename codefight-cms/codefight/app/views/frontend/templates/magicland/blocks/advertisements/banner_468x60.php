<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php
//Get Advertisement
$banner = array(
    'sid' => '1066153',
    'zs' => '3436385f3630',
    'opid' => '1066153',
    'afsid' => '1',
    'size' => '468x60',
    'provider' => 'adbrite',
    //'location' => 'header',
    'AdBrite_Title_Color' => '88c7d0',
    'AdBrite_Text_Color' => '85c322',
    'AdBrite_Background_Color' => 'fffed0',
    'AdBrite_Border_Color' => 'fffed0',
    'AdBrite_URL_Color' => 'fffed0',
    'show_your_add_here' => true
);
echo $this->cf_banner_model->get_advertisement($banner);