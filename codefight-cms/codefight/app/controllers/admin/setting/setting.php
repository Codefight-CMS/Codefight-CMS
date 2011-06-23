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
 * @package     cf_setting
 * @copyright   Copyright (c) 2010 Codefight CMS Team (http://codefight.org)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Admin Setting Controller
 */
class Setting extends MY_Controller {
	
	function __construct()
	{
		parent::MY_Controller();
		
		$this->load->helper(array('form', 'text'));
		$this->load->model(array('cf_menu_model', 'admin/cf_websites_model'));
	}

	function index()
	{
		$data = '';
		
		if($this->input->post('submit')) $this->cf_setting_model->set_setting($_POST);
	
		$assets = array();
		
		//load all required css
		//if media type not defined, screen is default.
		//$assets['css'] = array('admin','swiff','box','upload');
		$assets['css'] = array(
							'all' => array('admin','setting','box')
						);
		//load all required js
		$assets['js'] = array('jquery','interface');
		
		$this->cf_asset_lib->load($assets);
		
		$data['head_includes'] = array('sortable.php', 'setting.php');
		$data['setting'] = $this->cf_setting_model->get_setting();
		$data['templates'] = $this->cf_setting_model->get_templates();
		$data['websites'] = $this->cf_websites_model->get_websites();
		
		//---
		$html_string = $this->load->view('admin/setting/setting_view', $data, true);//Get view data in place of sending to browser.
		
		$this->cf_process_lib->view($html_string);
	}

	function site()
	{
		$this->session->set_userdata('websites_id', $this->uri->segment(4, 1));
		$this->index();
	}

	function cache()
	{
		$data = '';
		
		$assets = array();
		
		//load all required css
		//if media type not defined, screen is default.
		//$assets['css'] = array('admin','swiff','box','upload');
		$assets['css'] = array(
							'all' => array('admin','setting','box')
						);
		//load all required js
		$assets['js'] = array('jquery');
		
		$this->cf_asset_lib->load($assets);
		//get templates for user selection
		$data['templates'] = $this->cf_setting_model->get_templates();
		
		if($this->input->post('cache'))
		{
			//delete all cache
			foreach($data['templates'] as $v)
			{
				$admin_fol = dirname(FCPATH)."/skin/admin/$v/cache";
				$frontend_fol = dirname(FCPATH)."/skin/frontend/$v/cache";
				
				if(is_dir($admin_fol)) $this->_emptydir($admin_fol);
				if(is_dir($frontend_fol)) $this->_emptydir($frontend_fol);
			}
			
			$msg = array('success' => "<p>Cache cleared.</p>");
			set_global_messages($msg, 'success');
		}
		
		if($this->input->post('template'))
		{
			//$this->session->set_userdata('template', 'default');//due to some issue
			$this->session->unset_userdata('template');

			$msg = array('success' => "<p>Template session refreshed.</p>");
			set_global_messages($msg, 'success');
		}
		
		//---
		$html_string = $this->load->view('admin/setting/cache_view', $data, true);//Get view data in place of sending to browser.
		
		$this->cf_process_lib->view($html_string);
	}
	
	function _emptydir($dir, $DeleteMe = false)
	{
		if(!$dh = @opendir($dir)) return;
		
		while (false !== ($obj = readdir($dh)))
		{
			if($obj=='.' || $obj=='..') continue;
			if (!@unlink($dir.'/'.$obj)) $this->_emptydir($dir.'/'.$obj, true);
		}
		closedir($dh);
		
		if ($DeleteMe)
		{
			@rmdir($dir);
		}
	}

	function keys()
	{
		if(isset($_POST['create']))
		{
			$this->_key_create();
		}
		else if(isset($_POST['delete']))
		{
			$this->_key_delete();
		}
		else if(isset($_POST['edit']))
		{
			$this->_key_edit();
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
			$assets['js'] = array('jquery');
			
			$this->cf_asset_lib->load($assets);
			
			$data['keys'] = $this->cf_setting_model->get_setting_keys();
			
			//---
			$html_string = $this->load->view('admin/setting/key_view', $data, true);//Get view data in place of sending to browser.
			
			$this->cf_process_lib->view($html_string);
		}
	}
	
	function websites()
	{
		$this->load->model(array('admin/cf_websites_model'));

		if(isset($_POST['create']))
		{
			$this->_websites_create();
		}
		else if(isset($_POST['delete']))
		{
			$this->_websites_delete();
		}
		else if(isset($_POST['edit']))
		{
			$this->_websites_edit();
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
			$assets['js'] = array('jquery');
			
			$this->cf_asset_lib->load($assets);
			
			$data['websites'] = $this->cf_websites_model->get_websites();
			
			//---
			$html_string = $this->load->view('admin/setting/websites_view', $data, true);//Get view data in place of sending to browser.
			
			$this->cf_process_lib->view($html_string);
		}
	}
	
	function _websites_create()
	{
		$data = '';

		$this->load->library('form_validation');
		
		$val = array(
				   array(
						 'field'   => 'websites_name',
						 'label'   => 'Website Name',
						 'rules'   => 'trim|required'
					  ),
				   array(
						 'field'   => 'websites_url',
						 'label'   => 'Website Url',
						 'rules'   => 'trim|required'
					  ),
				   array(
						 'field'   => 'websites_status',
						 'label'   => 'Website Status',
						 'rules'   => 'trim|required'
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
			$sql = array(
					'websites_name' => set_value('websites_name'),
					'websites_url' => prep_url(trim(set_value('websites_url'), '/')),
					'websites_status' => set_value('websites_status')
					);
			
			$this->cf_websites_model->save($sql);
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
		$html_string = $this->load->view('admin/setting/websites_create_view', $data, true);//Get view data in place of sending to browser.
		
		$this->cf_process_lib->view($html_string);
	}
	
	function _websites_edit()
	{
		$data = '';
		$id_array = array();
		
		if(!isset($_POST['websites']))
		{
			if(isset($_POST['select']))
			{
				$id_array = $_POST['select'];
			}
			else
			{
				$msg = array('error' => "<p>You must select atleast one website to edit.</p>");
				set_global_messages($msg, 'error');

				unset($_POST);
				$this->websites();
				exit();
			}
		}
		
		!is_array($id_array) ? $id_array = array() : '';

		//START: for the first page load, get data from database
		foreach($id_array as $id)
		{
			$id = (int)$id;
			
			$this->db->where('websites_id',$id);
			$query = $this->db->get('websites');
			
			foreach ($query->result() as $row)
			{
				$_POST['websites'][$row->websites_id]['websites_id'] = $row->websites_id;
				$_POST['websites'][$row->websites_id]['websites_name'] = $row->websites_name;
				$_POST['websites'][$row->websites_id]['websites_status'] = $row->websites_status;
				$_POST['websites'][$row->websites_id]['websites_url'] = $row->websites_url;
			}
		}
		//END: for the first page load, get data from database
			
		//START: clean data and update in database
		if($this->input->post('edit') == 'Update' && isset($_POST['websites']) && is_array($_POST['websites']))
		{
			foreach($_POST['websites'] as $v)
			{
				//cleaning
				$websites_id = $v['websites_id'];

				//clean the data to autofill in form
				$_POST['websites'][$websites_id]['websites_id'] = $websites_id;
				$_POST['websites'][$websites_id]['websites_name'] = $v['websites_name'];
				$_POST['websites'][$websites_id]['websites_status'] = $v['websites_status'];
				$_POST['websites'][$websites_id]['websites_url'] = $v['websites_url'];

				//update database if set
				if(!empty($v['websites_name']) && !empty($v['websites_url']) && !empty($v['websites_id']))
				{
					$this->cf_websites_model->save($v);
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
		$html_string = $this->load->view('admin/setting/websites_edit_view', $data, true);//Get view data in place of sending to browser.
		
		$this->cf_process_lib->view($html_string);
	}
	
	function _websites_delete()
	{
		$id_array = array();
		
		if(isset($_POST['select']))
		{
			$id_array = $_POST['select'];
		}
		else
		{
			$msg = array('error' => "<p>You must select atleast one website to delete.</p>");
			set_global_messages($msg, 'error');
		}
		
		$this->cf_websites_model->delete($id_array);
		
		unset($_POST);
		
		$this->websites();

	}
	
	function _key_create()
	{
		$data = '';

		$this->load->library('form_validation');
		
		$val = array(
				   array(
						 'field'   => 'setting_key',
						 'label'   => 'Setting Title',
						 'rules'   => 'trim|required'
					  ),
				   array(
						 'field'   => 'setting_form',
						 'label'   => 'Setting Form Type',
						 'rules'   => 'trim|required'
					  ),
				   array(
						 'field'   => 'setting_option',
						 'label'   => 'Setting Options',
						 'rules'   => 'trim|required'
					  ),
				   array(
						 'field'   => 'setting_info',
						 'label'   => 'Setting Info',
						 'rules'   => 'trim|required'
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
			$setting_key = set_value('setting_key');
			$setting_info = set_value('setting_info');
			$setting_form = set_value('setting_form');
			$setting_option = set_value('setting_option');
			
			$insert = $this->cf_setting_model->insert_keys(
								array(
									'setting_key'=>$setting_key,
									'setting_form'=>$setting_form,
									'setting_option'=>$setting_option,
									'setting_info'=>$setting_info
								)
							);
			
			if($insert)
			{
				$msg = array('success' => "<p>New Setting Key <strong>$setting_key</strong> Successfully Added.</p>");
				set_global_messages($msg, 'success');
			}
			else
			{
				$msg = array('error' => "<p>Setting Key <strong>$setting_key</strong> already exists!</p>");
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
		$html_string = $this->load->view('admin/setting/key_create_view', $data, true);//Get view data in place of sending to browser.
		
		$this->cf_process_lib->view($html_string);
	}
	
	function _key_delete()
	{
		$data = '';
		
		if(isset($_POST['select']))
		{
			$id_array = $_POST['select'];
		}
		else
		{
			$id_array = array();

			$msg = array('error' => "<p>You must select atleast one setting key to delete.</p>");
			set_global_messages($msg, 'error');
		}
		
		!is_array($id_array) ? $id_array = array() : '';
		
		foreach($id_array as $id)
		{
			$id = preg_replace('/[^0-9]+/','',$id);
			
			//find setting_key for the selected ID
			$query = $this->db->get_where('setting_keys', array('setting_id' => $id));
			$row = $query->result_array();

			//delete from main setting_keys table
			if($this->db->delete('setting_keys', array('setting_id' => $id)))
			{
				//then delete from setting table
				if(count($row) && isset($row[0]['setting_key']))
				{
					$this->db->delete('setting', array('setting_key' => $row[0]['setting_key']));
				}
				
				$msg = array('success' => "<p>Selected key(s) deleted successfully.</p>");
				set_global_messages($msg, 'success');
			}
			else
			{
				$msg = array('error' => "<p>Error! couldn't delete.</p>");
				set_global_messages($msg, 'error');
			}
		}
		
		unset($_POST);
		
		$this->keys();

	}
	
	function _key_edit()
	{
		$data = '';
		$id_array = array();
		
		if(!isset($_POST['setting']))
		{
			if(isset($_POST['select']))
			{
				$id_array = $_POST['select'];
			}
			else
			{
				$msg = array('error' => "<p>You must select atleast one setting key to edit.</p>");
				set_global_messages($msg, 'error');

				unset($_POST);
				$this->keys();
				exit();
			}
		}
		
		!is_array($id_array) ? $id_array = array() : '';

		//START: for the first page load, get data from database
		foreach($id_array as $id)
		{
			$id = preg_replace('/[^0-9]+/','',$id);
			
			$this->db->where('setting_id',$id);
			$query = $this->db->get('setting_keys');
			
			foreach ($query->result() as $row)
			{
				$_POST['setting'][$row->setting_id]['setting_id'] = $row->setting_id;
				$_POST['setting'][$row->setting_id]['setting_key'] = $row->setting_key;
				$_POST['setting'][$row->setting_id]['setting_info'] = $row->setting_info;
				$_POST['setting'][$row->setting_id]['setting_form'] = $row->setting_form;
				$_POST['setting'][$row->setting_id]['setting_option'] = $row->setting_option;
			}
		}
		//END: for the first page load, get data from database
			
		//START: clean data and update in database
		if($this->input->post('edit') == 'Update' && isset($_POST['setting']) && is_array($_POST['setting']))
		{
			foreach($_POST['setting'] as $v)
			{
				//cleaning
				$setting_id = $v['setting_id'];

				//clean the data to autofill in form
				$_POST['setting'][$setting_id]['setting_id'] = $setting_id;
				$_POST['setting'][$setting_id]['setting_key'] = $v['setting_key'];
				$_POST['setting'][$setting_id]['setting_info'] = $v['setting_info'];
				$_POST['setting'][$setting_id]['setting_form'] = $v['setting_form'];
				$_POST['setting'][$setting_id]['setting_option'] = $v['setting_option'];

				//update database if set
				if(!empty($v['setting_key']) && !empty($v['setting_info']) && !empty($v['setting_id']))
				{
					$query = $this->db->get_where('setting_keys', array('setting_id' => $v['setting_id']));
					$row = $query->result_array();
					
					$this->db->where('setting_id', $v['setting_id']);
					$sql = array(
								'setting_key' => $v['setting_key'], 
								'setting_option' => $v['setting_option'], 
								'setting_form' => $v['setting_form'], 
								'setting_info' => $v['setting_info']
								);
					$this->db->update('setting_keys', $sql);
					
					if(count($row) && isset($row[0]['setting_key']))
					{
						$this->db->where('setting_key', $row[0]['setting_key']);
						$this->db->update('setting', $sql);
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
							'all' => array('admin','group','box')
						);
		//load all required js
		$assets['js'] = array();
		
		$this->cf_asset_lib->load($assets);
		
		//---
		$html_string = $this->load->view('admin/setting/key_edit_view', $data, true);//Get view data in place of sending to browser.
		
		$this->cf_process_lib->view($html_string);
	}

	function sitemap()
	{
		$data = array();
		
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
		$html_string = $this->load->view('admin/setting/sitemap_view', $data, true);//Get view data in place of sending to browser.
		
		$this->cf_process_lib->view($html_string);
	}
	
}