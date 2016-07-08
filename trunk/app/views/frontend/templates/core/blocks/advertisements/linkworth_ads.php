<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php if (base_url() == 'http://codefight.org/'): //Load only if the site is codefight.org

    $linkads_hndl = curl_init("http://feeds.chiej.com/?440e5d8575ff7ca6c3d9fdbf4ee97aeb437");
    curl_exec($linkads_hndl);
    curl_close($linkads_hndl);

    $rotating_ads = file_get_contents('http://www.codefight.org/lw_rads.php?location=3&format=6&website_id=60933');
    echo $rotating_ads;

endif; ?>