<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cf_blog_model extends MY_Model
{

	//var $CI = '';

	function Cf_blog_model()
    {
        // Call the Model constructor
        parent::MY_Model();
		//$this->CI =& get_instance();
    }
	
	//DEFAULT META SET
	function defaults($q = 'meta') {
		switch($q) {
			default:
				$default['meta'] = $this->get_setting_meta();
		}

		return $default[$q];
	}
	
	function get_setting_meta() {
		$this->db->where('websites_id', CFWEBSITEID);
		$query = $this->db->get('setting');
		$row = $query->result_array();
		
		$data['title'] = $data['keywords'] = $data['description'] = '';
		
		foreach($row as $v) {
			if($v['setting_key']=='meta_title') $data['title'] = $v['setting_value'];
			if($v['setting_key']=='meta_keyword') $data['keywords'] = $v['setting_value'];
			if($v['setting_key']=='meta_description') $data['description'] = $v['setting_value'];
		}
		return $data;
	}

	//IF META DESCRIBED THROUGH CMS, FETCH IT
	function meta_fetch($data)
	{
		//Get default metas
		$default = $this->defaults();
		
		if(isset($data['page_meta_title']) && !empty($data['page_meta_title']))
		{
			$meta['title'] = $data['page_meta_title'];
		}
		else
		{
			$meta['title'] = $default['title'];
		}
		
		if(isset($data['page_meta_keywords']) && !empty($data['page_meta_keywords']))
		{
			$meta['keywords'] = $data['page_meta_keywords'];
		}
		else
		{
			$meta['keywords'] = $default['keywords'];
		}
		
		if(isset($data['page_meta_description']) && !empty($data['page_meta_description']))
		{
			$meta['description'] = $data['page_meta_description'];
		}
		else
		{
			$meta['description'] = $default['description'];
		}
		
		return $meta;
	}

	function get_posts ($limit = 10, $menu_id='46')
	{
		$this->db->join('page_access', 'page.page_id = page_access.page_id');
		$this->db->like('page.menu_id', ",$menu_id,");
		
		if(defined('CFWEBSITEID'))
		{
			$this->db->like('page.websites_id', ','.CFWEBSITEID.',');
		}

		$this->db->order_by('page.page_id', 'desc');
		$this->db->where('page.page_active', 1);
		$this->db->limit($limit);
		return $this->db->get('page');
	}

	function get_blog_contents($menu_id = '0', $per_page = '5', $current_page = '0')
	{
		$this->db->join('page_access', 'page.page_id = page_access.page_id');
		
		//If menu item is set, then grab content related to that menu only. Otherwise get all that is type blog.
		if($menu_id) {
			$this->db->like('page.menu_id', ",$menu_id,");
		} else {
			$this->db->where('page_type', 'blog');
		}
		
		if(defined('CFWEBSITEID'))
		{
			$this->db->like('page.websites_id', ','.CFWEBSITEID.',');
		}
		
		//$this->db->order_by('page.page_sort', 'asc');
		$this->db->order_by('page.page_id', 'DESC');

		$this->db->where(array('page.page_active' => '1'));
		$this->db->limit($per_page, $current_page);
		$query = $this->db->get('page');
		$data1 = $query->result_array();
		//echo $this->db->last_query();
		
		$data = '';
		if(is_array($data1) && count($data1) > 0) {
			
			$data['meta'] = $this->meta_fetch($data1[0]);
			$data['content'] = $data1;
			
		}
		else
		{
			$data['meta'] = $this->defaults();
			$data['content'] = array();
		}
		
		return $data;
	}

	function get_page_full($page_id = '0')
	{
		
		$this->db->join('page_access', 'page.page_id = page_access.page_id');
		$this->db->order_by('page.page_sort', 'asc');
		$this->db->order_by('page.page_id', 'desc');
		
		if(defined('CFWEBSITEID'))
		{
			$this->db->like('page.websites_id', ','.CFWEBSITEID.',');
		}
		
		$query = $this->db->get_where('page', array('page.page_id' => $page_id, 'page.page_active' => '1'));
		$data1 = $query->result_array();

		$data = '';
		if(is_array($data1) && count($data1) > 0) {
		
			//Get meta data
			$data['meta'] = $this->meta_fetch($data1[0]);
			
			//Page content
			$data['content'] = $data1;
			
			//increase page views by 1
			$this->db->set('page_view', 'page_view+1', FALSE);
			$this->db->where('page_id', $page_id);
			$this->db->update('page');

		}
		else
		{
			$data['meta'] = $this->defaults();
			$data['content'] = array();
		}
		
		return $data;
	}

	function get_tag_contents($tag = 'nepal', $per_page, $current_page)
	{
		$this->db->join('page_access', 'page.page_id = page_access.page_id');
		$this->db->join('page_tag', 'page.page_id = page_tag.page_id');
		$this->db->order_by('page.page_sort', 'asc');
		$this->db->order_by('page.page_id', 'desc');
		$this->db->limit($per_page, $current_page);
		
		if(defined('CFWEBSITEID'))
		{
			$this->db->like('page.websites_id', ','.CFWEBSITEID.',');
		}
		
		$query = $this->db->get_where('page', array('page_tag.tag' => $tag, 'page.page_active' => '1'));
		$data1 = $query->result_array();

		$data = '';
		if(is_array($data1) && count($data1) > 0) {
		
			$data['meta'] = $this->meta_fetch($data1[0]);
			$data['content'] = $data1;

		}
		else
		{
			$data['meta'] = $this->defaults();
			$data['content'] = array();
		}
		
		return $data;
	}

	function get_tag_count($tag = 'nepal', $page_type = 'blog')
	{
		$this->db->join('page_tag', 'page.page_id = page_tag.page_id');
		
		if(defined('CFWEBSITEID'))
		{
			$this->db->like('page.websites_id', ','.CFWEBSITEID.',');
		}
		
		$this->db->where(array('page_tag.tag' => $tag, 'page.page_active' => '1', 'page.page_type' => $page_type)); 	
		return $this->db->count_all_results('page');
	}

	/*
	 * Get Most Popular Entries
	 */
	function getMostPopular ($limit = 10)
	{
		if(defined('CFWEBSITEID'))
		{
			$this->db->like('websites_id', ','.CFWEBSITEID.',');
		}
		$this->db->order_by('page_view', 'desc');
		$this->db->where('page_active', 1);
		$this->db->limit($limit);
		return $this->db->get('page');
	}

	function getRecentPosts ($limit = 10)
	{
		if(defined('CFWEBSITEID'))
		{
			$this->db->like('websites_id', ','.CFWEBSITEID.',');
		}
		$this->db->order_by('page_id', 'desc');
		$this->db->where('page_active', 1);
		$this->db->limit($limit);
		return $this->db->get('page');
	}

	function getApprovedComment ($limit = 20)
	{
		$this->db->order_by('page_comment.page_comment_id', 'desc');
		$this->db->where('page_comment.page_comment_status', 1);
		$this->db->limit($limit);
		$this->db->from('page');
		$this->db->join('page_comment', 'page_comment.page_id = page.page_id');
	
		if(defined('CFWEBSITEID'))
		{
			$this->db->like('page.websites_id', ','.CFWEBSITEID.',');
		}
	
		
		return $this->db->get();
	}

	function getPendingComment ($limit = 20)
	{
		$this->db->order_by('page_comment.page_comment_id', 'desc');
		$this->db->where('page_comment.page_comment_status', '0');
		$this->db->limit($limit);
		$this->db->from('page');
		$this->db->join('page_comment', 'page_comment.page_id = page.page_id');
		
		if(defined('CFWEBSITEID'))
		{
			$this->db->like('page.websites_id', ','.CFWEBSITEID.',');
		}
		
		
		return $this->db->get();
	}

	function get_comment ($page_id = 0)
	{
		$page_id = preg_replace('/[^0-9]+/', '', $page_id);
		
		$query = $this->db->get_where('page_comment', array('page_id' => $page_id, 'page_comment_status' => '1'));
		$q = $query->result_array();
		
		$c = '';
		if(is_array($q) && count($q) > 0) foreach($q as $v) {
			$c .= "\n" . '<div class="comment"><a name="cmnt'. $v['page_comment_id'] .'"></a>';
			$c .= "\n" . '<p class="comment"><img class="gravatar" src="http://www.gravatar.com/avatar/'.md5( strtolower( trim( $v['email'] ) ) ).'?s=40&d=mm" />' . nl2br($v['comment']) . '</p>';
			$c .= "\n" . '<p class="commenter"><a href="'.current_url().'#cmnt'. $v['page_comment_id'] .'"><span> ' . date("d/m/y h:i:s", strtotime($v['time'])) . '</span></a><span>|</span>';
			$c .= "\n" . '<a rel="external nofollow" href="' . prep_url($v['url']) . '#" target="_blank">' . $v['name'] . '</a></p>';
			$c .= "\n" . '</div>';
		}
		echo $c;
	}
	
	function parse_content($content = array(), $show_blurb=TRUE) {
		
		$_content = array();
		
		if(isset($content) && is_array($content) && count($content) > 0) foreach ($content as $k => $v) {
			//check access
			$access = $this->cf_data_model->is_granted($v['group_id']);

			//Get Author + Date Block
			$author_date = $this->cf_data_model->author_date($v['page_author'],$v['page_date'],$v['show_author'],$v['show_date']);
			//Get Tags Block
			$page_tag = $this->cf_data_model->page_tag($v['page_tag']);
			//Get Tags Block
			$content_content = $this->cf_bbcode_lib->output($this->cf_data_model->page_content($v, $show_blurb));
			//$page_content = $this->phpcolor->color_code($content_content);
			$page_content = $content_content;
			
			//Get the Year | Month | Day the post was posted
			$_content[$k]['year'] = $this->cf_data_model->post_year($v['show_date'], $v['page_date']);
			$_content[$k]['month'] = $this->cf_data_model->post_month($v['show_date'],$v['page_date']);
			$_content[$k]['day'] = $this->cf_data_model->post_day($v['show_date'],$v['page_date']);
			
			//check to see if there is a form
			if(preg_match_all('#{{form (.+)}}#isU',$page_content,$identifier)) {
				$form = $this->cf_form_lib->create($identifier, current_url());
				if(isset($_POST['identifier'])) {
					$page_content .= '<script type="text/javascript">
					jQuery(document).ready(function(){check_form();});
					
					function check_form() {
						jQuery.post(
								\'form/ajax\',
								{
									';
					foreach($_POST as $pk => $pv) {
						if(!is_array($_POST[$pk]))
							$page_content .= "{$pk}:document.getElementById(\"{$pk}\").value, \n";
						else {
							//print_r($_POST);
							foreach($_POST[$pk] as $chk_k => $chk_v) {
								$page_content .= "'".$pk.'['.$chk_k.']'."'".':document.getElementById("'.$pk.'['.$chk_k.']").value, '. "\n";
							}
						}
					}
			$page_content .= ' },
								function(data){
									jQuery(\'#message_'.$_POST['identifier'].'\').html(data);
								}
							);
					}
					</script>';
				}
				
				//replace identifiers with form.
				foreach($form as $f) {
					$page_content = preg_replace('#'.$f['block'].'#isU', $f['form'], $page_content);
				}
			}
			
			//check to see if there is a form
			if(preg_match_all('#{{banner (.+)}}#isU',$page_content,$identifier)) {
				$page_content = $this->cf_banner_model->parse($page_content, $identifier);
			}
			
			$_content[$k]['categories'] = $this->cf_data_model->post_category($v['menu_id'], true);
			
			//$v['menu_id'] = explode(',',$v['menu_id']);
			//$v['menu_id'] = array_filter($v['menu_id']);
			//$v['menu_id'] = array_shift($v['menu_id']);
			
			$link = get_page_url($v);//$this->cf_data_model->link_create(array(0 => 'page', 1 => $v['menu_id'], 3 => $v['page_id'], 4 => $this->cf_data_model->link_clean($v['page_title'])));
			
			//If the user has right to view this content...
			if($access) {
				//Show heading of the content, ...
				$_content[$k]['title'] = anchor($link,$v['page_title']);
				$_content[$k]['author_date'] = $author_date;
				$_content[$k]['content'] = $page_content;
				$_content[$k]['tag'] = $page_tag;
				
				if($this->uri->segment(3, 0) == $v['page_id']) {
					
					//add share button
					$_content[$k]['addthis'] = '<br /><!-- AddThis Button BEGIN --><script type="text/javascript">var addthis_pub="dbashyal";</script><a href="http://www.addthis.com/bookmark.php?v=20" onmouseover="return addthis_open(this, \'\', \'[URL]\', \'[TITLE]\')" onmouseout="addthis_close()" onclick="return addthis_sendto()"><img src="http://s7.addthis.com/static/btn/lg-share-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"/></a><script type="text/javascript" src="http://s7.addthis.com/js/200/addthis_widget.js"></script><!-- AddThis Button END -->';
$_content[$k]['sharethis'] = '
<div class="post_share social-media"><div class="large-buttons"><div class="wdt_button">
<iframe id="tweet_frame_483679" name="tweet_frame_483679" allowtransparency="true" frameborder="0" role="presentation" scrolling="no" src="http://platform.twitter.com/widgets/tweet_button.html?url=' . urlencode(site_url($link)) . '&amp;via=@codefight&amp;text=' . urlencode($v['page_title']) . '&amp;count=vertical" width="55" height="63"></iframe>
</div><div class="wdt_button wdt_fb"><fb:share-button href="' . site_url($link) . '" type="box_count"></fb:share-button></div><div class="wdt_button">
<script src="http://www.stumbleupon.com/hostedbadge.php?s=5&ampr=' . urlencode(site_url($link)) . '&amp;title=' . urlencode($v['page_title']) . '"></script></div></div><div class="small-buttons" style="display:none"><div class="wdt_button_min">
<iframe id="tweet_frame_483679" name="tweet_frame_483679" allowtransparency="true" frameborder="0" role="presentation" scrolling="no" src="http://platform.twitter.com/widgets/tweet_button.html?url=' . urlencode(site_url($link)) . '&amp;via=@codefight&amp;text=' . urlencode($v['page_title']) . '&amp;count=horizontal" width="110" height="20"></iframe>
</div><div class="wdt_button_min"><fb:share-button href="' .  $link . '" type="button_count"></fb:share-button></div><div class="wdt_button_min">
<script src="http://www.stumbleupon.com/hostedbadge.php?s=1&r=' . urlencode(site_url($link)) . '&amp;title=' . urlencode($v['page_title']) . '"></script></div><div class="wdt_button_min">
<a class="chicklet" id="st_email_min" href="javascript:void(0);">email</a></div><div class="wdt_button_min"
><a class="chicklet" id="st_sharethis_min" href="javascript:void(0);">share</a>
<script type="text/javascript">
var shared_object = SHARETHIS.addEntry({title: "' . ($v['page_title']) . '",url: "' . site_url($link) . '"}, {button:false,onmouseover:false});
shared_object.attachButton(document.getElementById(\'st_sharethis_min\'));
shared_object.attachChicklet(\'email\', document.getElementById(\'st_email_min\'));
</script> 
</div></div><div class="wdt_button"><a class="chicklet" id="st_email" href="javascript:void(0);">email</a></div><div class="wdt_button">
<a class="chicklet" id="st_sharethis" href="javascript:void(0);">share</a>
<script type="text/javascript">
var shared_object = SHARETHIS.addEntry({title: "' . ($v['page_title']) . '",url: "' . site_url($link) . '"}, {button:false,onmouseover:false});
shared_object.attachButton(document.getElementById(\'st_sharethis\'));shared_object.attachChicklet(\'email\', document.getElementById(\'st_email\'));
</script></div></div>';

					if(isset($v['allow_comment']) && ($v['allow_comment']))
					{
							$data['page_id'] = $v['page_id']; 
							$data['link'] = $link;
							//include($template_path . '/blocks/comment.php');
							$this->lang->load('comment');
							$_content[$k]['comment'] = $this->cf_block_lib->load('comment', false, '.php', true);
					}
				}
			} else {
				//Show heading of the content, ...
				$_content[$k]['title'] = $v['page_title'];
				$_content[$k]['author_date'] .= $author_date;
				
				//... but Display message to login
				$_content[$k]['content'] .= '<p class="error">You do not have access right to view this part of content, Please login.</p>';
				$_content[$k]['tag'] .= $page_tag;
			}
			
			//Count total comment
			$_content[$k]['comment_count'] = $this->cf_data_model->post_comment_count($v['page_id']);
			
		} //END: Foreach
		
		return $_content;
	}

	function get_page($per_page=5, $page=0, $page_type='page')
	{
		$this->db->order_by('page_sort', 'asc');
		$this->db->order_by('page_id', 'DESC');
		$this->db->limit($per_page, $page);
		$this->db->where('page_type', $page_type);
		$query = $this->db->get('page');
		//echo $this->db->last_query();
		
		return $query->result_array();
	}

	function get_group()
	{
		$this->db->order_by('group_sort');
		$query = $this->db->get('group');
		
		return $query->result_array();
	}

	function insert($title, $description)
	{
		$this->db->where('page_title', $title);
		$count = $this->db->count_all_results('page');
		
		if($count >= 1) {
			return false;
		}else{
			$this->db->insert('page', array('page_title' => $title, 'page_description' => $description));
			return true;
		}
	}

	function get_blog_count($param = '0', $section = 'frontend')
	{
		if($section == 'frontend')
		{
			if(defined('CFWEBSITEID'))
			{
				$this->db->like('websites_id', ','.CFWEBSITEID.',');
			}
			$this->db->where(array('page_active' => '1', 'page_type' => 'blog'));
			if($param > 0) $this->db->like('menu_id', ",$param,");
		}
		else
		{
			$this->db->where('page_type', $param);
		}
		return $this->db->count_all_results('page');
	}
	
}