<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cf_comment_model extends MY_Model
{

    function get_comment($per_page = 5, $page = 0, $status = '0')
    {
        $this->db->order_by('page_comment_id', 'desc');
        $this->db->limit($per_page, $page);
        $this->db->where('page_comment_status', $status);
        $query = $this->db->get('page_comment');

        return $query->result_array();
    }

    function get_comment_count($status = '0')
    {
        $this->db->where('page_comment_status', $status);
        return $this->db->count_all_results('page_comment');
    }
}

?>