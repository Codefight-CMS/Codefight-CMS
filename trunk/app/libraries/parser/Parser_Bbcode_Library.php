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
    var $pattern_replacement = array(
        '#\[php\]#is' => " &lt;?php ",
        '#\[\/php\]#is' => " ?&gt; ",
        '#\[b\]#is' => " <strong> ",
        '#\[\/b\]#is' => " </strong> ",
    );

    /**
     * @param string $html_string
     * @param array $matches
     *
     * @return string
     */
    public function parse($html_string = '', $matches = array())
    {
        return preg_replace(array_keys($this->pattern_replacement), array_values($this->pattern_replacement), $html_string);
    }
}
