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
class File extends MY_Controller
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
		redirect('admin/file/manage-file');
	}

	function file_status()
	{
		$id = (int)$this->uri->segment(4, 0);
		$status = (int)$this->uri->segment(5, 0);
		
		$status = ($status == 1) ? 0 : 1;
		
		$this->db->update('file', array('file_status' => $status), array('file_id' => $id));
		
		redirect('admin/file/manage-file');
	}

	function file_search_form()
	{
		//---
		$this->q = $this->input->post('q', TRUE);
		
		$data = '';
			
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
		$config['base_url'] = trim(site_url(), '/') . "/admin/file/".$this->uri->segment(3, 'manage-file')."/";
		$config['total_rows'] = $this->cf_file_model->get_file_count();
		$config['per_page'] = '500';
		$config['uri_segment'] = 4;
		$config['num_links'] = 3;
		$folder_id = FALSE;
		
		$this->pagination->initialize($config);
		//END: Pagination
		
		$data['pagination'] = $this->pagination->create_links();
		$data['file'] = $this->cf_file_model->get_searched_file($config['per_page'], $this->uri->segment($config['uri_segment'], 0), $this->q);
		
		//---
		$html_string = $this->load->view('admin/file/manage_file_view', $data, true);//Get view data in place of sending to browser.
		
		$this->cf_process_lib->view($html_string);
	}

	function search_file()
	{
		$this->isSearch = TRUE;
		
		$this->manage_file();
	}

	function manage_file()
	{
		if(isset($_POST['create']))
		{
			//$this->upload_file();
			redirect('admin/file/upload-file');
			return;
		}
		
		if(isset($_POST['delete']))
		{
			$this->delete_file();
			return;
		}
		
		if(isset($_POST['edit']))
		{
			$this->edit_file();
			return;
		}
		
		$data = '';
			
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
		$config['base_url'] = trim(site_url(), '/') . "/admin/file/".$this->uri->segment(3, 'manage-file')."/";
		$config['total_rows'] = $this->cf_file_model->get_file_count();
		$config['per_page'] = '30';
		$config['uri_segment'] = 4;
		$config['num_links'] = 3;
		$folder_id = FALSE;
		
		if($this->isSearch === TRUE)
		{
			$config['uri_segment'] = 5;
			$folder_id = $this->uri->segment(4, 1);
		}
		
		$this->pagination->initialize($config);
		//END: Pagination
		
		$data['pagination'] = $this->pagination->create_links();
		$data['file'] = $this->cf_file_model->get_file($config['per_page'], $this->uri->segment($config['uri_segment'], 0), $folder_id);
		
		//---
		$html_string = $this->load->view('admin/file/manage_file_view', $data, true);//Get view data in place of sending to browser.
		
		$this->cf_process_lib->view($html_string);
	}

	function delete_file()
	{
		$data = '';
		
		if(isset($_POST['select']))
		{
			$id_array = $_POST['select'];
		}
		else
		{
			$id_array = array();
			
			$msg = array('error' => '<p>You must select atleast one file to delete.</p>');
			set_global_messages($msg, 'error');
		}
		
		!is_array($id_array) ? $id_array = array() : '';
		
		foreach($id_array as $id)
		{
			//$id = preg_replace('/[^0-9]+/','',$id);
			//$this->db->delete('file', array('file_id' => $id));
			$delete = $this->cf_file_model->delete_file($id);
			
			if($this->db->affected_rows())
			{
				//if(is_file())
				
				$msg = array('success' => '<p>Selected file(s) deleted successfully.</p>');
				set_global_messages($msg, 'success');
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

	function upload_file()
	{
		$data = '';
		$this->load->library('form_validation');
		$this->load->model('cf_group_model');
		$this->load->model('cf_user_model');
		
		$data['folder'] = $this->cf_file_model->get_active_folder();
		$data['group'] = $this->cf_group_model->get_group(FALSE);
		$data['user'] = $this->cf_user_model->get_active_user();

		$val = array(
				array('field' => 'active','label' => 'STATUS','rules' => 'trim|required|xss_clean'),
				array('field' => 'parent','label' => 'UPLOAD TO','rules' => 'trim|required|xss_clean'),
				array('field' => 'name','label' => 'FILE TITLE','rules' => 'trim|required|xss_clean'),
				array('field' => 'description','label' => 'FILE DESCRIPTION','rules' => 'trim|required|xss_clean'),
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
			if(validation_errors() !== '' && $this->input->post('create') == 'Upload')
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
			$description = set_value('description');
			$access = set_value('access');
			$group = set_value('group[]');
			$user = set_value('user[]');
			
			$config['upload_path'] = $this->cf_file_model->get_upload_path($parent);
			
			if(!$config['upload_path'])
			{
				$msg = array('error' => '<p>Upload Path Not Found.</p>');
				set_global_messages($msg, 'error');
			}
			else
			{
				if($upload_data = $this->_upload($config))
				{
					$file = array(
								'active' => $active,
								'parent' => $parent,
								'name' => $name,
								'description' => $description,
								'access' => $access,
								'group' => $group,
								'user' => $user,
								'upload_data' => $upload_data
								);
			
					$insert = $this->cf_file_model->add_new_file($file);
					
					if($insert)
					{
						$msg = array('success' => '<p>New file successfully uploaded</p>');
						set_global_messages($msg, 'success');
					}
					else
					{
						$msg = array('error' => '<p>Could not upload file.</p>');
						set_global_messages($msg, 'error');
					}
				}
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
		
		//---
		$html_string = $this->load->view('admin/file/upload_file_view', $data, TRUE);//Get view data in place of sending to browser.
		
		$this->cf_process_lib->view($html_string);
	}

	function edit_file()
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
				$msg = array('error' => '<p>You must select atleast one file to edit.</p>');
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
			
			$this->db->where('file_id',$id);
			$query = $this->db->get('file');
			
			foreach ($query->result() as $row)
			{
				$_POST['file'][$row->file_id]['id'] = $row->file_id;
				$_POST['file'][$row->file_id]['active'] = $row->file_status;
				$_POST['file'][$row->file_id]['access'] = $row->file_access;
				$_POST['file'][$row->file_id]['parent'] = $row->folder_id;
				$_POST['file'][$row->file_id]['name'] = $row->file_title;
				$_POST['file'][$row->file_id]['description'] = $row->file_description;
				$file_access_members = explode(',', trim($row->file_access_members, ','));
				$_POST['file'][$row->file_id]['group'] = $file_access_members;
				$_POST['file'][$row->file_id]['user'] = $file_access_members;
			}
		}
		//END: for the first page load, get data from database
			
		//START: clean data and update in database
		if($this->input->post('edit') == 'Update' && isset($_POST['file']) && is_array($_POST['file']))
		{
			foreach($_POST['file'] as $k => $v)
			{
				//cleaning
				$id = xss_clean($v['id']);//set_value('id');
				$active = xss_clean($v['active']);//set_value('active');
				$name = xss_clean($v['name']);//set_value('name');
				$description = xss_clean($v['description']);//set_value('description');
				$access = xss_clean($v['access']);
				$group = '';
				if(isset($v['group'])) $group = xss_clean($v['group']);
				$user = '';
				if(isset($v['user'])) $user = xss_clean($v['user']);

				//clean the data to autofill in form
				$_POST['file'][$id]['id'] = $id;
				$_POST['file'][$id]['active'] = $active;
				$_POST['file'][$id]['name'] = $name;
				$_POST['file'][$id]['description'] = $description;
				$_POST['file'][$id]['access'] = $access;
				$_POST['file'][$id]['group'] = $group;
				$_POST['file'][$id]['user'] = $user;

				//update database if set
				if(!empty($access) && !empty($name) && !empty($id))
				{
					
					$val = array(
							array('field' => 'file['.$k.'][active]','label' => 'STATUS[id: '.$id.']','rules' => 'trim|required|xss_clean'),
							array('field' => 'file['.$k.'][name]','label' => 'FILE NAME[id: '.$id.']','rules' => 'trim|required|xss_clean'),
							array('field' => 'file['.$k.'][description]','label' => 'FILE DESCRIPTION[id: '.$id.']','rules' => 'trim|xss_clean'),
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
						$file = array(
									'id' => $id,
									'active' => $active,
									'name' => $name,
									'description' => $description,
									'access' => $access,
									'group' => $group,
									'user' => $user
									);
						
						//FCPATH
						$update = $this->cf_file_model->update_file($file);
						
						if($update)
						{
							$msg = array('success' => '<p>'.$success_count++.' Records Updated successfully.</p>');
							set_global_messages($msg, 'success', false);
						}
						else
						{
							$msg = array('error' => '<p>Could not update files specified.</p>');
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

		//---
		$html_string = $this->load->view('admin/file/file_edit_view', $data, true);//Get view data in place of sending to browser.
		
		$this->cf_process_lib->view($html_string);
	}
}