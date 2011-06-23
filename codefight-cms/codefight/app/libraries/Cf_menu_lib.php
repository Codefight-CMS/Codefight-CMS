<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
	>menu_id | menu_active | menu_parent_id | menu_link
	>menu_title | menu_type | menu_meta_title | menu_meta_keywords
	>menu_meta_description | menu_sort
	
	Parameters that can be passed in an array:
	$parameters = array (
					'ul_param' => 'class="xyz"...',
					'li_param' => '...',
					'a_param' => '...',
					)

	multi level menu created for codefight cms by damodar bashyal
	visit codefight.org
*/
class Cf_menu_lib {
	
	var $CI;
	var $menu;
	var $counter;
	var $holder;
	var $menu_type;
	var $ul_param;
	var $li_param;
	var $a_param;
	var $rtn=FALSE;
	var $menu_list;
	var $echo_list;
	var $last_id;
	var $is_last;
	var $reduce_space;
	
	function _reset()
	{
		$this->CI =& get_instance();
		$this->menu = array();
		$this->counter = 0;
		$this->holder = array();
		$this->menu_type = 'page';
		$this->is_last = FALSE;
		$this->reduce_space = TRUE;
	}
	
	function get($parameters=array('menu_type' => 'page'), $rtn=FALSE)
	{
		
		$this->_reset();
	
		if(!is_array($parameters)) $parameters = array($parameters);
		
		foreach($parameters as $k=>$v)
		{
			$this->$k = $v;
		}
		
		//Do you want to get menu as array item
		$this->rtn = $rtn;
		
		$this->echo_list = '';//reset to empty. b'coz found some issue.
		
		$this->CI->db->where('menu_type', $this->menu_type);
		
		//if it is to be return for admin menu, don't check if it is active
		if(!$rtn)
		{
			$this->CI->db->where('menu_active', 1);
			
			if(defined('CFWEBSITEID'))
			{
				$this->CI->db->like('websites_id', ','.CFWEBSITEID.',');
			}
		}
		
		$this->CI->db->order_by('menu_sort', 'asc');
		$query = $this->CI->db->get('menu');
		
		$rows = $query->result_array();
		
		return $this->_prepare($rows);
	}
	
	function _prepare($data=array()) {
		//if $data is no array, return false
		if(!is_array($data) || empty($data)) return false;
		
		$menu_array = array();
		$this->last_id = 0;
		
		//Group Menu By Parent ID.
		//Top Level Menu has always parent ID = 0
		foreach($data as $v) {
			$this->menu[$v['menu_parent_id']][$v['menu_id']] = array(
																	'title'=>$v['menu_title'],
																	'url' => $v['menu_link'],
																	'id' => $v['menu_id'],
																	'websites_id' => $v['websites_id']);
		
			$this->last_id = $v['menu_id'];
		}
		
		$this->menu[0][0]['id'] = 0;//last item::needed until fix found
		
		//array_pop($this->menu[0]);
		//$this->last_id = $this->last_id['']
		//print_r($this->last_id);

		return $this->_list();
	}
	
	function _list($child=array(), $space=0) {
		//if $menu is no array or empty, return false
		if(!is_array($this->menu) || empty($this->menu)) return FALSE;
		
		$this->reduce_space = false;
		
		//Top Level Menu has always parent ID = 0
		if((isset($this->menu[0]) && is_array($this->menu[0])) || (is_array($child) && !empty($child))) {
			//increment counter
			$this->counter++;
			
			//set current menu data array to holder
			$this->holder[$this->counter] = (is_array($child) && !empty($child))? $child : $this->menu[0];
			
			//get|set params
			$ul_param = $li_param = $a_param = ' class=""';
			if(!empty($this->li_param)) $li_param = ' ' . $this->li_param;
			if(!empty($this->a_param)) $a_param = ' ' . $this->a_param;
			if($this->counter===1 && !empty($this->ul_param))
			{
				if(preg_match('/class=".*"/',$this->ul_param)) 
					$this->ul_param = preg_replace('/class="(.*)"/','class="$1 cfm_level'.$this->counter.'"', $this->ul_param);
				$ul_param = ' ' . $this->ul_param;
			}
			else {
				$ul_param = ' class="cfm_level'.$this->counter.'"';
			}
			
			$this->echo_list .= "\n".str_repeat(' ',$space)."<ul$ul_param>";
			//parent menu list
			foreach($this->holder[$this->counter] as $v) 
			{
				if($v['id']==0) $this->is_last = TRUE;//Check to see if it is last one
				
				if($v['id']>0) 
				{
					//menu lists
					if($v['id'] == $this->last_id)
					{
						//add class last
						$li_param = str_replace('class="', 'class="last ', $li_param);
					}
					
					$this->echo_list .= "\n".str_repeat(' ',($space+3))."<li{$li_param}>";
					$this->echo_list .= "\n".str_repeat(' ',($space+6));
					
					if(preg_match('@(http(s)?:\/\/|javascript::void\(0\);)@',$v['url']))
					{
						$this->echo_list .= '<a' . $a_param . ' href="' . $v['url'] . '">' . $v['title'] . '</a>';
					}
					else
					{
						if($this->menu_type != 'page')
							$this->echo_list .= anchor($this->menu_type . '/c/' . $v['url'], $v['title'], $a_param);
						else
							$this->echo_list .= anchor($v['url'], $v['title'], $a_param);
	
						
					}
					
					if($this->rtn) {
						//START:: return menu item as array
						$this->menu_list[$v['id']] = array(
																		'id' => $v['id'],
																		'title' => str_repeat('-', $space) . $v['title'],
																		'url' => $v['url'],
																		'websites_id' => $v['websites_id']
																		);
						//END::
					}
					
					if(isset($this->menu[$v['id']])) {
						$this->_list($this->menu[$v['id']], $space+6);
						$this->reduce_space = false;
					} else {
						$this->reduce_space = true;
					}
					
					$this->echo_list .= "\n".str_repeat(' ',($space+3))."</li>";
				}
			}
			
			if($this->counter > 1) $this->counter--;//taking level counter back to previous one.
			
			$this->echo_list .= "\n".str_repeat(' ', $space)."</ul>";
			
			//just to make it look nice
			if($this->reduce_space)
				if($space >= 3) $space = $space-3;
		
			if($this->is_last) { //if all menu listed return or echo
				if($this->rtn) {//if return=true for array | used for admin menu manager
					return $this->menu_list;
				} else {
					return $this->echo_list;
				}
			}
		}
	}
}
?>