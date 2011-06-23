<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cf_websites_model extends MY_Model {

	function get_websites()
	{
		$query = $this->db->get('websites');
		
		return $query->result_array();
	}

	
	//Get websites name(s)
	function websites_name($ids='')
	{
		$name = '';
		
		$ids = trim(trim($ids), ',');
		if(empty($ids)) return '-';
		
		$this->db->where_in('websites_id', explode(',', $ids));
		
		$websites = $this->get_websites();
		
		foreach($websites as $v)
		{
			$name .= $v['websites_name'] . ' / ';
		}
		
		return trim(trim($name), '/');
	}

	
	//check to see if website is disabled or not
	function is_enabled($id = 0)
	{
		$this->db->where('websites_id', $id);
		$this->db->where('websites_status', '1');
		
		return $this->db->count_all_results('websites');
	}

	
	function save($data)
	{
		if(!is_array($data))
		{
			return;
		}
		
		if(isset($data['websites_id']))
		{
			$action = false;
			
			$this->db->where('websites_id', $data['websites_id']);
			$this->db->update('websites', $data);
			
			if($this->db->affected_rows())
				$action = 'update_success';
			else
				$action = 'update_failed';
			
		} else {
			if(isset($data['websites_id'])) unset($data['websites_id']);
			
			$this->db->insert('websites', $data);
			
			if($this->db->affected_rows())
				$action = 'insert_success';
			else
				$action = 'insert_failed';
			
		}
		
		switch($action)
		{
			case 'insert_failed':
				$msg = "<p>Could not add website specified.</p>";
				$type = 'error';
				break;
			case 'insert_success':
				$msg = "<p>Successfully added new website.</p>";
				$type = 'success';
				break;
			case 'update_failed':
				$msg = "<p>Update failed.</p>";
				$type = 'error';
				break;
			case 'update_success':
				$msg = "<p>Update successful.</p>";
				$type = 'success';
				break;
			default:
				break;
		}
		
		set_global_messages($msg, $type);
		
		return;
	}
	
	function delete($id)
	{
		if(empty($id))
		{
			$msg = array('error' => "<p>Error! ID is required.</p>");
			set_global_messages($msg, 'error');
		
			return;
		}
		
		if(is_array($id)) return $this->delete_ids($id);

		$this->db->where('websites_id', $id);
		$this->db->delete('websites');
		
		$msg = array('success' => "<p>Deleted Successfully.</p>");
		set_global_messages($msg, 'success');
		
		return;
	}
	
	function delete_ids($id)
	{
		$error = 0;
		$success = 0;
		
		$ids = (array)$id;
		
		foreach($ids as $id)
		{
			$this->db->where('websites_id', $id);
			$this->db->delete('websites');
			
			if($this->db->affected_rows())
				$success++;
			else
				$error++;
		}
		
		if($error)
		{
			$msg = array('error' => "<p>{$error} websites could not be deleted.</p>");
			set_global_messages($msg, 'error');
		}
		
		if($success)
		{
			$msg = array('success' => "<p>{$success} Websites Deleted Successfully.</p>");
			set_global_messages($msg, 'success');
		}
		
		return;
	}
	
}
?>