<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Module_model extends MY_Model
{

    function get($group_id=FALSE)
    {
        if($group_id)
        {
            return $this->_get_group_menu($group_id);
        }
		$data = array();
		$query = $this->db->order_by('sort')->where('parent', 'top')->get('module');
		$modules_db = $query->result_array();
		foreach($modules_db as $k => $v)
		{
			$data[$v['url']] = unserialize($v['menu']);
		}

		return $data;
    }

    function default_landing($group_id=FALSE)
    {
        $page = $this->db
                ->select('module.url,module.child')
                ->from('module')
                ->join('group_permission', 'group_permission.module_id = module.module_id')
                ->where('group_permission.group_id', $group_id)
                ->where('module.parent', 'top')
                ->limit(1)
                ->get()
                ->result_array()
            ;

        if(isset($page[0]['child']) && !empty($page[0]['child']))
        {
            $child = unserialize($page[0]['child']);

            $pages = $this->db
                    ->select('module.url,module.child')
                    ->from('module')
                    ->join('group_permission', 'group_permission.module_id = module.module_id')
                    ->where('group_permission.group_id', $group_id)
                    ->where_in('module.url', $child)
                    ->limit(1)
                    ->get()
                    ->result_array()
                ;

            if(isset($pages[0]['url']) && !empty($pages[0]['url']))
            {
                return $pages[0]['url'];
            }
        }

        return (isset($page[0]['url']) ? $page[0]['url'] : FALSE);
    }

    function can_access($group_id=FALSE, $page=FALSE)
    {
        // first check if user is allowed to access all
        $count = $this->db
                    ->from('group_permission')
                    ->where('group_id', $group_id)
                    ->where('module_id', '0')
                    ->count_all_results();
        if($count){
            return TRUE;
        }

        // if not allowed to access everything
        // check if allowed to access requested page
        return $this->db
                    ->from('module')
                    ->join('group_permission', 'group_permission.module_id = module.module_id')
                    ->where('group_permission.group_id', $group_id)
                    ->where('module.url', $page)
                    ->count_all_results()
            ;
    }

    function _get_group_menu($group_id=FALSE)
    {
        $data = array();
        $query = $this->db
                ->select('module.*')
                ->from('module')
                ->join('group_permission', 'group_permission.module_id = module.module_id')
                ->where('group_permission.group_id', $group_id)
                ->where('module.parent', 'top')
                ->get()
        ;

        $modules_db = $query->result_array();
        foreach($modules_db as $k => $v)
        {
            $data[$v['url']] = unserialize($v['menu']);

            if(isset($data[$v['url']]['child']))
            {
                foreach($data[$v['url']]['child'] as $k2 => $v2)
                {
                    $count = $this->db
                            ->from('module')
                            ->join('group_permission', 'group_permission.module_id = module.module_id')
                            ->where('group_permission.group_id', $group_id)
                            ->where('module.parent', $v['url'])
                            ->where('module.url', $k2)
                            ->count_all_results()
                    ;

                    if(!$count)
                    {
                        unset($data[$v['url']]['child'][$k2]);
                        continue;
                    }

                    if(isset($data[$v['url']]['child'][$k2]['child']))
                    {
                        foreach($data[$v['url']]['child'][$k2]['child'] as $k3 => $v3)
                        {
                            $count = $this->db
                                    ->from('module')
                                    ->join('group_permission', 'group_permission.module_id = module.module_id')
                                    ->where('group_permission.group_id', $group_id)
                                    ->where('module.parent', $k2)
                                    ->where('module.url', $k3)
                                    ->count_all_results()
                            ;

                            if(!$count)
                            {
                                unset($data[$v['url']]['child'][$k2]['child'][$k3]);
                                continue;
                            }

                        }
                    }

                }
            }
        }

        return $data;
    }

    function get_ids()
    {
		$data = array();
		$query = $this->db->select('module_id,url')->get('module');
		$modules_db = $query->result_array();
		foreach($modules_db as $k => $v)
		{
			$data[$v['url']] = $v['module_id'];
		}

		return $data;
    }

    function get_raw()
    {
		// $data = array();
		$query = $this->db->order_by('parent')->get('module');
		// $modules_db =
		return $query->result_array();
		/*
		foreach($modules_db as $k => $v)
		{
			$data[$v['module_id']] = $v;
		}

		return $data;
		*/
    }
}
