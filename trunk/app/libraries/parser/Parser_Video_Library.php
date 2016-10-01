<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 *
 */
class Parser_Video_Library extends MY_Library
{

    /**
     * @param string $html_string
     * @param array $matches
     *
     * @return string
     */
    public function parse($html_string = '', $matches = array())
    {
        if(!isset($matches[2]) || !isset($matches[2][0])){
            return $html_string;
        }
        $video = preg_replace('#\[|\]|<br\s*/?\s*>#', "\n", $matches[2][0]);
        $video = explode("\n", trim($video));
        $video = implode("&", $video);
        parse_str($video, $output);
        $video = $this->_get_video_script($output);
        return str_replace($matches[0][0], $video, $html_string);
    }

    private function _get_video_script($params)
    {
        $video = '
        <video
            controls
            id="' . $this->_get_video_id($params) . '"
            class="video-js vjs-16-9 vjs-default-skin" ' .
            $this->_get_video_width($params) .
            $this->_get_video_height($params) . ' 
            data-setup=\'{ 
            "techOrder": ["youtube"], 
            "sources": [{ "type": "video/youtube", "src": "' . $this->_get_video_src($params) . '"}], 
            "youtube": { "ytControls": 0 } 
            }\'>
        </video>';

        return $video;
    }

    private function _get_video_id($params)
    {
        if(isset($params['id'])){
            return $params['id'];
        }
        return 'video-' . time();
    }

    private function _get_video_width($params)
    {
        $width = 320;
        if(isset($params['width'])){
            $width = $params['width'];
        }
        return " width='{$width}' ";
    }

    private function _get_video_height($params)
    {
        $height = 0;
        if(isset($params['height'])){
            $height = $params['height'];
        }
        return $height ? " height='{$height}' " : '';
    }

    private function _get_video_src($params)
    {
        $src = 'https://www.youtube.com/watch?v=X-bfCyGgJSU';
        if(isset($params['src'])){
            $src = $params['src'];
        }
        return $src;
    }
}
