<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cf_data_model extends MY_Model {

	/*
	 * Get sort id for newly created entry
	 */
	function get_sort_id($table = 'page')
	{
		/*
		 * This was created to sort newly created entry to last
		 * If you want this just uncomment this and comment out //return 0;
		$this->db->order_by($table.'_sort', 'desc');
		$this->db->limit(1);
		$query = $this->db->get($table);
		$q = $query->result_array();
		
		if(isset($q[0][$table.'_sort'])) return $q[0][$table.'_sort'] + 1;
		else return 1;
		*/
		return 0;
	}

	function Cf_data_model()
    {
        // Call the Model constructor
        parent::MY_Model();
    }
	
	function get_tag_cloud($type=false)
	{
		if($type)
		$this->db->where('type', $type);
		$this->db->order_by('count', 'desc');
		$this->db->limit(20);
		if(defined('CFWEBSITEID'))
		{
			$this->db->where('websites_id', CFWEBSITEID);
		}
		$query = $this->db->get('tag_cloud');
		
		$tag = $query->result_array();
		foreach($tag as $k => $v) {
			$tag[$k]['class'] = "cloud$k";
		}
		return $tag;
	}
	
	/*
	* Create and return clean url segment
	*/
	function link_clean($word = false)
	{
		//remove invalid characters with spaces, trim it and replace spaces with dashes
		//return preg_replace('/\s+?/','-',trim(preg_replace('/[^a-z0-9]+/i',' ',strtolower($word))));
		return url_title($word);
	}
	
	/*
	 * Tag cloud add
	 */
	 //page_tag  -> page_id | tag
	 //tag_cloud  -> tag | title | count | type
	function tag_cloud_add ($tag = '', $type = 'blog', $title='', $websites_id)
	{
		if(!empty($tag))
		{
			if($websites_id) foreach((array)$websites_id as $w)
			{
				$this->db->where(array('tag' => $tag, 'type' => $type));
				$this->db->where('websites_id', $w);
				$count = $this->db->count_all_results('tag_cloud');
				
				//if tag found increment count by 1 else insert as new
				if($count)
				{
					$this->db->set('count', 'count+1', FALSE);
					$this->db->where(array('tag' => $tag, 'type' => $type));
					$this->db->where('websites_id', $w);
					$this->db->update('tag_cloud');
					//$this->db->update('', array('count' => 'count+1'), );
				}
				else
				{
					$sql = array('tag' => $tag, 'type' => $type, 'title' => $title, 'websites_id' => $w);
					$this->db->insert('tag_cloud', $sql);
				}
			}
		}
	}
	
	/*
	 * Tag cloud delete|remove
	 */
	 //page_tag  -> page_id | tag
	 //tag_cloud  -> tag | title | count | type
	function tag_cloud_delete ($id = 0, $type = 'page', $websites_id)
	{
		if($id)
		{
			if($websites_id) foreach($websites_id as $w)
			{
				$query = $this->db->get_where('page_tag', array('page_id' => $id));
				foreach($query->result() as $row)
				{
					$this->db->where(array('tag' => $row->tag, 'type' => $type, 'count >' => '0','websites_id' => $w));
					$count = $this->db->count_all_results('tag_cloud');
					
					//if tag found increment count by 1 else insert as new
					if($count)
					{
						$this->db->set('count', 'count-1', FALSE);
						$this->db->where(array('tag' => $row->tag, 'type' => $type));
						$this->db->where('websites_id', $w);
						$this->db->update('tag_cloud');
					}
				}
				$this->db->delete('page_tag', array('page_id' => $id));
				$this->db->delete('tag_cloud', array('count' => '0'));
			}
		}
	}
	
	/*
	 * Create Content Block
	 */
	function link_create($segments=array())
	{
		if(!is_array($segments)) $segments = array($segments);
		
		$link = '';
		foreach($segments as $k => $v) {
			$link .= "$v/";
		}
		return $link;
	}
	
	/*
	 * Check access granted for content
	 */
	function is_granted($id = 0)
	{
   		//Allowed to read content by group?
		$g = explode('_',$id);
		
		//first set access to false to anyone
		$access = FALSE;
		
		//group id 2 is reserved for public access. i.e. Login is not required. 
		//If group id 2 has right to access this content then no need to do cross checking.
		if(in_array('2', $g)) {
			$access = TRUE;
		}
		
		//if its not public content, check the user login detail and 
		//the group user belong if the user is on the allowed group list
		if(!$access && $this->session->userdata('logged_in') == '1') {
			$loggedData = $this->session->userdata('loggedData');
			$g_u = $loggedData['group_id'];
			
			if(in_array($g_u, $g)) {
				$access = TRUE;
			}
		}
		
		return $access;
	}
	
	/*
	 * Create Author and Posted Date Block
	 */
	function author_date($page_author,$page_date,$show_author,$show_date)
	{
		$author_date = '';
		if((!empty($page_author) && $show_author == '1') || $show_date == '1'){
			$author_date = '<div class="author_date">';
			
			if($show_date == '1') {
				$author_date .= '<span class="date">' . $page_date . '</span>';
			}
			
			if(!empty($page_author) && $show_author == '1') {
				$author_date .= '<span class="author">' . $page_author . '</span>';
			}
			
			$author_date .= '<p class="clear">&nbsp;</p></div>';
		}
		return $author_date;
	}
	
	//Return Day Only
	function post_day($show_date, $page_date, $format='d') {
		$day = '';
		if($show_date == '1') {
			$day = date($format,strtotime($page_date));
		}
		return $day;
	}
	
	//Return Month Only
	function post_month($show_date, $page_date, $format='M') {
		$month = '';
		if($show_date == '1') {
			$month = date($format,strtotime($page_date));
		}
		return $month;
	}
	
	//Return Year Only
	function post_year($show_date, $page_date, $format='Y') {
		$year = '';
		if($show_date == '1') {
			$year = date($format,strtotime($page_date));
		}
		return $year;
	}
	
	//Return Categories It Listed To
	function post_category($ids, $make_link = false) {
		$ids = explode(',',$ids);
		$ids = array_filter($ids);
		
		$ret = array();
		foreach($ids as $v) {
			if($make_link) {
				$title = $this->post_category_title($v);
				$ret[] = anchor("page/$v/".url_title($title),$title, ' rel="category tag" title="'.$v.'"');
			}
			else
				$ret[] = $this->post_category_title($v);
		}
		
		return implode(', ', $ret);
	}
	
	//Return Total comment counts
	function post_comment_count($id) {
		$this->db->where('page_id', $id);
		$this->db->where('page_comment_status', '1');
		
		return $this->db->count_all_results('page_comment');
	}
	
	//Return Menu|category title
	function post_category_title($id) {
		$query = $this->db->get_where('menu', array('menu_id' => $id));
		$result = $query->result_array();
		
		return (isset($result[0]['menu_title']))? $result[0]['menu_title'] : '';
	}
	
	/*
	 * Create Tags Block
	 */
	function page_tag($tag = '', $format = true)
	{
		$page_tag = '';
		$tag_array = array();
		if(!empty($tag)) {
			if($format)
				$page_tag = '<div class="tag"><span class="title">TAGS:</span>';
			
			$page_tag_array = explode(',', $tag);
			
			$c_t = 1;
			if(is_array($page_tag_array) && count($page_tag_array) > 0) foreach($page_tag_array as $v_t) {
				$tag_a_class = 'tag';
				if($c_t == count($page_tag_array)) $tag_a_class = 'tag tag_last';
				
				$tag_link = url_title($v_t);
				
				if($format)
					$page_tag .= anchor("blog/tag/$tag_link", trim($v_t), 'class="' . $tag_a_class . '"');
				else
					$tag_array[] = anchor("blog/tag/$tag_link", trim($v_t), 'class="' . $tag_a_class . '"');
				$c_t++;
			}
			
			if($format)
				$page_tag .= '<p class="clear">&nbsp;</p></div><p class="clear">&nbsp;</p>';
		}
		if($format)
			return $page_tag;
		else {
			$tag_array = array_filter($tag_array);
			return implode(', ', $tag_array);
		}
	}
	
	/*
	 * Create Content Block
	 */
	function page_content($v=array(), $show_blurb=TRUE)
	{
		if(!is_array($v)) return 0;
		
		$page_content = '';
		
		$v['menu_id'] = explode(',',$v['menu_id']);
		$v['menu_id'] = array_filter($v['menu_id']);
		$v['menu_id'] = array_shift($v['menu_id']);
		
		$link = $this->link_create(array(0 => $v['page_type'], 1 => $v['menu_id'], 3 => $v['page_id'], 4 => url_title($v['page_title'])));
		
		if(!empty($v['page_blurb']) && $this->uri->segment(3, 0) != $v['page_id'] && $show_blurb===TRUE)
		{
			//If Page Blurb is defined then don't show body text but the blurb text
			$page_content .= $v['page_blurb'] . '<p>' . anchor($link,'More&raquo;') . '</p>';
		}
		else
		{
			$page_content .= preg_replace('#\.\.\/assets\/common#','assets/default/common',$v['page_body']);
		}
		
		return $page_content;
	}
	
	/*
	 * Create Welcome | Login/Logout Line Block
	 */
	function welcome_get()
	{
		$ret = '';
		if($this->session->userdata('logged_in') === '1')
		{
			$loggedData = $this->session->userdata('loggedData');
			
			$ret = $loggedData['firstname'] . ' ' . $loggedData['lastname'] . " ( '" . $loggedData['group_title'] . "' ) | " . anchor('registration/logout', 'Logout');
		}
		else
		{
			$ret = anchor('registration/login', 'Login');
		}
		return $ret;
	}

} ?>