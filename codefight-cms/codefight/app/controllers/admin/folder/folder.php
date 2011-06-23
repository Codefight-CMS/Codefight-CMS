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
 * @package     cf_file
 * @copyright   Copyright (c) 2010 Codefight CMS Team (http://codefight.org)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Admin User Controller
 */
class Folder extends MY_Controller
{
	var $isSearch;
	var $q;
	
	function __construct()
	{
		parent::MY_Controller();
		
		$this->load->helper(array('form','text'));
		$this->load->model('file/cf_file_model');
		
		$this->isSearch = FALSE;
		$this->q = FALSE;
	}

	function index()
	{
		redirect('admin/folder/manage-folder');
	}

	function manage_folder()
	{
		if(isset($_POST['create']))
		{
			//$this->create_folder();
			redirect('admin/folder/create-folder');
			return;
		}
		
		if(isset($_POST['edit']))
		{
			$this->edit_folder();
			return;
		}
		
		if(isset($_POST['delete']))
		{
			$this->delete_folder();
			return;
		}
		
		$data = '';
		$data['head_includes'] = array('sortable.php'); 
			
		$assets = array();
		
		//load all required css
		//if media type not defined, screen is default.
		//$assets['css'] = array('admin','swiff','box','upload');
		$assets['css'] = array(
							'all' => array('admin','file','box')
						);
		//load all required js
		$assets['js'] = array();
		
		$this->cf_asset_lib->load($assets);
		
		/*
		 * START: Pagination config and initialization
		 */
		$this->load->library('pagination');
		$config['base_url'] = trim(site_url(), '/') . "/admin/folder/manage-folder/";
		$config['total_rows'] = $this->cf_file_model->get_folder_count();
		$config['per_page'] = '500';
		$config['uri_segment'] = 4;
		$config['num_links'] = 3;
		
		$this->pagination->initialize($config);
		//END: Pagination
		
		$data['pagination'] = $this->pagination->create_links();
		$data['folder'] = $this->cf_file_model->get_folder($config['per_page'], $this->uri->segment($config['uri_segment'], 0));
		
		//---
		$html_string = $this->load->view('admin/folder/manage_folder_view', $data, true);//Get view data in place of sending to browser.
		
		$this->cf_process_lib->view($html_string);
	}

	function edit_folder()
	{
		$data = '';
		$success_count = 1;
		$id_array = array();
		
		//$_POST['file'] || see edit view file
		if(!isset($_POST['file']))
		{
			if(isset($_POST['select']))
			{
				$id_array = $_POST['select'];
			}
			else
			{
				$msg = array('error' => '<p>You must select atleast one folder to edit.</p>');
				set_global_messages($msg, 'error');

				unset($_POST);
				$this->index();
				exit();
			}
		}
		
		$this->load->library('form_validation');
		$this->load->model('cf_group_model');
		$this->load->model('cf_user_model');
		
		$data['folder'] = $this->cf_file_model->get_active_folder();
		$data['group'] = $this->cf_group_model->get_group(FALSE);
		$data['user'] = $this->cf_user_model->get_active_user();

		!is_array($id_array) ? $id_array = array() : '';

		//START: for the first page load, get data from database
		foreach($id_array as $id)
		{
		
			$id = preg_replace('/[^0-9]+/','',$id);
			
			$this->db->where('folder_id',$id);
			$query = $this->db->get('folder');
			
			foreach ($query->result() as $row)
			{
				$_POST['file'][$row->folder_id]['id'] = $row->folder_id;
				$_POST['file'][$row->folder_id]['parent'] = $row->folder_parent_id;
				$_POST['file'][$row->folder_id]['name'] = $row->folder_name;
				$_POST['file'][$row->folder_id]['active'] = $row->folder_status;
				$_POST['file'][$row->folder_id]['access'] = $row->folder_access;
				$_POST['file'][$row->folder_id]['group'] = explode(',', trim($row->folder_access_members, ','));
				$_POST['file'][$row->folder_id]['user'] = $_POST['file'][$row->folder_id]['group'];
			}
		}
		//END: for the first page load, get data from database
		
		//START: clean data and update in database
		if($this->input->post('edit') == 'Update' && isset($_POST['file']) && is_array($_POST['file']))
		{
			
			foreach($_POST['file'] as $k => $v)
			{
				//cleaning :|
				$id = xss_clean($v['id']);
				$active = xss_clean($v['active']);
				$parent = xss_clean($v['parent']);
				$name = xss_clean($v['name']);
				$access = xss_clean($v['access']);
				$group = '';
				if(isset($v['group'])) $group = xss_clean($v['group']);
				$user = '';
				if(isset($v['user'])) $user = xss_clean($v['user']);

				//clean the data to autofill in form
				$_POST['file'][$id]['id'] = $id;
				$_POST['file'][$id]['active'] = $active;
				$_POST['file'][$id]['name'] = $name;
				$_POST['file'][$id]['parent'] = $parent;
				$_POST['file'][$id]['access'] = $access;
				$_POST['file'][$id]['group'] = $group;
				$_POST['file'][$id]['user'] = $user;

				//update database if set
				if(!empty($access) && !empty($name) && !empty($id))
				{
					/*
					$_POST['file']['id'] = $id;
					$_POST['file']['active'] = $active;
					$_POST['file']['name'] = $name;
					$_POST['file']['parent'] = $parent;
					*/
					
					$val = array(
							array('field' => 'file['.$k.'][active]','label' => 'STATUS[id: '.$id.']','rules' => 'trim|required|xss_clean'),
							array('field' => 'file['.$k.'][name]','label' => 'FOLDER NAME[id: '.$id.']','rules' => 'trim|required|xss_clean'),
							array('field' => 'file['.$k.'][parent]','label' => 'PARENT FOLDER[id: '.$id.']','rules' => 'trim|required|xss_clean'),
							array('field' => 'file['.$k.'][access]','label' => 'ASSIGN TO','rules' => 'trim|required|xss_clean')
						);
					if(isset($_POST['file'][$k]['access']))
					{
						//---
						switch($_POST['file'][$k]['access'])
						{
							case 'group':
								$val[] = array('field' => 'file['.$k.'][group][]','label' => 'User Group','rules' => 'trim|required|xss_clean');
								$val[] = array('field' => 'file['.$k.'][user][]','label' => 'User','rules' => 'trim|xss_clean');
								break;
							case 'user':
								$val[] = array('field' => 'file['.$k.'][group][]','label' => 'User Group','rules' => 'trim|xss_clean');
								$val[] = array('field' => 'file['.$k.'][user][]','label' => 'User','rules' => 'trim|required|xss_clean');
								break;
							default:
								$val[] = array('field' => 'file['.$k.'][group][]','label' => 'User Group','rules' => 'trim|xss_clean');
								$val[] = array('field' => 'file['.$k.'][user][]','label' => 'User','rules' => 'trim|xss_clean');
						}
					}
					
					
					$this->form_validation->set_rules($val);
					
					if ($this->form_validation->run() == FALSE)
					{
						if(!validation_errors() == '' && $this->input->post('edit') == 'Update')
						{
							$msg = array('error' => validation_errors());
							set_global_messages($msg, 'error');
						}
					}
					else
					{
						$config['upload_path'] = FCPATH . 'media/folder-thumbs/';
						$config['file_field']  = 'file_'.$k;
						
						$upload_data = $this->_upload($config);
						
						$folder = array(
									'id' => $id,
									'active' => $active,
									'parent' => $parent,
									'name' => $name,
									'access' => $access,
									'group' => $group,
									'user' => $user,
									'thumb' => $upload_data
									);
						
						//FCPATH
						$update = $this->cf_file_model->update_folder($folder);
						
						if($update)
						{
							$msg = array('success' => '<p>'.$success_count++.' Records Updated successfully.</p>');
							set_global_messages($msg, 'success', false);
						}
						else
						{
							$msg = array('error' => '<p>Could not update folder specified.</p>');
							set_global_messages($msg, 'error');
						}						
						
					}
					
				}
				else
				{
						$msg = array('error' => '<p>Required fields can not be empty!</p>');
						set_global_messages($msg, 'error');
				}
			}
		}
		//END: validate data and update in database
		
		$assets = array();
		
		//load all required css
		//if media type not defined, screen is default.
		//$assets['css'] = array('admin','swiff','box','upload');
		$assets['css'] = array(
							'all' => array('admin','file','box')
						);
		//load all required js
		$assets['js'] = array();
		
		$this->cf_asset_lib->load($assets);
		
		$data['folder'] = $this->cf_file_model->get_active_folder();
		
		//---
		$html_string = $this->load->view('admin/folder/folder_edit_view', $data, TRUE);//Get view data in place of sending to browser.
		
		$this->cf_process_lib->view($html_string);
		
	}

	function create_folder()
	{
		$data = '';
		
		$this->load->library('form_validation');
		$this->load->model('cf_group_model');
		$this->load->model('cf_user_model');
		
		$data['folder'] = $this->cf_file_model->get_active_folder();
		$data['group'] = $this->cf_group_model->get_group(FALSE);
		$data['user'] = $this->cf_user_model->get_active_user();

		$val = array(
				array('field' => 'active','label' => 'Status','rules' => 'trim|required|xss_clean'),
				array('field' => 'name','label' => 'Folder Name','rules' => 'trim|required|xss_clean'),
				array('field' => 'parent','label' => 'Parent Folder','rules' => 'trim|required|xss_clean'),
				array('field' => 'access','label' => 'ASSIGN TO','rules' => 'trim|required|xss_clean')
			);
		if(isset($_POST['access']))
		{
			//---
			switch($_POST['access'])
			{
				case 'group':
					$val[] = array('field' => 'group[]','label' => 'User Group','rules' => 'trim|required|xss_clean');
					$val[] = array('field' => 'user[]','label' => 'User','rules' => 'trim|xss_clean');
					break;
				case 'user':
					$val[] = array('field' => 'group[]','label' => 'User Group','rules' => 'trim|xss_clean');
					$val[] = array('field' => 'user[]','label' => 'User','rules' => 'trim|required|xss_clean');
					break;
				default:
					$val[] = array('field' => 'group[]','label' => 'User Group','rules' => 'trim|xss_clean');
					$val[] = array('field' => 'user[]','label' => 'User','rules' => 'trim|xss_clean');
			}
		}
		
		$this->form_validation->set_rules($val);
		
		if ($this->form_validation->run() == FALSE)
		{
			if(validation_errors() !== '' && $this->input->post('create') == 'Create')
			{
				$msg = array('error' => validation_errors());
				set_global_messages($msg, 'error');
			}
			
		}
		else
		{
			$active = set_value('active');
			$parent = set_value('parent');
			$name = set_value('name');
			$access = set_value('access');
			$group = set_value('group[]');
			$user = set_value('user[]');
			
			$config['upload_path'] = FCPATH . 'media/folder-thumbs/';
			$upload_data = $this->_upload($config);
			
			$folder = array(
						'active' => $active,
						'parent' => $parent,
						'name' => $name,
						'access' => $access,
						'group' => $group,
						'user' => $user,
						'thumb' => $upload_data
						);
			
			//FCPATH
			$insert = $this->cf_file_model->create_folder($folder);
			
			if($insert)
			{
				$msg = array('success' => '<p>New Folder(s) Created.</p>');
				set_global_messages($msg, 'success');
			}
			else
			{
				$msg = array('error' => '<p>Could not create folder specified.</p>');
				set_global_messages($msg, 'error');
			}
		}
		
		$assets = array();
		
		//load all required css
		//if media type not defined, screen is default.
		//$assets['css'] = array('admin','swiff','box','upload');
		$assets['css'] = array(
							'all' => array('admin','file','box')
						);
		//load all required js
		$assets['js'] = array();
		
		$this->cf_asset_lib->load($assets);
		
		$data['folder'] = $this->cf_file_model->get_active_folder();
		
		//---
		$html_string = $this->load->view('admin/folder/folder_create_view', $data, TRUE);//Get view data in place of sending to browser.
		
		$this->cf_process_lib->view($html_string);
	
	}

	function folder_status()
	{
		$id = (int)$this->uri->segment(4, 0);
		$status = (int)$this->uri->segment(5, 0);
		
		$status = ($status == 1) ? 0 : 1;
		
		$this->db->update('folder', array('folder_status' => $status), array('folder_id' => $id));
		
		redirect('admin/folder/manage-folder');
	}
	
	function _upload($data=array())
	{
		$data = (array)$data;
		if(empty($data)) return FALSE;
		
		$config = array();
		$config['upload_path'] = FCPATH . 'media/upload/';
		$config['allowed_types'] = 'gif|jpg|png|pdf|doc|zip|csv|xls';
		$config['max_size']	= '1073741824'; //default: 1GB max
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';
		$config['file_field']  = 'file';
		
		//overwrite default config values with supplied (if any)
		$config = array_merge($config, $data);
		
		//print_r($config);
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload($config['file_field']))
		{
			$msg = array('error' => $this->upload->display_errors());
			set_global_messages($msg, 'error');
			
			return FALSE;
		}
		else
		{
			return $this->upload->data();
		}
	}
}