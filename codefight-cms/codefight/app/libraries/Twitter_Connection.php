<?php
/**
 * Twitter Connection Library
 * 
 * Author: Elliot Haughin (http://www.haughin.com), elliot@haughin.com
 * 
 * VERSION: 1.0 (2009-03-03)
 * LICENSE: GNU GENERAL PUBLIC LICENSE - Version 2, June 1991
 * 
 **/

	class Twitter_Connection {
		
		var $_obj;
		var $_conn;
		
		var $_handler = 'curl';
		
		function Twitter_Connection()
		{
			$this->_obj =& get_instance();
			
			$class_name = 'Twitter_Connection_'.$this->_handler;
			
			$this->_conn = new $class_name;
		}
		
		function post($url)
		{
			return $this->_conn->post($url);
		}
		
		function get($url)
		{
			return $this->_conn->get($url);
		}
		
		function data($data = array(), $encode_data = TRUE)
		{
			$this->_conn->data($data, $encode_data);
		}
		
		function basic_auth($username, $password)
		{
			$this->_conn->basic_auth($username, $password);
		}
	}
	
	class Twitter_Connection_curl {
		
		var $_ch;
		var $_data = array();
		
		var $_encode_data = TRUE;
		
		var $_username = NULL;
		var $_password = NULL;
		
		function Twitter_Connection_curl()
		{
			$this->_init();
		}
		
		function _init()
		{
			if ( $this->_ch !== NULL ) curl_close($this->_ch);
			
			$this->_ch = curl_init();
		}
		
		function post($url)
		{
			curl_setopt($this->_ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($this->_ch, CURLOPT_URL, $url);
			curl_setopt($this->_ch, CURLOPT_POST, TRUE);
			
			if ( !empty($this->_data) )
			{
				curl_setopt($this->_ch, CURLOPT_POSTFIELDS, $this->_data_array_to_string());
			}
			
			$result = curl_exec($this->_ch);
			
			$this->_init();
			
			var_dump($result);
			return $result;
		}
		
		function get($url)
		{
			$url = $this->_add_data_to_url($url);
			
			curl_setopt($this->_ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($this->_ch, CURLOPT_URL, $url);
			
			$result = curl_exec($this->_ch);
			
			$this->_init();
			
			return $result;
		}
		
		function data($data, $encode_data = TRUE)
		{
			$this->_encode_data = $encode_data;
			$this->_data = $data;
		}
		
		function basic_auth($username = NULL, $password = NULL)
		{
			$this->_username = $username;
			$this->_password = $password;
			
			curl_setopt($this->_ch, CURLOPT_USERPWD, "$username:$password");
		}
	
		function _data_array_to_string()
		{
			$data_string = '';
			
			if ( is_array($this->_data) && !empty($this->_data) )
			{
				foreach ( $this->_data as $key => $value )
				{
					if ( $this->_encode_data )
					{
						$data_string .= urlencode($key).'='.urlencode($value).'&';
					}
					else
					{
						$data_string .= urlencode($key).'='.$value.'&';
					}
				}
				
				$data_string = substr($data_string, 0, strlen($data_string) - 1);
			}
			
			return $data_string;
		}
	
		function _add_data_to_url($url)
		{
			if ( is_array($this->_data) && !empty($this->_data) )
			{
				if ( strpos($url, '?') !== FALSE )
				{
					die('theres a problem. your url already has GET data in it!');
				}
				else
				{
					$url .= '?'.$this->_data_array_to_string();
					return $url;
				}
			}
			else
			{
				return $url;
			}
		}
	}
	
	class Connection_socket {
		
		function Connection_socket()
		{
			
		}
	}