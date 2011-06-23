<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cf_user_model extends MY_Model{

	function get_user($per_page=5, $page=0)
	{
		$this->db->order_by('user_id');
		if($per_page) $this->db->limit($per_page, $page);
		$query = $this->db->get('user');
		
		$result = $query->result_array();
		
		!is_array($result) ? $result = array() : '';
		
		//get group title
		foreach($result as $k => $v) {
			$qry = $this->db->get_where('group', array('group_id' => $v['group_id']));
			$rslt = $qry->result_array();
			if(isset($rslt[0]['group_title'])) {
				$result[$k]['group_title'] = $rslt[0]['group_title'];
			}
			else
			{
				$result[$k]['group_title'] = 'NOT FOUND';
			}
		}
		
		return $result;
	}

	function get_active_user()
	{
		$this->db->where('active', '1');
		return $this->get_user(false);
	}

	function get_user_count()
	{
		return $this->db->count_all_results('user');
	}
	
	function insert($active,$email,$password,$firstname,$lastname,$group_id) {
		$this->db->where('email', $email);
		$count = $this->db->count_all_results('user');
		
		if($count >= 1) {
			return false;
		}else{
			$sql = array('active' => $active,
					'email' => $email,
					'password' => $password,
					'firstname' => $firstname,
					'lastname' => $lastname,
					'group_id' => $group_id);
			$this->db->insert('user', $sql);
			return true;
		}
	}
	
	/*
	function edit() {
		$user_id = $this->input->post('user_id');
		
		!is_array($user_id) ? $user_id = array() : '';
		
		foreach($user_id as $k => $v) {
			$rules["user_title_$k"]       = "trim|required|xss_clean";
			$rules["user_description_$k"] = "trim|required|xss_clean";

			$fields["user_title_$k"]       = "Title of ID " . $k;
			$fields["user_description_$k"] = "Description of ID " . $k;
	
		}
		
		$this->validation->set_rules($rules);
		$this->validation->set_fields($fields);
		
		if ($this->validation->run() == FALSE)
		{
			return FALSE;
		}
		else
		{
			foreach($user_title as $k => $v) {
				$user_title = $this->validation->user_title_$k;
				$user_description = $this->validation->user_description_$k;
				
				echo $user_title;
				echo $user_description;
			}
			
			return TRUE;
		}
	}
	*/

}
?>