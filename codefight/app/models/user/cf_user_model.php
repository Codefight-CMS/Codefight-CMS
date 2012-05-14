<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cf_user_model extends MY_Model
{
	private $_groups;
	
	public function get_groups()
	{
		if(count($this->_groups)) return $this->_groups;
		
		$result = $this->db->get('group')->result_array();
		
		foreach($result as $v)
		{
			$this->_groups[$v['group_id']] = $v;
		}
		return $this->_groups;
	}
	
    public function get_user($per_page = 5, $page = 0)
    {
        $this->db->order_by('user_id');
        if ($per_page) $this->db->limit($per_page, $page);
        $query = $this->db->get('user');

        $result = $query->result_array();

        !is_array($result) ? $result = array() : '';

        //get group title
	$groups = $this->get_groups();
	
        foreach ($result as $k => $v) {
            if (isset($groups[$v['group_id']]['group_title'])) {
                $result[$k]['group_title'] = $groups[$v['group_id']]['group_title'];
            }
            else
            {
                $result[$k]['group_title'] = 'NOT FOUND';
            }
        }

        return $result;
    }

    public function get_user_by_id($id='')
    {
        $this->db->where('user_id', $id);
        return $this->get_user(false);
    }

    public function user_exists($email='')
    {
        $this->db->where('email', $email);
        return $this->get_user(false);
    }

    public function get_authors()
    {
        $this->db->where('is_author', '1');
        return $this->get_active_user();
    }

    public function get_active_user()
    {
        $this->db->where('active', '1');
        return $this->get_user(false);
    }

    public function get_user_count()
    {
        return $this->db->count_all_results('user');
    }

    public function insert($active, $email, $password, $firstname, $lastname, $group_id)
    {
        $this->db->where('email', $email);
        $count = $this->db->count_all_results('user');

        if ($count >= 1) {
            return false;
        } else {
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