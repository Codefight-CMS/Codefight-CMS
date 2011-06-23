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
 * @package     cf_Comment
 * @copyright   Copyright (c) 2010 Codefight CMS Team (http://codefight.org)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Admin Comment Manager
 */
class Comment extends MY_Controller {

	function __construct()
	{
		parent::MY_Controller();
		
		$this->load->helper(array('form', 'text'));
		$this->load->model(array('cf_comment_model', 'cf_menu_model'));
	}
	

	function index()
	{
		
		$data = '';
		if(isset($_POST['delete']))
		{
			$data = $this->_delete();
		}
		elseif(isset($_POST['approve']))
		{
			$data = $this->_approve();
		}
		
		
		$assets = array();
		
		//load all required css
		//if media type not defined, screen is default.
		//$assets['css'] = array('admin','swiff','box','upload');
		$assets['css'] = array(
							'all' => array('admin','comment','box')
						);
		//load all required js
		$assets['js'] = array('jquery');
		
		$this->cf_asset_lib->load($assets);
		
		/*
		 * START: Pagination config and initialization
		 */
		$this->load->library('pagination');
		$config['per_page'] = '20';
		$config['uri_segment'] = 3;
		$config['num_links'] = 2;
		
		if($this->uri->segment(3, 'pending-comment') == 'pending-comment')
		{
			$status = 0;
		}
		else
		{
			$status = 1;
		}
		
		$config['base_url'] = trim(site_url(), '/') . "/comment/".$this->uri->segment(3, 'approved-comment')."/";
		$config['total_rows'] = $this->cf_comment_model->get_comment_count($status);
		
		$this->pagination->initialize($config);
		//END: Pagination
		
		//Get page content for the selected menu item.
		$data['pagination'] = $this->pagination->create_links();
		
		//load comment menu
		$data['comment'] = $this->cf_comment_model->get_comment($config['per_page'], $this->uri->segment(3, 0),$status);
		
		//---
		$html_string = $this->load->view('admin/comment/comment_view', $data, true);//Get view data in place of sending to browser.
		
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
			
			$msg = array('error' => "<p>You must select atleast one comment to delete.</p>");
			set_global_messages($msg, 'error');
		}
		
		!is_array($id_array) ? $id_array = array() : '';
		
		$msg = false;
		foreach($id_array as $id)
		{
			$id = preg_replace('/[^0-9]+/','',$id);

			if($this->db->delete('page_comment', array('page_comment_id' => $id)))
			{
				$msg = array('success' => "<p>Selected comment(s) deleted successfully.</p>");
				$type = 'success';
			}
			else
			{
				$msg = array('error' => "<p>Error! couldn't delete.</p>");
				$type = 'error';
			}

		}
		if($msg) set_global_messages($msg, $type);
		
		redirect(current_url());
	}

	function _approve()
	{
		$data = '';
		
		if(isset($_POST['select']))
		{
			$id_array = $_POST['select'];
		}
		else
		{
			$id_array = array();

			$msg = array('error' => "<p>You must select atleast one comment to approve.</p>");
			set_global_messages($msg, 'error');
		}
		
		!is_array($id_array) ? $id_array = array() : '';
		
		$msg = false;
		foreach($id_array as $id)
		{
			$id = preg_replace('/[^0-9]+/','',$id);

			$this->db->where('page_comment_id', $id);
			if($this->db->update('page_comment', array('page_comment_status' => '1')))
			{
				$msg = array('error' => "<p>Selected comment(s) approved successfully.</p>");
				$type = 'success';
			}
			else
			{
				$msg = array('error' => "<p>Error! couldn't approve.</p>");
				$type = 'error';
			}

		}
		if($msg) set_global_messages($msg, $type);
		
		return $data;
	}
	
}