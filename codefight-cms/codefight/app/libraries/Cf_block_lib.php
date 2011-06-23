<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cf_block_lib
{
	var $display_path = FALSE;
	
	function load($filename, $template=false, $file_extension = '.php', $return = FALSE)
	{
		//if filename is not passed go no further
		if(empty($filename)) return false;
		
		//Get CI instance
		$CI =& get_instance();
		
		if(empty($template))
		{
			$userdata['template'] = $CI->session->userdata('template');
			if(isset($userdata['template'][CFWEBSITEID]))
			{
				$template = $userdata['template'][CFWEBSITEID];
			}
		}
		
		//Blocks core path
		$blocks_core = APPPATH . 'views/frontend/templates/core/blocks/';
		$blocks_core_view = 'frontend/templates/core/blocks/';
		
		//Blocks template path
		if($template)
		{
			$blocks_template = APPPATH . 'views/frontend/templates/' . $template . '/blocks/';
			$blocks_template_view = 'frontend/templates/' . $template . '/blocks/';
		}
		else
		{
			$blocks_template = false;
		}
		
		//if filename is not array, make it an array
		if(!is_array($filename)) $filename = array($filename);
		
		$html = ' ';
		$html_path = ' ';
		
		if(isset($CI->setting->display_view_path)) $this->display_path = $CI->setting->display_view_path;
		
		
		//Now look for the block and load it with CI's view
		foreach($filename as $v)
		{
			//Set found_it false to check file in core if not found in template
			$found_it = false;
			//If the block need 2 b looked into template
			if($blocks_template)
			{
				//if there is block in template
				if(is_file($blocks_template.$v.$file_extension))
				{
					if($this->display_path == TRUE) 
					{
						$html_path .= '<div class="block_path"><span class="path">'.$blocks_template_view.$v.'</span></div>';
						if(!$return) echo $html_path; else $html .= $html_path;
					}
					
					$html .= $CI->load->view($blocks_template_view.$v, '', $return);
					
					/*
					if($this->display_path == TRUE)
					{
						$html_path .= '';
						if(!$return) echo $html_path; else $html .= $html_path;
					}
					*/
					
					$found_it = true;
				}
			}
			
			//if the block is not found in template
			if(!$found_it)
			{
				//check in core
				if(is_file($blocks_core.$v.$file_extension))
				{
					if($this->display_path == TRUE) 
					{
						$html_path .= '<div class="block_path"><span class="path">'.$blocks_core_view.$v.'</span></div>';
						if(!$return) echo $html_path; else $html .= $html_path;
					}
					
					$html .= $CI->load->view($blocks_core_view.$v, '', $return);
					
					/*
					if($this->display_path == TRUE)
					{
						$html_path .= '';
						if(!$return) echo $html_path; else $html .= $html_path;
					}
					*/
				}
			}
		}
		
		return $html;
	}
}

?>