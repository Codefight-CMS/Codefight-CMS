<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class Cf_module_lib {
	
	var $CI;
	var $XML=false;
	var $nav=false;

	function _getAdminNav()
	{
		$this->CI =& get_instance();
		$files = $this->_getXmls();
		$nav_array = $this->_mergeXmls($files);

		$nav = array();
		foreach((array)$nav_array as $k => $v)
		{
			$nav[$k] = $k;
			
			if(isset($v['@attributes']['title']))
			{
				$title = $v['@attributes']['title'];
				unset($v['@attributes']);
				
				if(count($v) > 0)
				{
					if(is_array($title))
						$_title = (string)$title[0];
					else
						$_title = (string)$title;
					
					$title = array();
					$child_position_sort = array();
					foreach($v as $k2 => $v2)
					{
						$child_position = 99999;
						//---
						$title_text = (string)$v[$k2];
						$title[$_title][$k.'/'.$k2] = $title_text;
						if(is_array($v[$k2]))
						{
							if(isset($v[$k2]['@content']))
							{
								$title_text = (string)$v[$k2]['@content'];
								$title[$_title][$k.'/'.$k2] = $title_text;
							}
							if(isset($v[$k2]['@attributes']['position']))
								$child_position = (string)$v[$k2]['@attributes']['position'];
						}
						$child_position_sort[":{$child_position}:{$k}/{$k2}"] = $title_text;
					}
					ksort($child_position_sort);
					$nav[$k] = array();
					$nav[$k][$_title] = $child_position_sort;
					//print_r($child_position_sort);
				}
			} else if((is_array($v)) && isset($v[key($v)]['title'])) {
				$nav[$k] = (string)$v[key($v)]['title'];
			} else {
				$nav[$k] = (string)$v;
			}
		}
		
		//print_r($nav);
		return $nav;
	}

	function _mergeXmls($files=array())
	{
		if(!count($files)) return '';
		
		$nav=array();
		$sort = array();
		$xmlRaw = '<'.'?xml version="1.0"?'.'><cfmodules>';
		foreach($files as $v)
		{
			$xmlRaw .= preg_replace('@<\?xml(.+)\?>@iU', '', file_get_contents($v));
		}
		$xmlRaw .= '</cfmodules>';
		$xmlData = $this->CI->cf_simplexml_lib->xml_parse($xmlRaw);
		
		if(!isset($xmlData['module'])) return array();

		foreach($xmlData['module'] as $k => $v)
		{
			$position = 99999;
			if((!isset($v['active'])) || (strtolower($v['active']) !== 'true')) continue;//die($data->active);//
			if(isset($v['sort'])) $position = (string)$v['sort'];
			
			if(isset($v['admin']['navigation'])) 
			{
				$data = $v['admin']['navigation'];
				
				if(!isset($sort[key($data)]) || ($sort[key($data)] > $position)) $sort[key($data)] = $position;
				
				$nav = array_merge_recursive($nav, $data);
			}
		}
		asort($sort);
		
		foreach($sort as $k => $v)
		{
			$sort[$k] = $nav[$k];
			unset($nav[$k]);
		}
		
		return array_merge_recursive($sort, $nav);
	}

	function _getXmls()
	{
		$ret = array();
		
		$dir = FCPATH . 'app/modules/';

		if ($handle = opendir($dir))
		{
			while(false !== ($file = readdir($handle)))
			{
				if($file != "." && $file != ".." && $file != 'Thumbs.db' && $file != 'index.html' && is_file($dir.$file))
				{
					$ret[$dir.$file] = $dir.$file;
				}
			}
			closedir($handle);
		}
	
		return $ret;
	}
}
?>