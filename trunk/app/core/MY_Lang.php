<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Language Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Language
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/language.html
 */
class MY_Lang extends CI_Lang {

    var $lang_file = array('default'=>'default');

	/**
	 * Constructor
	 *
	 * @access	public
	 */
	public function __construct()
	{
		parent::__construct();
	}

    public function getFile(){
        return $this->lang_file;
	}

    public function setFile($file=''){
        $files = (array)$file;

        foreach($files as $file){
            if(!empty($file)){
                $file = trim($file);
                $this->lang_file[$file] = $file;
                log_message('debug', "Lang file - {$file}");
            }
        }
        $this->lang_file = array_unique($this->lang_file);

        return $this;
    }

    /**
     * Language line
     *
     * Fetches a single line of text from the language array
     *
     * @param	string	$line		Language line key
     * @param	bool	$log_errors	Whether to log an error message if the line is not found
     * @return	string	Translation
     */
    public function line($line, $log_errors = TRUE)
    {
        $value = parent::line($line, $log_errors);

        // if no translation found, return same string
        if(empty($value)){
            $value = $line;
        }
        return $value;
    }
}