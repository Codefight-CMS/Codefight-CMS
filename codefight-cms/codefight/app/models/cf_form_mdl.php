<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cf_form_mdl extends MY_Model {

	function Cf_form_mdl()
    {
        // Call the Model constructor
        parent::MY_Model();
    }
	
	function get_form_item($identifier = 0) {
		$this->db->select('*');
		$this->db->where('form_group.form_group_identifier', $identifier);
		$this->db->order_by('form_item_to_group.form_item_sort', 'asc');
		$this->db->join('form_group', 'form_group.form_group_id=form_item_to_group.form_group_id');
		$this->db->join('form_item', 'form_item.form_item_id=form_item_to_group.form_item_id');
		
		$query = $this->db->get('form_item_to_group');
		
		return $query->result_array();
	}
}
?>