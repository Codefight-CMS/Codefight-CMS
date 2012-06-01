<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Form_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function get_form_items($identifier = 0)
    {
        $this->db->select('*');
        $this->db->where('form_group.form_group_identifier', $identifier);
        $this->db->order_by('form_item_to_group.form_item_sort', 'asc');
        $this->db->join('form_group', 'form_group.form_group_id=form_item_to_group.form_group_id');
        $this->db->join('form_item', 'form_item.form_item_id=form_item_to_group.form_item_id');

        $query = $this->db->get('form_item_to_group');

        return $query->result_array();
    }

    function get_form_item()
    {
        $query = $this->db->get('form_item');
        return $query->result_array();
    }

    function insert_form_item($val = array())
    {
        $this->db->where('form_item_name', $val['form_item_name']);
        $count = $this->db->count_all_results('form_item');

        if ($count >= 1) {
            return false;
        } else {
            $this->db->insert('form_item', $val);
            return true;
        }
    }

    function get_form_group()
    {
        $query = $this->db->get('form_group');
        return $query->result_array();
    }

    function insert_form_group($val = array())
    {
        $this->db->where('form_group_identifier', $val['form_group_identifier']);
        $count = $this->db->count_all_results('form_group');

        if ($count >= 1) {
            return false;
        } else {
            $this->db->insert('form_group', $val);
            return true;
        }
    }
}
