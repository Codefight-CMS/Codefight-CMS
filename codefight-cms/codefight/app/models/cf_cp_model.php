<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cf_cp_model extends MY_Model{

	function get_top_page($limit = 10)
	{
		$this->db->order_by('page_view', 'desc');
		$this->db->limit($limit);
		//$this->db->where('page_type', $page_type);
		$query = $this->db->get('page');
		
		return $query->result_array();
	}
}
?>