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

        if($CI->cfModule != 'admin'){
            $html_string = preg_replace('/\[\[BASE_URL\]\]/i', base_url(), $html_string);
            $html_string = preg_replace('/\[\*\[/i', '[[', $html_string);
            $html_string = preg_replace('/\]\*\]/i', ']]', $html_string);

            preg_match_all('/{{tag\s\s*(.*)\s*}}/isU', $html_string, $matches);
            if(isset($matches[1])){
                foreach($matches[1] as $k => $v){
                    preg_match_all("@\s*(.+)='(.+)'@isU", trim($v), $v);
                    if(isset($v[1])){
                        $tagCode = $matches[0][$k];
                        $title = $url = $attr = '';
                        foreach($v[1] as $k1 => $v1){
                            $v1 = strtolower(trim($v1));
                            $v[2][$k1] = trim($v[2][$k1]);
                            if($v1=='url'){
                                if(!preg_match('/mailto:|https?:\/\//isU',$v[2][$k1])){
                                    $v[2][$k1] = site_url(url_title(strtolower(trim($v[2][$k1]))));
                                }
                                $url = $v[2][$k1];
                            } else if($v1=='title'){
                                $title = $v[2][$k1];
                            } else {
                                $attr .= " {$v1}=\"{$v[2][$k1]}\"";
                            }
                        }
                        if(empty($url) && !empty($title)){
                            $url = site_url('blog/tag/'.url_title(strtolower($title)));
                        }
                        if(empty($title)){
                            $tagReplace = $url;
                        }else{
                            $tagReplace = '<a href="'. $url .'"'. $attr .'>' . $title . '</a>';
                        }
                        $html_string = str_replace($tagCode, $tagReplace, $html_string);
                    }
                }
            }
            //preg_match_all('/{{tag\s*(url=\'(.*)\')?\s*(rel=\'(.*)\')?\s*(title=\'(.*)\')?\s*(.*)}}/iSu', $html_string, $matches);
        }
/*
Array
(
    [0] =&gt; Array
        (
            [0] =&gt; {{tag url='http://codefight.org/' rel='external,nofollow' title='Codefight CMS'}}
            [1] =&gt; {{tag title='Codeigniter CMS'}}
        )

    [1] =&gt; Array
        (
            [0] =&gt; url='http://codefight.org/' rel='external,nofollow' title='Codefight CMS'
            [1] =&gt; title='Codeigniter CMS'
        )

)
 */
        //Do you want to minify your html
        $html_tidy = Library('asset')->minify_html; //$CI->config->item('cf_minify_html');

        if ($html_tidy == '1' && $minify_this_page == true) {
            $html_string = preg_replace('#>\s+?<#sU', '><', $html_string);
            $html_string = trim(preg_replace('/\s\s+/', ' ', $html_string));
        }
        echo $html_string;
    }

}

?>
