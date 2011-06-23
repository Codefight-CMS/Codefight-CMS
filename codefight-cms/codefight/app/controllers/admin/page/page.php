<?php
/**
 * Codefight CMS
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to info@codefight.org so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Codefight CMS to newer
 * versions in the future.
 *
 * @category    Codefight CMS
 * @package     cf_page
 * @copyright   Copyright (c) 2010 Codefight CMS Team (http://codefight.org)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Admin Page Controller
 */
class Page extends MY_Controller {

	function __construct()
	{
		parent::MY_Controller();
		
		$this->load->helper(array('form', 'text'));
		$this->load->model(array('blog/cf_blog_model', 'cf_menu_model', 'admin/cf_websites_model'));
	}
	
	function index()
	{
		if(isset($_POST['create']))
		{
			$this->_create();
		}
		else if(isset($_POST['delete']))
		{
			$this->_delete();
		}
		else if(isset($_POST['edit']))
		{
			$this->_edit();
		}
		else
		{
			$data = '';
			
			$assets = array();
			
			//load all required css
			//if media type not defined, screen is default.
			//$assets['css'] = array('admin','swiff','box','upload');
			$assets['css'] = array(
								'all' => array('admin','page','box','tablesorter')
							);
			//load all required js
			$assets['js'] = array('jquery','jquery.metadata','jquery.tablesorter','jquery.tablesorter.pager');
			
			$this->cf_asset_lib->load($assets);
			
			//load all required include files
			//$data['head_includes'] = array('sortable.php'); //include file's location is relative to header location
			
			/*
			 * START: Pagination config and initialization
			 */
			$this->load->library('pagination');
			$config['base_url'] = base_url() . "admin/page/".$this->uri->segment(3, 'page')."/";
			$config['total_rows'] = $this->cf_blog_model->get_blog_count($this->uri->segment(3, 'page'), 'admin');
			$config['per_page'] = '20';
			$config['uri_segment'] = 4;
			$config['num_links'] = 5;
			
			$this->pagination->initialize($config);
			//END: Pagination
			
			//Get page content for the selected menu item.
			$data['pagination'] = $this->pagination->create_links();

			//load page menu
			$data['page'] = $this->cf_blog_model->get_page($config['per_page'], $this->uri->segment(4, 0),$this->uri->segment(3, 'page'));
			
			//---
			$html_string = $this->load->view('admin/'.$this->uri->segment(3, 'page').'/page_view', $data, true);//Get view data in place of sending to browser.
			
			$this->cf_process_lib->view($html_string);
		}
	}

	function _create()
	{
		$data = '';
		
		$this->load->library('form_validation');
		
		$val = array(
				array('field' => 'page_active','label' => 'Status','rules' => 'trim|required'),
				array('field' => 'page_title','label' => 'Title','rules' => 'trim|required'),
				//array('field' => 'page_blurb','label' => 'Blurb','rules' => 'trim'),
				//array('field' => 'menu_id','label' => 'Menu','rules' => 'trim|required'),
				//array('field' => 'page_blurb_length','label' => 'Blurb length','rules' => 'trim'),
				array('field' => 'page_body','label' => 'Body','rules' => 'trim'),
				array('field' => 'page_author','label' => 'Author','rules' => 'trim'),
				array('field' => 'page_tag','label' => 'Tags','rules' => 'trim'),
				array('field' => 'page_date','label' => 'Date','rules' => 'trim'),
				array('field' => 'show_date','label' => 'Show Date','rules' => 'trim'),
				array('field' => 'show_author','label' => 'Show Author','rules' => 'trim'),
				array('field' => 'allow_comment','label' => 'Allow Comment','rules' => 'trim'),
				array('field' => 'page_meta_title','label' => 'Meta title','rules' => 'trim'),
				array('field' => 'page_meta_keywords','label' => 'Meta Keywords','rules' => 'trim'),
				array('field' => 'page_meta_description','label' => 'Meta description','rules' => 'trim'),
				array('field' => 'page_sort','label' => 'Sort','rules' => 'trim'),
			);

		$this->form_validation->set_rules($val);

		if ($this->form_validation->run() == FALSE)
		{
			if(!validation_errors() == '' && $this->input->post('create') == 'Create')
			{
				$msg = array('error' => validation_errors());
				set_global_messages($msg, 'error');
			}
			
		}
		else
		{
			if(empty($_POST['menu_id'])) $_POST['menu_id'] = array(0);
			if(empty($_POST['websites_id'])) $_POST['websites_id'] = array(0);
			
			$page_active = set_value('page_active');
			$page_title = set_value('page_title');
			//$page_blurb_length = set_value('page_blurb_length');
			$page_body = $_POST['page_body'];
			$page_blurb = '';
			$menu_id = ','.implode(',',$_POST['menu_id']).',';
			$websites_id = ','.implode(',',$_POST['websites_id']).',';
			$page_author = set_value('page_author');
			$page_tag = set_value('page_tag');
			$page_date = date('Y-m-d H:i:s', strtotime(set_value('page_date')));
			$show_date = set_value('show_date');
			$show_author = set_value('show_author');
			$allow_comment = set_value('allow_comment');
			$page_meta_title = set_value('page_meta_title');
			$page_meta_keywords = set_value('page_meta_keywords');
			$page_meta_description = set_value('page_meta_description');
			$page_sort = set_value('page_sort');

			

			$page_break = explode('<!-- pagebreak -->',$page_body);

			if(isset($page_break[0]))
			{
				$page_blurb = trim($page_break[0]);

				if((substr($page_blurb, -1, 3)) == '<p>')
				{
					$page_blurb = substr($page_blurb, 0, -3);
				}
			}

			

			$group_id = $this->input->post('group_id');
			
			$this->db->insert('page', array(
						'page_active' => $page_active, 
						'page_title' => $page_title, 
						'page_blurb' => $page_blurb, 
						//'page_blurb_length' => $page_blurb_length, 
						'page_body' => $page_body, 
						'menu_id' => $menu_id, 
						'websites_id' => $websites_id, 
						'page_author' => $page_author, 
						'page_tag' => $page_tag, 
						'page_type' => $this->uri->segment(3, 'page'), 
						'page_date' => $page_date, 
						'show_date' => $show_date, 
						'show_author' => $show_author, 
						'allow_comment' => $allow_comment, 
						'page_meta_title' => $page_meta_title, 
						'page_meta_keywords' => $page_meta_keywords, 
						'page_meta_description' => $page_meta_description, 
						'page_sort' => $page_sort));
			$page_id = $this->db->insert_id();
			
			if($page_id)
			{
				//update page access
				$this->db->insert('page_access', array('page_id' => $page_id, 'group_id' => implode('_',$group_id)));
				
				if(isset($page_tag))
				{
					$page_tag = explode(',',$page_tag);
					
					if(is_array($page_tag) && count($page_tag) > 0) foreach($page_tag as $v)
					{
						//clean tag
						$tag = url_title($v);
						
						//add|increment tag count
						$this->cf_data_model->tag_cloud_add($tag, $this->uri->segment(3, 'page'), $v, $websites_id);
						
						//insert tag to tag table
						$this->db->insert('page_tag', array('page_id' => $page_id, 'tag' => $tag));
					}
				}
					
				$msg = array('success' => "<p>New Page <strong> $page_title </strong> Successfully Added</p>");
				set_global_messages($msg, 'success');
				
			}
			else
			{
				$msg = array('error' => "<p>SYSTEM ERROR! Could't add page. Please try again later.</p>");
				set_global_messages($msg, 'error');
			}
		}
	
		$assets = array();
		
		//load all required css
		//if media type not defined, screen is default.
		//$assets['css'] = array('admin','swiff','box','upload');
		$assets['css'] = array(
							'all' => array('admin','page','box')
						);
		//load all required js
		$assets['js'] = array('tiny_mce/tiny_mce');
		
		$this->cf_asset_lib->load($assets);
							
		//---
		$html_string = $this->load->view('admin/'.$this->uri->segment(3, 'page').'/page_create_view', $data, true);//Get view data in place of sending to browser.
		
		$this->cf_process_lib->view($html_string);
	}

	function _delete()
	{
		$data = '';
		
		if(isset($_POST['select']))
		{
			$id_array = $_POST['select'];
		}
		else
		{
			$id_array = array();
			$msg = array('error' => "<p>You must select atleast one page to delete.</p>");
			set_global_messages($msg, 'error');
		}
		
		!is_array($id_array) ? $id_array = array() : '';
		
		$msg = false;
		foreach($id_array as $id)
		{
			$id = preg_replace('/[^0-9]+/','',$id);
			
			$this->db->where('page_id', $id);
			$query = $this->db->get('page');
			$page_data = $query->result_array();

			if($this->db->delete('page', array('page_id' => $id)))
			{
				if($page_data[0]['websites_id'])
				{
					$websites_id = explode(',', trim($page_data[0]['websites_id'], ','));
					$this->cf_data_model->tag_cloud_delete($id, 'page', $websites_id);
				}
				$msg = array('success' => "<p>Selected page(s) deleted successfully.</p>");
				$type = 'success';
			}
			else
			{
				$msg = array('error' => "<p>Error! couldn't delete.</p>");
				$type = 'error';
			}

		}
		if($msg) set_global_messages($msg, $type);
		
		unset($_POST);
		
		$this->index();

	}

	function _edit()
	{

		$data = '';
		$id_array = array();
		
		if(!isset($_POST['page']))
		{
			if(isset($_POST['select']))
			{
				$id_array = $_POST['select'];
			}
			else
			{
				$msg = array('error' => "<p>You must select atleast one page to edit</p>");
				set_global_messages($msg, 'error');

				unset($_POST);
				$this->index();
				exit();
		
			}
		}
		
		!is_array($id_array) ? $id_array = array() : '';

		//START: for the first page load, get data from database
		foreach($id_array as $id)
		{
			$id = preg_replace('/[^0-9]+/','',$id);

			$this->db->where('page_id',$id);
			$query = $this->db->get('page');

			foreach ($query->result() as $row)
			{
				$_POST['page'][$row->page_id]['id'] = $row->page_id;
				$_POST['page'][$row->page_id]['page_active'] = $row->page_active;
				$_POST['page'][$row->page_id]['page_title'] = $row->page_title;
				//$_POST['page'][$row->page_id]['page_blurb'] = $row->page_blurb;
				//$_POST['page'][$row->page_id]['page_blurb_length'] = $row->page_blurb_length;
				$_POST['page'][$row->page_id]['page_body'] = $row->page_body;
				$_POST['page'][$row->page_id]['menu_id'] = $row->menu_id;
				$_POST['page'][$row->page_id]['websites_id'] = $row->websites_id;
				$_POST['page'][$row->page_id]['page_author'] = $row->page_author;
				$_POST['page'][$row->page_id]['page_tag'] = $row->page_tag;
				$_POST['page'][$row->page_id]['page_date'] = $row->page_date;
				$_POST['page'][$row->page_id]['show_date'] = $row->show_date;
				$_POST['page'][$row->page_id]['show_author'] = $row->show_author;
				$_POST['page'][$row->page_id]['allow_comment'] = $row->allow_comment;
				$_POST['page'][$row->page_id]['page_meta_title'] = $row->page_meta_title;
				$_POST['page'][$row->page_id]['page_meta_keywords'] = $row->page_meta_keywords;
				$_POST['page'][$row->page_id]['page_meta_description'] = $row->page_meta_description;
				$_POST['page'][$row->page_id]['page_sort'] = $row->page_sort;
				$_POST['page'][$row->page_id]['group_id'] = array('1','2','3');
			}
			
			$this->db->where('page_id',$id);
			$query = $this->db->get('page_access');
			
			//$test = $query->result_array();
			
			foreach ($query->result() as $row)
			{
				$_POST['page'][$row->page_id]['group_id'] = explode('_', $row->group_id);
			}
			
			//To make it multiple selected, we need more than two elements in array.
			if(count($_POST['page'][$row->page_id]['group_id']) == 1) $_POST['page'][$row->page_id]['group_id'][] = '0';
		}
		//END: for the first page load, get data from database

		//START: clean data and update in database
		if($this->input->post('edit') == 'Update' && isset($_POST['page']) && is_array($_POST['page']))
		{
			foreach($_POST['page'] as $v)
			{
			
				if(empty($v['menu_id'])) $v['menu_id'][0] = 0;
				if(empty($v['websites_id'])) $v['websites_id'][0] = 0;
				//print_r($v);

				//cleaning
				$id = xss_clean($v['id']);
				$page_active = xss_clean($v['page_active']);
				$page_title = $v['page_title'];
				$page_blurb = '';
				//$page_blurb_length = xss_clean($v['page_blurb_length']);
				$page_body = $v['page_body'];
				$page_author = $v['page_author'];
				$page_tag = $v['page_tag'];
				$page_date =  date('Y-m-d H:i:s', strtotime($v['page_date']));
				$show_date = isset($v['show_date'])? $v['show_date']: '0';
				$show_author = isset($v['show_author'])? $v['show_author']: '0';
				$allow_comment = isset($v['allow_comment'])? $v['allow_comment']: '0';
				$page_body = $v['page_body'];
				//$menu_id = $v['menu_id'];
				$page_meta_title = xss_clean($v['page_meta_title']);
				$page_meta_keywords = xss_clean($v['page_meta_keywords']);
				$page_meta_description = xss_clean($v['page_meta_description']);
				$page_sort = xss_clean($v['page_sort']);

			

			$page_break = explode('<!-- pagebreak -->',$page_body);

			if(isset($page_break[0]))
			{
				$page_blurb = trim($page_break[0]);

				if((substr($page_blurb, -1, 3)) == '<p>')
				{
					$page_blurb = substr($page_blurb, 0, -3);
				}
			}

			

				//clean up menu ids
				$menu_id = array();
				foreach($v['menu_id'] as $w)
				{
					$w = xss_clean($w);
					$menu_id[$w] = $w;
				}
				
				$websites_id = array();
				foreach($v['websites_id'] as $w)
				{
					$w = xss_clean($w);
					$websites_id[$w] = $w;
				}
				
				//clean up group id, selected from multi select
				$group_id = array();
				foreach($v['group_id'] as $w)
				{
					$group_id[] = xss_clean($w);
				}

				//clean the data to autofill in form
				$_POST['page'][$id]['id'] = $id;
				$_POST['page'][$id]['page_active'] = $page_active;
				$_POST['page'][$id]['page_title'] = $page_title;
				//$_POST['page'][$id]['page_blurb'] = $page_blurb;
				//$_POST['page'][$id]['page_blurb_length'] = $page_blurb_length;
				$_POST['page'][$id]['page_body'] = $page_body;
				$_POST['page'][$id]['page_author'] = $page_author;
				$_POST['page'][$id]['page_tag'] = $page_tag;
				$_POST['page'][$id]['page_date'] = $page_date;
				$_POST['page'][$id]['show_date'] = $show_date;
				$_POST['page'][$id]['show_author'] = $show_author;
				$_POST['page'][$id]['allow_comment'] = $allow_comment;
				$_POST['page'][$id]['menu_id'] = $menu_id;
				$_POST['page'][$id]['websites_id'] = $websites_id;
				$_POST['page'][$id]['page_meta_title'] = $page_meta_title;
				$_POST['page'][$id]['page_meta_keywords'] = $page_meta_keywords;
				$_POST['page'][$id]['page_meta_description'] = $page_meta_description;
				$_POST['page'][$id]['page_sort'] = $page_sort;
				$_POST['page'][$id]['group_id'] = $group_id;
				
				//update database if set
				if(!empty($page_title) && !empty($page_body) && !empty($id))
				{
					//delete previous tag
					//$this->db->delete('page_tag', array('page_id' => $id));
					//delete|decrement previous tag count
					$this->db->where('page_id', $id);
					$query = $this->db->get('page');
					$page_data = $query->result_array();
					if($page_data[0]['websites_id'])
					{
						$websites_ids = explode(',', trim($page_data[0]['websites_id'], ','));
						$this->cf_data_model->tag_cloud_delete($id, $this->uri->segment(3, 'page'), $websites_ids);
					}
					//$this->cf_data_model->tag_cloud_delete($id, $this->uri->segment(3, 'page'), $websites_id);
					
					//update page
					$this->db->where('page_id', $id);
					$this->db->update('page', array(
								'page_active' => $page_active, 
								'page_title' => $page_title, 
								'page_blurb' => $page_blurb, 
								//'page_blurb_length' => $page_blurb_length, 
								'page_body' => $page_body, 
								'page_author' => $page_author, 
								'page_tag' => $page_tag, 
								'page_date' => $page_date, 
								'show_date' => $show_date, 
								'show_author' => $show_author, 
								'allow_comment' => $allow_comment, 
								'menu_id' => ','.implode(',',$menu_id).',', 
								'websites_id' => ','.implode(',',$websites_id).',', 
								'page_meta_title' => $page_meta_title, 
								'page_meta_keywords' => $page_meta_keywords, 
								'page_meta_description' => $page_meta_description, 
								'page_sort' => $page_sort));
					//update page access
					$this->db->where('page_id', $id);
					$this->db->delete('page_access');

					$this->db->insert('page_access', array('page_id' => $id, 'group_id' => implode('_',$group_id)));
					
					//update page tags
					if(isset($page_tag))
					{
						$page_tag = explode(',',$page_tag);
						if(is_array($page_tag) && count($page_tag) > 0) foreach($page_tag as $v)
						{
							//clean tag
							$tag = url_title($v);
							
							//add|increment tag count
							$this->cf_data_model->tag_cloud_add($tag, $this->uri->segment(3, 'page'), $v, $websites_id);
							
							//insert tag to tag table
							$this->db->insert('page_tag', array('page_id' => $id, 'tag' => $tag));
						}
					}
	
				}
				
				$msg = array('success' => "<p>Updated successfully.</p>");
				set_global_messages($msg, 'success');

			}
		}
		//END: validate data and update in database
		
		$assets = array();
		
		//load all required css
		//if media type not defined, screen is default.
		//$assets['css'] = array('admin','swiff','box','upload');
		$assets['css'] = array(
							'all' => array('admin','page','box')
						);
		//load all required js
		$assets['js'] = array('tiny_mce/tiny_mce');
		
		$this->cf_asset_lib->load($assets);
		//$data['page'] = $this->cf_blog_model->get_page();
		
		//---
		$html_string = $this->load->view('admin/'.$this->uri->segment(3, 'page').'/page_edit_view', $data, true);//Get view data in place of sending to browser.
		
		$this->cf_process_lib->view($html_string);
	}
}