<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php if (base_url() == 'http://codefight.org/'
): //Load only if the site is codefight.org

    //Get Advertisement
    $banner = array(
        'sid' => '1066176',
        'zs' => '3732385f3930',
        'opid' => '1066176',
        'afsid' => '1',
        'size' => '728x90',
        'provider' => 'adbrite',
        //'location' => 'header',
        'AdBrite_Title_Color' => '666666',
        'AdBrite_Text_Color' => '999999',
        'AdBrite_Background_Color' => 'FFFFFF',
        'AdBrite_Border_Color' => 'FFFFFF',
        'AdBrite_URL_Color' => 'ffffff',
        'show_your_add_here' => false
    );

    //Display Banner Here
    echo $this->cf_banner_model->get_advertisement($banner);

endif; ?>