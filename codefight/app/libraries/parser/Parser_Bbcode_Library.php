<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 *
 */
class Parser_Bbcode_Library extends MY_Library
{
    /**
     * @param string $html_string
     * @param array  $matches
     *
     * @return string
     */public function parse($html_string = '', $matches = array())
    {
        //@todo: Bbcode parsers
        return $html_string;
    }
}
