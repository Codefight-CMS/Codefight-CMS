<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cf_form_model extends MY_Model
{

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

?>