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
 * @package     cf_group
 * @copyright   Copyright (c) 2010 Codefight CMS Team (http://codefight.org)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Admin Group Controller
 */
class Group extends MY_Controller {

	function __construct()
	{
		parent::MY_Controller();
		
		$this->load->helper(array('form','text'));
		$this->load->model('cf_group_model', 'groupmodel');
	}
	

    /**
     * User Group
     * Create group
     */
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
								'all' => array('admin','group','box')
							);
			//load all required js
			$assets['js'] = array('jquery','interface');
			
			$this->cf_asset_lib->load($assets);
			
			$data['head_includes'] = array('sortable.php');
			
			/*
			 * START: Pagination config and initialization
			 */
			$this->load->library('pagination');
			
			$config['base_url'] = trim(site_url(), '/') . "/group/index/";
			$config['total_rows'] = $this->groupmodel->get_group_count();
			$config['per_page'] = '5';
			$config['uri_segment'] = 3;
			$config['num_links'] = 2;
			
			$this->pagination->initialize($config);
			//END: Pagination
			
			$data['pagination'] = $this->pagination->create_links();
			$data['group'] = $this->groupmodel->get_group($config['per_page'], $this->uri->segment(3, 0));
							
			//---
			$html_string = $this->load->view('admin/group/group_view', $data, true);//Get view data in place of sending to browser.
			
			$this->cf_process_lib->view($html_string);
		}
	}

	function _create()
	{
		$data = '';

		$this->load->library('form_validation');
		
		$val = array(
				   array(
						 'field'   => 'title',
						 'label'   => 'Title',
						 'rules'   => 'trim|required|xss_clean'
					  ),
				   array(
						 'field'   => 'description',
						 'label'   => 'Description',
						 'rules'   => 'trim|required|xss_clean'
					  )
				);
	
		$this->form_validation->set_rules($val);
		
		if($this->form_validation->run() == FALSE)
		{
		
			if(!validation_errors() == '' && $this->input->post('create') == 'Create')
			{
				$msg = array('error' => validation_errors());
				set_global_messages($msg, 'error');
			}
		}
		else
		{
			$title = set_value('title');
			$description = set_value('description');
			
			$insert = $this->groupmodel->insert($title, $description);
			
			if($insert)
			{
				$msg = array('success' => '<p>New Group <strong>' . $title . '</strong> Successfully Added.</p>');
				set_global_messages($msg, 'success');
			}
			else
			{
				$msg = array('error' => '<p>Group <strong>' . $title . '</strong> already exists!.</p>');
				set_global_messages($msg, 'error');
			}
		}
		
		$assets = array();
		
		//load all required css
		//if media type not defined, screen is default.
		//$assets['css'] = array('admin','swiff','box','upload');
		$assets['css'] = array(
							'all' => array('admin','group','box')
						);
		//load all required js
		$assets['js'] = array();
		
		$this->cf_asset_lib->load($assets);
								
		//---
		$html_string = $this->load->view('admin/group/group_create_view', $data, true);//Get view data in place of sending to browser.
		
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
			$msg = array('error' => '<p>You must select atleast one group to delete.</p>');
			set_global_messages($msg, 'error');
		}
		
		!is_array($id_array) ? $id_array = array() : '';
		
		$msg = false;
		foreach($id_array as $id)
		{
			$id = preg_replace('/[^0-9]+/','',$id);

			if($this->db->delete('group', array('group_id' => $id)))
			{

				if(!$msg)
				{
					$msg = array('success' => '<p>Selected group(s) deleted successfully.</p>');
					set_global_messages($msg, 'success');
				}
			}
			else
			{
				$msg = array('error' => '<p>Error! couldn\'t delete.</p>');
				set_global_messages($msg, 'error');
			
			}

		}
		
		unset($_POST);
		
		$this->index();

	}
	

	function _edit()
	{

		$data = '';
		$id_array = array();
		
		if(!isset($_POST['group']))
		{
			if(isset($_POST['select']))
			{
				$id_array = $_POST['select'];
			}
			else
			{
				$msg = array('error' => '<p>You must select atleast one group to edit.</p>');
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
			
			$this->db->where('group_id',$id);
			$query = $this->db->get('group');
			
			foreach ($query->result() as $row)
			{
				$_POST['group'][$row->group_id]['id'] = $row->group_id;
				$_POST['group'][$row->group_id]['title'] = $row->group_title;
				$_POST['group'][$row->group_id]['description'] = $row->group_description;
			}
		}
		//END: for the first page load, get data from database
			
		//START: clean data and update in database
		if($this->input->post('edit') == 'Update' && isset($_POST['group']) && is_array($_POST['group']))
		{
			$msg = false;
			foreach($_POST['group'] as $v)
			{
				//cleaning
				$id = xss_clean($v['id']);
				$title = xss_clean($v['title']);
				$description = xss_clean($v['description']);
				
				//clean the data to autofill in form
				$_POST['group'][$id]['id'] = $id;
				$_POST['group'][$id]['title'] = xss_clean($v['title']);
				$_POST['group'][$id]['description'] = xss_clean($v['description']);
				
				//update database if set
				if(!empty($title) && !empty($description) && !empty($id))
				{

					$this->db->where('group_id', $id);
					$this->db->update('group', array('group_title' => $title, 'group_description' => $description));

					if(!$msg)
					{
						$msg = array('success' => '<p>Updated successfully.</p>');
						set_global_messages($msg, 'success');
					}
				}
			}
		}
		//END: validate data and update in database
		
		$assets = array();
		
		//load all required css
		//if media type not defined, screen is default.
		//$assets['css'] = array('admin','swiff','box','upload');
		$assets['css'] = array(
							'all' => array('admin','group','box')
						);
		//load all required js
		$assets['js'] = array();
		
		$this->cf_asset_lib->load($assets);
		
		//---
		$html_string = $this->load->view('admin/group/group_edit_view', $data, true);//Get view data in place of sending to browser.
		
		$this->cf_process_lib->view($html_string);
	}
	
}