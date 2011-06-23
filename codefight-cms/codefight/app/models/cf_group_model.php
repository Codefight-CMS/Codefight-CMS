<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cf_group_model extends MY_Model{

	function get_group($per_page=5, $page=0)
	{
		$this->db->order_by('group_sort', 'asc');
		if($per_page) $this->db->limit($per_page, $page);
		$query = $this->db->get('group');
		
		return $query->result_array();
	}

	function get_group_count()
	{
		return $this->db->count_all_results('group');
	}
	
	function insert($title, $description)
	{
		$this->db->where('group_title', $title);
		$count = $this->db->count_all_results('group');
		
		if($count >= 1) {
			return false;
		}else{
			$this->db->insert('group', array('group_title' => $title, 'group_description' => $description));
			return true;
		}
	}
	
	/* wasted time on validating array fields
	function edit() {
		$group_id = $this->input->post('group_id');
		
		!is_array($group_id) ? $group_id = array() : '';
		
		foreach($group_id as $k => $v) {
			$rules["group_title_$k"]       = "trim|required|xss_clean";
			$rules["group_description_$k"] = "trim|required|xss_clean";

			$fields["group_title_$k"]       = "Title of ID " . $k;
			$fields["group_description_$k"] = "Description of ID " . $k;
	
		}
		
		$this->validation->set_rules($rules);
		$this->validation->set_fields($fields);
		
		if ($this->validation->run() == FALSE)
		{
			return FALSE;
		}
		else
		{
			foreach($group_title as $k => $v) {
				$group_title = $this->validation->group_title_$k;
				$group_description = $this->validation->group_description_$k;
				
				echo $group_title;
				echo $group_description;
			}
			
			return TRUE;
		}
	}
	*/

}
?>