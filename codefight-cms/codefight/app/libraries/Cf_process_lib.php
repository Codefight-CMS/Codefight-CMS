<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cf_process_lib
{

    function view($html_string = '', $minify_this_page = true)
    {
        $CI =& get_instance();

        $html_string = preg_replace('/\[\[BASE_URL\]\]/i', base_url(), $html_string);
        $html_string = preg_replace('/\[\*\[/i', '[[', $html_string);
        $html_string = preg_replace('/\]\*\]/i', ']]', $html_string);

        //Do you want to minify your html
        $html_tidy = $CI->cf_asset_lib->minify_html; //$CI->config->item('cf_minify_html');

        if ($html_tidy == '1' && $minify_this_page == true) {
            $html_string = preg_replace('#>\s+?<#sU', '><', $html_string);
            $html_string = trim(preg_replace('/\s\s+/', ' ', $html_string));
        }
        echo $html_string;
    }

}

?>