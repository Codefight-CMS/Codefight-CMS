<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Setting_model extends MY_Model {

	function Setting_model()
    {
        // Call the Model constructor
        parent::MY_Model();
    }
	
	//get all installed templates
	function get_templates() {
		//SET DEFAULT TEMPLATE VALUE
		$template = 'default';
		//If template is selected by user, then use that
		if($this->session->userdata('template'[CFWEBSITEID])) {
			$template = $this->session->userdata('template'[CFWEBSITEID]);
		}
		else {
			//If the user has not selected template,
			//Get default template from admin setting
			$query = $this->db->get_where('setting', array('setting_key'=>'default_template'));
			$row = $query->result_array();
			
			if(isset($row[0]) && isset($row[0]['setting_value']) && !empty($row[0]['setting_value']))
				$template = $row[0]['setting_value'];
		}
		
		$this->session->set_userdata('template'[CFWEBSITEID], $template);
		
		$ret = array();
		$dir = APPPATH . 'views/templates/';
		$dir = str_replace('admin/', 'frontend/',$dir);
		if ($handle = opendir($dir))
		{
			while (false !== ($file = readdir($handle)))
			{
				if ($file != "." && $file != ".." && $file != 'core' && is_dir($dir.$file))
				{
					$ret[$file] = $file;
				}
			}
			closedir($handle);
		}
		return $ret;
	}
}
?>