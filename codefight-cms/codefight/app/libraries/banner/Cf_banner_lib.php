<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/*
 * Test file only. not used yet.
 */
class Cf_banner_lib extends Cf_library
{
	var $CI;
	
	function __construct()
	{
		log_message('debug', "Cf_banner_lib Class Initialized");
		$this->CI =& get_instance();
	}
	
	function process($string='')
	{
		echo 'process function of banner lib is called.';
		
		return $string;
	}
}