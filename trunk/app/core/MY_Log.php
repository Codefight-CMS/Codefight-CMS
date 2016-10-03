<?php defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Log extends CI_Log {
	public function __construct()
	{
		$config =& get_config();

        $writable_path = dirname(APPPATH) . DIRECTORY_SEPARATOR . 'writable' . DIRECTORY_SEPARATOR;
		$this->_log_path = ($config['log_path'] !== '') ? $config['log_path'] : $writable_path.'logs'.DIRECTORY_SEPARATOR;

        $config =& get_config(array('log_path' => $this->_log_path));

        parent::__construct();
	}
}
