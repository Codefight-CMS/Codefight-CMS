<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 *
 */
class Process_Library extends MY_Library
{
    /**
     * @param string $html_string
     * @param bool $minify_this_page
     */
    function view($html_string = '', $minify_this_page = true)
    {
        $CI =& get_instance();

        if ($CI->cfModule != 'admin') {
            preg_match_all('/{{parse\-(.*)\s\s*(.*)\s*}}/isU', $html_string, $matches);
            if (count($matches) > 1) {
                foreach ($matches[1] as $k => $v) {
                    $v = preg_replace('/[^a-z0-9]/isU', '', strtolower($v));

                    try{
                        $html_string = Library('parser/' . $v)->parse($html_string, $matches);
                    } catch (Exception $e){
                        // log error
                    }
                }
            }

            $html_string = preg_replace('/\[\[BASE_URL\]\]/i', base_url(), $html_string);

            $html_string = preg_replace('/\{\*\{/i', '{{', $html_string);
            $html_string = preg_replace('/\}\*\}/i', '}}', $html_string);
        }
        $html_string = preg_replace('/\[\*\[/i', '[[', $html_string);
        $html_string = preg_replace('/\]\*\]/i', ']]', $html_string);

        //Do you want to minify your html
        $html_tidy = Library('asset')->minify_html;

        if ($html_tidy == '1' && $minify_this_page == true) {
            $html_string = preg_replace('#>\s+?<#sU', '><', $html_string);
            $html_string = trim(preg_replace('/\s\s+/', ' ', $html_string));
        }
        echo $html_string;
    }

}
