<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Groups_permission_model extends MY_Model
{
    public function get_group()
    {
        $this->db->order_by('group_title', 'asc'); // group_id
        $query = $this->db->get('group');

        return $query->result_array();
    }

    public function update_permissions($group_id = 0, $permissions=array())
    {
		$this->db->where('group_id', $group_id)->or_where('group_id', '0')->delete('group_permission');

		$sql = array();
		foreach((array)$permissions as $v)
		{
            if($v == 'none')
            {
                return 0;
                 break;
            }

            if($v == 'all')
            {
                 $v = 0;
            }

			$sql[] = array(
						'group_id' => $group_id ,
						'module_id' => $v
					);
		}
		$this->db->insert_batch('group_permission', $sql);

		return $this->db->affected_rows();
	}

    public function get_group_permission($group_id = 0)
    {
		$data = array();
        $this->db->where('group_id', $group_id);
        $query = $this->db->get('group_permission');

        $gp = $query->result_array();
		foreach($gp as $k => $v)
		{
			$data[$v['module_id']] = $v['group_id'];
		}

		return $data;
    }
}
