<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cf_menu_model extends MY_Model {

	var $menu_type;
	var $last_id = 0;
	
	function Cf_menu_model()
    {
        // Call the Model constructor
        parent::MY_Model();
    }
	
	function _menu_type($menu_type)
	{
		/*switch($menu_type) 
		{
			case 'blog':
				$this->menu_type = 'blog';
				break;
			default:
				$this->menu_type = 'page';
		}*/
		$this->menu_type = $menu_type;
	}
	
	
	function get_menu_array($menu_type = 'page') 
	{
		$this->_menu_type($menu_type);
		
		$this->db->order_by('menu_sort');
		$this->db->where('menu_parent_id', '0');
		$this->db->where('menu_type', $this->menu_type);
		$query = $this->db->get('menu');
		$result = $query->result_array();
		$count_1 = count($result);
		
		$menu = array();
		$sort_a = 1;
		
		foreach($result as $v) {
			$menu[$v['menu_id']] = $v;
			$menu[$v['menu_id']]['menu_title_display'] = '<span class="display_level1">' . $v['menu_title'] . '</span>';
			$menu[$v['menu_id']]['menu_title_pull'] = $v['menu_title'];
			$menu[$v['menu_id']]['sort'] = $sort_a;
			$menu[$v['menu_id']]['color'] = 'green';
			$menu[$v['menu_id']]['count'] = $count_1;
			
			//find its child if any
			$this->db->order_by('menu_sort');
			$this->db->where('menu_parent_id', $v['menu_id']);
			$query = $this->db->get('menu');
			$result2 = $query->result_array();
			$count_2 = count($result2);
			
			$sort_b = 1;
			foreach($result2 as $v2) {
				//$menu[$v['menu_id']]['level1'][$v2['menu_id']] = $v2;
				$menu[$v2['menu_id']] = $v2;
				$menu[$v2['menu_id']]['menu_title_display'] = '<span class="display_level2">|-- ' . $v2['menu_title'] . '</span>';
				$menu[$v2['menu_id']]['menu_title_pull'] = '--|--' . $v2['menu_title'];
				$menu[$v2['menu_id']]['sort'] = $sort_b;
				$menu[$v2['menu_id']]['color'] = 'gray';
				$menu[$v2['menu_id']]['count'] = $count_2;
				
				//find its child if any
				$this->db->order_by('menu_sort');
				$this->db->where('menu_parent_id', $v2['menu_id']);
				$query = $this->db->get('menu');
				$result3 = $query->result_array();
				$count_3 = count($result3);
				
				$sort_c = 1;
				foreach($result3 as $v3) {
					//$menu[$v['menu_id']]['level1'][$v2['menu_id']]['level2'][$v3['menu_id']] = $v3;
					$menu[$v3['menu_id']] = $v3;
					$menu[$v3['menu_id']]['menu_title_display'] = '<span class="display_level3">|-- ' . $v3['menu_title'] . '</span>';
					$menu[$v3['menu_id']]['menu_title_pull'] = 'N/A';//this level can;t have child, as of this release
					$menu[$v3['menu_id']]['sort'] = $sort_c;
					$menu[$v3['menu_id']]['color'] = 'red';
					$menu[$v3['menu_id']]['count'] = $count_3;
					
					$sort_c++;
				}
				
				$sort_b++;
			}
			
			$sort_a++;
		}
		
		return $menu;
	}

	//$menu_active,$menu_parent_id,$menu_title,$menu_link,$menu_sort,$menu_type
	function insert($_menu_data, $action = 'insert')
	{
		$_menu_data = (array)$_menu_data;
		
		if(empty($_menu_data)) return FALSE;
		
		if(!in_array($action, array('insert', 'update'))) return FALSE;
		
		
		if($action == 'update') $this->db->where('menu_id !=', $_menu_data['menu_id']);
		
		$this->db->where('menu_title', $_menu_data['menu_title']);
		$this->db->where('menu_parent_id', $_menu_data['menu_parent_id']);
		$this->db->where('menu_type', $_menu_data['menu_type']);
		$count = $this->db->count_all_results('menu');
		
		if($count >= 1)
		{
			$msg = array('error' => '<p>Menu <strong>'.$_menu_data['menu_title'].'</strong> already exists!</p>');
			set_global_messages($msg, 'error');
			
			return FALSE;
		}
		else
		{
			/*
			if($_menu_data['menu_type'] == 'blog')
			{
				$_menu_data['menu_link'] = 'blog/c/' . $_menu_data['menu_link'];
			}
			*/
			if($action == 'update') $this->db->where('menu_id !=', $_menu_data['menu_id']);
			
			$this->db->where('menu_link', $_menu_data['menu_link']);
			$this->db->where('menu_type', $_menu_data['menu_type']);
			$this->db->where('menu_parent_id', $_menu_data['menu_parent_id']);
			
			$count = $this->db->count_all_results('menu');
			if($count >= 1 && !preg_match('/javascript::void\(0\);/', $_menu_data['menu_link']))
			{
				$msg = array('error' => '<p>Menu Link <strong>'.$_menu_data['menu_link'].'</strong> already exists!</p>');
				set_global_messages($msg, 'error');
				
				return FALSE;
			}
			else
			{
					
				
				$msg = array('success' => '<p>New Menu <strong>' . $_menu_data['menu_title'] . '</strong> Successfully Added.</p>');
				if($action == 'update')
					$msg = array('success' => '<p>Menu <strong>' . $_menu_data['menu_title'] . '</strong> Updated Successfully.</p>');
				
				set_global_messages($msg, 'success');
				/*
				$sql = array(
						'menu_active' => $menu_active,
						'menu_parent_id' => $menu_parent_id,
						'menu_title' => $menu_title,
						'menu_link' => $menu_link,
						'menu_type' => $menu_type,
						'menu_sort' => $menu_sort
					);
				*/
				if($action == 'update') $this->db->where('menu_id', $_menu_data['menu_id']);
				
				$this->db->$action('menu', $_menu_data);
				
				return TRUE;
			}
		}
	}

	function update($_menu_data)
	{
		$this->insert($_menu_data, 'update');
	}
}
?>