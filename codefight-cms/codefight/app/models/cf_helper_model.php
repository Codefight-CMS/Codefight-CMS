<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cf_helper_model extends MY_Model
{
	//---
	function get_menu_link($id = 0, $page_type = 'page')
	{
		$id = trim($id, ',');
		$id = explode(',', $id);
		
		if(!count($id)) return FALSE;
		
		$id = $id[0];
		
		if($page_type != 'page') return $id;
		
		$this->db->where('menu_id', $id);
		$query = $this->db->get('menu');
		
		$result = $query->result_array();
		
		if(isset($result[0]['menu_link'])) return $result[0]['menu_link'];
		
		return FALSE;
	}
}