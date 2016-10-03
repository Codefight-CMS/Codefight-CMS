<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/*
 * Test file only. not used yet.
 */
class Banner_Library extends MY_Library
{
	var $CI;

    public function __construct()
    {
        parent::__construct();
		log_message('debug', "banner/Banner_Library Class Initialized");
		$this->CI =& get_instance();
	}

	function process($string='')
	{
		echo 'process function of banner lib is called.';

		return $string;
	}
}
