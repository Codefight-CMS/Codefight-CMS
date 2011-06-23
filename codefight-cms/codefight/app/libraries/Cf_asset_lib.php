<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cf_asset_lib {

	var $css = array();
	var $js = array();
	var $defaults = array();
    
    var $is_js_css_split  = false;
    var $combine_css  = false;
    var $minify_css  = false;
    var $combine_js  = false;
    var $minify_js  = false;
    
	var $assets_dir = '';
    var $cache_dir = '';
	
    var $js_css_dir  = array();
    
	var $base_path = '';
    var $base_url = '';
    
    var $js_dir  = '';
	var $js_path = '';
	var $js_url  = '';
	
	var $css_dir  = '';
	var $css_path = '';
	var $css_url  = '';
	
	var $core_template = 'default';
	var $default_template = '3columns'; //this is received from admin
	var $template;
	
	var $js_path_default = '';
	var $js_url_default  = '';
	var $css_path_default = '';
	var $css_url_default  = '';
	
	var $CI;
	
	
	/** 
	* Load Config
	*/	
	function config($config)
	{
		//setting from MY_config
		foreach ($config as $key => $value)
		{
			$this->$key = $value;
		}
		
		//setting from admin
		//print_r($this->CI->cf_setting_model->setting);
		foreach($this->CI->cf_setting_model->setting as $k => $v)
		{
			$this->$k = $v;
		}
	}

	//load all the assets
	function load($assets = array(), $sub_folder=false)
	{
		$this->CI =& get_instance();
		
		//Get Config values
		$cf_config = $this->CI->config->config;
		
		/*
		 * Get Base url value and add it to array cf
		 * Array cf is defined at MY_config at config folder
		 */
		$cf_config['cf']['base_url'] = $cf_config['skin_url'];
		
		//Now get config values and set in the variables
		$this->config($cf_config['cf']);
	
		/*
		 * Modified since 1.4.3
		 */
		if(!$sub_folder)
		{
			 $uri_1 = $this->CI->uri->segment(1, 'frontend');
			 
			if($uri_1 == 'admin')
			{
				/*
				 * admin can use frontend skin files, but frontend can't use admin files.
				 * This option was added so i don't have to add same js files in 2 locations and so on...
				 */
				$this->js_css_dir = array('admin','frontend');
			}
			else
			{
				$this->js_css_dir = array('frontend');
			}
				
		} else {
			$sub_folder = (array)$sub_folder;
			
			$this->js_css_dir = $sub_folder;
		}
		/*---END--Modified*/
		
		if(is_array($assets)) foreach($assets as $k => $a) {
			$this->$k = $a;
		}

		$tmpl = false;//$this->CI->session->userdata('template'[CFWEBSITEID]);
		$userdata['template'] = $this->CI->session->userdata('template');
		if(isset($userdata['template'][CFWEBSITEID]))
		{
			$tmpl = $userdata['template'][CFWEBSITEID];
		}
		
		if(!empty($tmpl)) {
			$this->template = $tmpl . '/';//[CFWEBSITEID]
		}
		else {
			$this->template = $this->default_template . '/';
		}
	}
	
	//start getting assets
	function get()
	{
		//get requested CSSs
		if(is_array($this->css)) foreach($this->css as $k => $g)
		{
			//if $g is not array i.e. media type not defined
			//set its media type default as all
			if(!is_array($g)) {
				$g = array($g);
				$k = 'all';
			}
			
			//get autoloaded/default css
			$def = array();
			if(isset($this->defaults['css']) && isset($this->defaults['css'][$k])) {
				$def = $this->defaults['css'][$k];
				unset($this->defaults['css'][$k]);
			}
			
			if(is_array($def)) $g = array_merge($g, $def);
			
			//remove duplicate requests
			$g = array_unique($g);
			$this->echo_css($g, $k);
		}
		
		//Load autoloaded css, that are still not loaded above
		if(isset($this->defaults['css']) && is_array($this->defaults['css'])) foreach($this->defaults['css'] as $k => $g) {
			$this->echo_css($g, $k);
		}
		
		//get requested JSs
		if(is_array($this->js))
		{
			//get autoloaded/default js
			$def = array();
			if(isset($this->defaults['js'])) {
				$def = $this->defaults['js'];
				unset($this->defaults['js']);
			}
			
			if(is_array($def)) $g = array_merge($this->js, $def);
			
			//remove duplicate requests
			$g = array_unique($g);
			$this->echo_js($g);
		}
	}
	
	
	/*
	 * Look for the file (css|js) and return the correct file url
	 */
	function get_path_url($file = 'cf', $type = 'css') {
		$type_path = $type . '_path';
		$type_url = $type . '_url';
		$type_dir = $type . '_dir';
		$type_url_default = $type . '_url_default';
		$type_path_default = $type . '_path_default';
		
		//$template = $this->default_template . '/';
		$template_default = $this->core_template . '/';
		//if($this->CI->session->userdata('template')) $template = $this->CI->session->userdata('template') . '/';
		
		//js|css spreaded into different directories?
		if($this->is_js_css_split)
		{ //true, i.e. js|css are under subfolders of assets
			
			foreach($this->js_css_dir as $j)
			{
				$this->$type_path = $this->base_path.$this->assets_dir.$j.'/'.$this->template.$this->$type_dir.'/';
				$this->$type_url = $this->base_url.$this->assets_dir.$j.'/'.$this->template.$this->$type_dir.'/';
				//default assets
				$this->$type_path_default = $this->base_path.$this->assets_dir.$j.'/'.$template_default.$this->$type_dir.'/';
				$this->$type_url_default = $this->base_url.$this->assets_dir.$j.'/'.$template_default.$this->$type_dir.'/';
				
				if(is_file($this->$type_path.$file.'.'.$type)) {
					//return file path
					$ret['path'] = $this->$type_path.$file.'.'.$type;
					//return file url
					$ret['url'] = $this->$type_url.$file.'.'.$type;
					//return cache path
					$ret['cache_path'] = $j.'/'.$this->template;
					$ret['filename'] = $file.'.'.$type;
					return $ret;
				}
				else if(is_file($this->$type_path_default.$file.'.'.$type)) {
					//if file not found in template get it from default template
					//return file path
					$ret['path'] = $this->$type_path_default.$file.'.'.$type;
					//return file url
					$ret['url'] = $this->$type_url_default.$file.'.'.$type;
					//return cache path
					$ret['cache_path'] = $j.'/'.$template_default;
					$ret['filename'] = $file.'.'.$type;
					return $ret;
				}
			}
			return false;
			
		} 
		else { //false, i.e. js|css are directly under assets directory
			if(is_file($this->base_path.$this->assets_dir.$this->$type_dir.'/'.$file.'.'.$type)) {
				//return file path
				$ret['path'] = $this->base_path.$this->assets_dir.$this->$type_dir.'/'.$file.'.'.$type;
				//return file url
				$ret['url'] = $this->base_url.$this->assets_dir.$this->$type_dir.'/'.$file.'.'.$type;
				//return cache path
				$ret['cache_path'] = '';
				$ret['filename'] = $file.'.'.$type;
				return $ret;
			}
			else {
				return false;
			}
		}
	}
	
	//process css
	function echo_css($css_array = array(), $media = 'all')
	{
		echo "\n<!-- START: CSS for media type $media -->";
		if($this->combine_css == true) {
			$css_array = $this->combine($css_array, 'css', $media);
		}
		else {
			foreach($css_array as $c) {
				$c = $this->get_path_url($c);
				if(isset($c['url']))
					echo "\n" . '<link rel="stylesheet" href="' . $c['url'] . '" type="text/css" media="' . $media . '" />';
			}
		}
		echo "\n<!-- END: CSS -->\n";
	}
	
	//process js
	function echo_js($js_array = array())
	{
		echo "\n<!-- START: JS -->";
		if($this->combine_js == true)
		{
			$js_array = $this->combine($js_array, 'js');
		}
		else
		{
			foreach($js_array as $j)
			{
				$j = $this->get_path_url($j, 'js');
				if(isset($j['url']))
					echo "\n" . '<script type="text/javascript" src="' . $j['url'] . '"></script>';
			}
		}
		echo "\n<!-- END: JS -->\n";
	}

	//combine assets | Currently support for css only
	function combine($css_array = array(), $type = 'css', $media='all')
	{
		$files = array();
		
		foreach($css_array as $k => $c) {
			$p = $this->get_path_url($c, $type);
			if(isset($p['path'])) 
			{
				$files[$p['cache_path']][] = $p;
			}
			
		}
		
		foreach($files as $k => $v) $this->echo_combined($v, $type, $media);
	}
	
	function echo_combined($files = array(), $type = 'css', $media='all') 
	{
		$file_name = 'cf';
		$combined_code = '';
		$cache_path = '';
		
		foreach($files as $c) {
			$combined_code .= file_get_contents($c['path']);
			$file_name .= $c['filename'];//substr($c['filename'],0,2);//just taking first 2 characters of the filename|no reason 4 this
			$cache_path = $c['cache_path'];
		}

		//clean filename
		$file_name = md5(preg_replace('/[^0-9a-z]+/','',strtolower($file_name)));
		
		//destination dir where combined file will be written
		$destination_dir = $this->base_path.$this->assets_dir.$cache_path.$this->cache_dir.'/';
		
		$create_file = true;
		//check to see when the file was modified
		if(file_exists($destination_dir.$file_name.'.'.$type)) {
			$modified_time = date("YmdH", filemtime($destination_dir.$file_name.'.'.$type));
			$current_time = date("YmdH", time());
			//If file modified time is less than 24hrs, don't modify file|to be set from setting on later versions
			if(($current_time-$modified_time) < 24) $create_file = false;
		}
		
		if($create_file) {
			//if destination dir doesn't exists, create one
			if(!is_dir($destination_dir)) mkdir($destination_dir);
			
			//if the file already exists, delete it first
			if(is_file($destination_dir.$file_name.'.'.$type)) unlink($destination_dir.$file_name.'.'.$type);
			
			//if css minify config is true, minify it
			if($type == 'css' && $this->minify_css == true)
			{
				/*
				 * Remove comment between /* and */
				 //*/
				$combined_code = preg_replace('/\/\*(.+)\*\//sU','', $combined_code);
				/*
				 * Remove spaces between { and }
				 */
				$combined_code = preg_replace('/\s+?\}\s+?/isU','}', $combined_code);
				$combined_code = preg_replace('/\s+?\{\s+?/isU','{', $combined_code);
				/*
				 * Remove extra spaces
				 */
				$combined_code = preg_replace('/\s\s+/',' ', $combined_code);
				/*
				 * Remove spaces after ;
				 */
				$combined_code = preg_replace('/;\s+?/sU',';', $combined_code);
				/*
				 * Trim it.
				 */
				$combined_code = trim($combined_code);
			}
			
			//if css minify config is true, minify it
			if($type == 'js' && $this->minify_js == true)
			{
				//
			}
			
			//create file and write contents.
			if (is_writable($destination_dir)) die('Could not open folder to write. Please give write permission to the folder. <br />' . "\n\n{$destination_dir}");
			
			$oFile = fopen($destination_dir.$file_name.'.'.$type, 'w');
			if (flock($oFile, LOCK_EX)) {
				fwrite($oFile, $combined_code);
				flock($oFile, LOCK_UN);
			}
			fclose($oFile);
		}
		
		//if successfully created combined file, display|echo this file
		if(is_file($destination_dir.$file_name.'.'.$type))
		{
			if($type == 'css') 
				echo "\n" . '<link rel="stylesheet" href="' . $this->base_url.$this->assets_dir.$cache_path.$this->cache_dir.'/'.$file_name.'.'.$type . '" type="text/css" media="' . $media . '" />';
			else
				echo "\n" . '<script type="text/javascript" src="' . $this->base_url.$this->assets_dir.$cache_path.$this->cache_dir.'/'.$file_name.'.'.$type . '"></script>';
		}
	}
}
?>