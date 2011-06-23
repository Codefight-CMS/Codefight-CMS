<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeFight
 *
 * An open source application
 *
 * @package		CodeFight
 * @author		CodeFight Dev Team
 * @copyright	Copyright (c) 2010, Codefight.org
 * @license		Pending
 * @link		http://codefight.org
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Codefight General Helpers
 *
 * @package		CodeFight
 * @subpackage	Helpers
 * @category	Helpers
 * @author		CodeFight Dev Team
 * @link		Pending Doc Link
 */

// ------------------------------------------------------------------------

/**
 * Get Global Messages
 *
 * @access	public
 * @param	void
 * @return	string
 */
//error_reporting(0);
if ( ! function_exists('get_global_messages'))
{
	function get_global_messages()
	{
		$str = '';
		$CI =& get_instance();
		
		$global_messages = (array)$CI->session->userdata('global_messages');
		
		/*remove empty items*/
		$global_messages = array_filter($global_messages);
		
		if(count($global_messages) > 0) {
			foreach($global_messages as $k => $v) {
				echo '<div class="'.$k.'">';
				
				foreach((array)$v as $w) {
					echo "$w\n";
				}
				
				echo '</div>';
			}
		} 
		
		$CI->session->unset_userdata('global_messages');
		
		return $str;
	}
}


/**
 * Set Global Messages
 *
 * @access	public
 * @param	array | String
 * @return	void
 */	
if ( ! function_exists('set_global_messages'))
{
	function set_global_messages($msg='', $type='error', $is_multiple=true)
	{
		$CI =& get_instance();
		
		$global_messages = (array)$CI->session->userdata('global_messages');
		
		foreach((array)$msg as $v) {
			if($is_multiple)
				$global_messages[$type][] = (string)$v;
			else
				$global_messages[$type][0] = (string)$v;
		}

		$CI->session->set_userdata('global_messages', $global_messages);
	}
}


/**
 * Get Top Menu
 *
 * @access	public
 * @param	void
 * @return	string
 */	
if ( ! function_exists('get_top_menu'))
{
	function get_top_menu()
	{
		$CI =& get_instance();
		
		if($CI->session->userdata('logged_in') === '1') {
			return $CI->load->view('admin/inc/top_menu');
			
		}
		
		return '';
	}
}


/**
 * Get Page Url
 *
 * @access	public
 * @param	array
 * @return	string
 */	
if ( ! function_exists('get_page_url'))
{
	function get_page_url($data)
	{
		
		$url = '';//base_url();
		$CI =& get_instance();
		
		$data = (array)$data;
		if(!count($data)) return $url;
		
		if(empty($data['menu_id'])) $data['menu_id'] = 0;
		
		$menu_id = $CI->cf_helper_model->get_menu_link($data['menu_id'], $data['page_type']);
		
		if(!empty($data['page_type']))
		{
			if($data['page_type'] == 'page') return $menu_id;
			
			$url .= $data['page_type'].'/'; //add page type as controller
		}
		
		$url .= $menu_id.'/'; //add menu id
		
		/*
		if(!empty($data['menu_id']))
		{
			$menu_id = trim($data['menu_id'], ',');
			if(strpos($menu_id, ',')) $menu_id = substr_replace($menu_id, '', strpos($menu_id, ','));
		
			if(!empty($menu_id) || $menu_id == 0) $url .= $menu_id.'/'; //add menu id
		}
		*/
		
		if(!empty($data['page_id'])) $url .= $data['page_id'].'/'; //add page id
		
		if(!empty($data['page_title'])) $url .= url_title($data['page_title']);
		
		return ($url);
	}
}


/**
 * Get Page Url
 *
 * @access	public
 * @param	void
 * @return	string
 */	
if ( ! function_exists('get_canonical_url'))
{
	function get_canonical_url()
	{
		$url = current_url();
		
		$CI =& get_instance();
		$page_id = (int)$CI->uri->segment(3);
		//echo $page_id;
		
		if($page_id)
		{
			
			$CI->load->model('blog/cf_blog_model');
			
			$data = $CI->cf_blog_model->get_page_full($page_id);
			
			if(isset($data['content'][0])) $url = site_url(get_page_url($data['content'][0]));
		} else {
			$segments = $CI->uri->segment_array();
			//print_r($segments);
			foreach($segments as $k => $v)
			{
				//----
				//$corrupted = substr($v, -5);
				while(substr($v, -5) == '_html') $v = substr($v, 0, -5);
				
				$segments[$k] = $v;
			}
			
			$url = site_url(implode('/', $segments));
		}
		
		
		return $url;
	}
}


if ( ! function_exists('get_random_bg'))
{
	function get_random_bg()
	{
		$ret = array();
		$CI =& get_instance();
		
		if(!defined('SKINPATH')) define('SKINPATH', (FCPATH));
		
		$folder_path = 'skin/frontend/' . $CI->cf_asset_lib->template . 'images/bg/';
		$dir = SKINPATH . $folder_path;

		$skin_url = $CI->config->item('skin_url');
		if(empty($skin_url)) $skin_url = base_url();

		if ($handle = opendir($dir))
		{
			while(false !== ($file = readdir($handle)))
			{
				if($file != "." && $file != ".." && $file != 'Thumbs.db' && is_file($dir.$file))
				{
					$ret[$file] = $file;
				}
			}
			closedir($handle);
		}
	
		if(count($ret))
		{
			$rand_key = array_rand($ret, 1);
			
			return $skin_url . $folder_path . $ret[$rand_key];
		}
		else
		{
			return false;
		}
	}
}		
	
if ( ! function_exists('latest_version'))
{
	function latest_version()
	{
		error_reporting(0);
		$CI =& get_instance();
		
		$string = '';
		
		$url = 'http://codefight.org/tools/version/'.preg_replace('/[^a-z0-9\-]+/i','_',$_SERVER['HTTP_HOST']);
		$ver_file = FCPATH."version.txt"; $fh = fopen($ver_file, 'r'); $ver_data = fgets($fh); fclose($fh);
		
		if($CI->session->userdata('logged_in') === '1')
		{
			$returnStr = 0;
			if($fp=fopen($url, "r"))
			{
				$returnStr=fgets($fp);
				fclose($fp);
			}
			$string .= " version {$ver_data}";
			
			$ver_avail = preg_replace('/[^0-9\.]+/','',$returnStr);
			
			if(!empty($ver_avail) && $ver_avail > $ver_data) $string .= ' &nbsp; <span class="error">New version '.$ver_avail.' is available for <a target="_blank" href="http://codefight.org/">download</a></span>';
		}
		
		return $string;
	}
}	


/**
 * Get Default Email Recipients
 *
 * @access	public
 * @param	void
 * @return	array
 */	
if ( ! function_exists('get_default_recipients'))
{
	function get_default_recipients()
	{
		$CI =& get_instance();
		
		if(isset($CI->setting->default_recipients))
		{
			//replace ; and | with comma. This is to allow different email separators
			$email_default = trim(preg_replace(array('/;/', '/\|/'), ',', $CI->setting->default_recipients));
			
			return explode(',',$email_default);
		}
		
		return array();
	}
}
/* End of file general_helper.php */
/* Location: ./app/admin/helpers/general_helper.php */