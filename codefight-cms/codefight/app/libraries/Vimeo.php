<?php
/**
 * CodeIgniter Vimeo API Library (http://www.haughin.com/code/vimeo)
 * 
 * Author: Elliot Haughin (http://www.haughin.com), elliot@haughin.com
 *
 * ========================================================
 * REQUIRES: curl
 * ========================================================
 * 
 * VERSION: 1.0 (2009-03-04)
 * LICENSE: GNU GENERAL PUBLIC LICENSE - Version 2, June 1991
 * 
 **/
	class Vimeo {
		
		var $_api_url = 'http://vimeo.com/api/';
		var $_api_format = '.php';
		
		var $_ch;
		var $_user = 'default';
		
		function Vimeo()
		{
			
		}
		
		function _format_response($response)
		{
			return unserialize($response);
		}
		
		function _request($url)
		{
			$this->_ch = curl_init();
			
			curl_setopt($this->_ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($this->_ch, CURLOPT_URL, $url);
			
			$result = curl_exec($this->_ch);
			
			curl_close($this->_ch);
			
			return $this->_format_response($result);
		}
		
		function _build_url($method_type, $options)
		{
			$url = $this->_api_url;
			
			switch ($method_type) {
				case 'user':
					$url .= $options['id'].'/'.$options['method'];
				break;
				
				case 'clip':
					$url .= $options['id'];
				break;
				
				default:
					$url .= $method_type.'/'.$options['id'].'/'.$options['method'];
				break;
			}
			
			$url .= $this->_api_format;
			
			return $url;
		}
		
		function call($method_type, $options = array())
		{
			if ( !isset($options['id']) )
			{
				die('No id was defined in vimeo call options');
			}
			
			$url = $this->_build_url($method_type, $options);
			
			return $this->_request($url);
		}
	}