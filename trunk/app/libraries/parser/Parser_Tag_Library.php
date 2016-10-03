<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 *
 */
class Parser_Tag_Library extends MY_Library
{
    /**
     * @param string $html_string
     * @param array $matches
     *
     * @return string
     */
    public function parse($html_string = '', $matches = array())
    {
        if (isset($matches[1])) {
            $matches[1] = $matches[2]; //we are actually after match on key 2.
            foreach ($matches[1] as $k => $v) {
                preg_match_all("@\s*(.+)='(.+)'@isU", trim($v), $v);
                if (isset($v[1])) {
                    $tagCode = $matches[0][$k];
                    $title = $url = $attr = '';
                    foreach ($v[1] as $k1 => $v1) {
                        $v1 = strtolower(trim($v1));
                        $v[2][$k1] = trim($v[2][$k1]);
                        if ($v1 == 'url') {
                            if (!preg_match('/mailto:|https?:\/\//isU', $v[2][$k1])) {
                                $v[2][$k1] = site_url(url_title(strtolower(trim($v[2][$k1]))));
                            }
                            $url = $v[2][$k1];
                        } else {
                            if ($v1 == 'title') {
                                $title = $v[2][$k1];
                            } else {
                                $attr .= " {$v1}=\"{$v[2][$k1]}\"";
                            }
                        }
                    }
                    if (empty($url) && !empty($title)) {
                        $url = site_url('blog/tag/' . url_title(strtolower($title)));
                    }
                    if (empty($title)) {
                        $tagReplace = $url;
                    } else {
                        $tagReplace = '<a href="' . $url . '"' . $attr . '>' . $title . '</a>';
                    }
                    $html_string = str_replace($tagCode, $tagReplace, $html_string);
                }
            }
        }
        return $html_string;
    }
}
