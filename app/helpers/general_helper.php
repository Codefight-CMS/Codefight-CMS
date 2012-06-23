<?php  if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * CodeFight
 *
 * An open source application
 *
 * @package        CodeFight
 * @author         CodeFight Dev Team
 * @copyright      Copyright (c) 2010, Codefight.org
 * @license        Pending
 * @link           http://codefight.org
 * @since          Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Codefight General Helpers
 *
 * @package        CodeFight
 * @subpackage     Helpers
 * @category       Helpers
 * @author         CodeFight Dev Team
 * @link           Pending Doc Link
 */

// ------------------------------------------------------------------------

if (!function_exists('Library')) {
    /**
     * @param string $library
     *
     * @return mixed
     */
    function Library($library = 'codefight', $params = NULL)
    {
        $MY_Library = new MY_Library();
        return $MY_Library->Library($library, $params);
    }
}

if (!function_exists('Model')) {
    /**
     * @param string $model
     *
     * @return mixed
     */
    function Model($model = 'codefight', $config = FALSE)
    {
        if(!is_object('MY_Model')){
            include_once APPPATH . DS . 'core' . DS . 'MY_Model.php';
        }

        //$CI =& get_instance();
        $MY_Model = new MY_Model();
        //$CI->model('MY_Model');
        return $MY_Model->Model($model, $config);
        //return $MY_Model->Model($model);
    }
}

if (!function_exists('getMessages')) {
    /**
     * @return string
     */
    function getMessages()
    {
        $str = '';
        $CI  =& get_instance();

        $globalMessages = (array)$CI->session->userdata('globalMessages');

        /*remove empty items*/
        $globalMessages = array_filter($globalMessages);

        if (count($globalMessages) > 0) {
            foreach ($globalMessages as $k => $v) {
                echo '<div class="alert alert-' . $k . '"><a class="close" data-dismiss="alert">×</a>';

                foreach ((array)$v as $w) {
                    echo "$w\n";
                }

                echo '</div>';
            }
        }

        $CI->session->unset_userdata('globalMessages');

        return $str;
    }
}

if (!function_exists('setMessages')) {
    /**
     * @param string $msg
     * @param string $type
     * @param bool   $is_multiple
     */
    function setMessages($msg = '', $type = 'error', $is_multiple = true)
    {
        $CI =& get_instance();

        $globalMessages = (array)$CI->session->userdata('globalMessages');

        foreach ((array)$msg as $v) {
            if ($is_multiple) {
                $globalMessages[$type][] = (string)$v;
            } else {
                $globalMessages[$type][0] = (string)$v;
            }
        }
        if (isset($globalMessages[0])) {
            unset($globalMessages[0]);
        }

        $CI->session->set_userdata('globalMessages', $globalMessages);
    }
}

if (!function_exists('get_top_menu')) {
    /**
     * @return string
     */
    function get_top_menu()
    {
        $CI =& get_instance();

        if ($CI->session->userdata('logged_in') === '1') {
            return $CI->load->view('admin/inc/top_menu');

        }

        return '';
    }
}

if (!function_exists('get_page_url')) {
    /**
     * @param $data
     *
     * @return string
     */
    function get_page_url($data)
    {

        $url = ''; //base_url();
        $CI  =& get_instance();

        $data = (array)$data;
        if (!count($data)) {
            return $url;
        }

        if (empty($data['menu_id'])) {
            $data['menu_id'] = 0;
        }

        $menu_id = Model('helper')->get_menu_link($data['menu_id'], $data['page_type']);

        if (!empty($data['page_type'])) {
            if ($data['page_type'] == 'page') {
                return $menu_id;
            }

            $url .= $data['page_type'] . '/'; //add page type as controller
        }

        $url .= $menu_id . '/'; //add menu id

        /*
          if(!empty($data['menu_id']))
          {
              $menu_id = trim($data['menu_id'], ',');
              if(strpos($menu_id, ',')) $menu_id = substr_replace($menu_id, '', strpos($menu_id, ','));

              if(!empty($menu_id) || $menu_id == 0) $url .= $menu_id.'/'; //add menu id
          }
          */

        if (!empty($data['page_id'])) {
            $url .= $data['page_id'] . '/';
        } //add page id

        if (!empty($data['page_title'])) {
            $url .= url_title($data['page_title']);
        }

        return ($url);
    }
}

if (!function_exists('get_canonical_url')) {
    /**
     * @return mixed
     */
    function get_canonical_url()
    {
        $url = current_url();

        $CI      =& get_instance();
        $page_id = (int)$CI->uri->segment(3);
        //echo $page_id;

        if ($page_id) {
            $data = Model('blog')->get_page_full($page_id);

            if (isset($data['content'][0])) {
                $url = site_url(get_page_url($data['content'][0]));
            }
        } else {
            $segments = $CI->uri->segment_array();
            //print_r($segments);
            foreach ($segments as $k => $v) {
                //----
                //$corrupted = substr($v, -5);
                while (substr($v, -5) == '_html') {
                    $v = substr($v, 0, -5);
                }

                $segments[$k] = $v;
            }

            $url = site_url(implode('/', $segments));
        }


        return $url;
    }
}

if (!function_exists('skin_url')) {
    /**
     * @param string $path
     * @param string $file
     *
     * @return string
     */
    function skin_url($path = 'frontend', $file = '')
    {
        if (!defined('SKINPATH')) {
            define('SKINPATH', (FCPATH));
        }
        $CI =& get_instance();

        $path = trim($path, '/');
        $file = trim($file, '/');

        $skin_url = $CI->config->item('skin_url');
        if (empty($skin_url)) {
            $skin_url = base_url();
        }

        switch ($path) {
            case 'global/images':
                $skin_url .= 'skin/global/images/';
                break;
            case 'global':
                $skin_url .= 'skin/global/';
                break;
            case 'frontend':
                $skin_url .= 'skin/frontend/' . Library('asset')->template . '/';
                break;
            default:
                $skin_url .= 'skin/' . trim($path, '/') . '/';
                break;
        }
        return $skin_url . $file;
    }
}

if (!function_exists('get_random_bg')) {
    /**
     * @return bool|string
     */
    function get_random_bg()
    {
        $ret = array();
        $CI  =& get_instance();

        if (!defined('SKINPATH')) {
            define('SKINPATH', (FCPATH));
        }

        $folder_path = 'skin/frontend/' . Library('asset')->template . 'images/bg/';
        $dir         = SKINPATH . $folder_path;

        $skin_url = $CI->config->item('skin_url');
        if (empty($skin_url)) {
            $skin_url = base_url();
        }

        if ($handle = opendir($dir)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != ".." && $file != 'Thumbs.db' && is_file($dir . $file)) {
                    $ret[$file] = $file;
                }
            }
            closedir($handle);
        }

        if (count($ret)) {
            $rand_key = array_rand($ret, 1);

            return $skin_url . $folder_path . $ret[$rand_key];
        }
        else {
            return false;
        }
    }
}

if (!function_exists('latest_version')) {
    /**
     * @return string
     */
    function latest_version()
    {
        error_reporting(0);
        $CI =& get_instance();

        $string = '';

        $url      = 'http://codefight.org/tools/version/' . preg_replace('/[^a-z0-9\-]+/i', '_', $_SERVER['HTTP_HOST']);
        $ver_file = FCPATH . "version.txt";
        $fh       = fopen($ver_file, 'r');
        $ver_data = fgets($fh);
        fclose($fh);

        if ($CI->session->userdata('logged_in') === '1') {
            $returnStr = 0;
            if ($fp = fopen($url, "r")) {
                $returnStr = fgets($fp);
                fclose($fp);
            }
            $string .= " version {$ver_data}";

            $ver_avail = preg_replace('/[^0-9\.]+/', '', $returnStr);

            if (!empty($ver_avail) && $ver_avail > $ver_data) {
                $string
                    .= ' &nbsp; <span class="error">New version ' . $ver_avail
                    . ' is available for <a target="_blank" href="http://codefight.org/">download</a></span>';
            }
        }

        return $string;
    }
}

if (!function_exists('get_default_recipients')) {
    /**
     * @return array
     */
    function get_default_recipients()
    {
        $CI =& get_instance();

        if (isset($CI->setting->default_recipients)) {
            //replace ; and | with comma. This is to allow different email separators
            $email_default = trim(preg_replace(array('/;/', '/\|/'), ',', $CI->setting->default_recipients));

            return explode(',', $email_default);
        }

        return array();
    }
}

/**
 * @param string $language_key : Text to translate
 * @param bool   $return : default return, false to echo translated text
 * @param string   $file : load translation file
 *
 * @return string
 */
if (!function_exists('__')) {
    function __($language_key = '', $return = true, $file = false)
    {
        $CI =& get_instance();

        if ($file) {
            $CI->lang->setFile($file);
        }
        $files = $CI->lang->getFile();

        foreach($files as $file) {
            if (!empty($file)) {
                $filename = 'language' . DS . $CI->language . DS . "{$file}_lang.php";
                $filename_path = str_replace(array('/','\\'), DS, FCPATH . APPPATH . $filename);
                if (is_file($filename_path)) {
                    $CI->lang->load($file, $CI->language);
                } else {
                    $msg = array('error' => "{$CI->language}/{$file}_lang.php not found!");
                    setMessages($msg, 'error', false);
                }
            }
        }

        $string = $CI->lang->line($language_key);

        if (!$string) {
            $string = $language_key;
        }

        if($return){
            return $string;
        }
        echo $string;

        return '';//for older versions.
    }
}

/**
 * @param string $language_key : Text to translate
 * @param bool   $return : default echo, true to return translated text
 * @param string   $file : load translation file
 *
 * @return string
 */
if (!function_exists('___')) {
    function ___($language_key = '', $return = false, $file = false)
    {
		return __($language_key, $return, $file);
    }
}

/* End of file general_helper.php */
/* Location: ./app/helpers/general_helper.php */
