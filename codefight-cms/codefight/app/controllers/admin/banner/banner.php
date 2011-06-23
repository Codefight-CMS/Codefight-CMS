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
 * @package     cf_banner
 * @copyright   Copyright (c) 2010 Codefight CMS Team (http://codefight.org)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Admin Banner Controller
 */
class Banner extends MY_Controller {

	function __construct()
	{
		parent::MY_Controller();

		$this->load->helper('file');
	}
	
	function index()
	{
		$data = '';
		
		$banner_extension = $this->_tep_banner_image_extension();
		
		// check if the graphs directory exists
		$dir_ok = false;
		
		if (function_exists('imagecreate') && !empty($banner_extension))
		{
			if (is_dir(FCPATH . 'media/graph'))
			{
				if (is_writeable(FCPATH . 'media/graph'))
				{
					$dir_ok = true;
				}
				else
				{
					// display login error
					//$data['error_message'][] = 'Folder "' . dirname(FCPATH) . '/media/graph" must be writeable.';
					$msg = array('error' => "<p>Folder " . FCPATH . "/media/graph must be writeable.</p>");
					set_global_messages($msg, 'error');
				}

			}
			else
			{
				// display login error
				//$data['error_message'][] = 'Folder "' . dirname(FCPATH) . '/media/graph" does not exists.';
				$msg = array('error' => "<p>Folder " . FCPATH . "/media/graph does not exists.</p>");
				set_global_messages($msg, 'error');
			}
		}
		
		$this->db->order_by('banner_title', 'asc');

		$banner_query = $this->db->get('banner');
		$data['banner'] = $banner_query->result_array();
		
		foreach ($data['banner'] as $k => $v)
		{
			$info_query = $this->db->query("select sum(banner_shown) as banner_shown, sum(banner_clicked) as banner_clicked from cf_banner_history where banner_id = '" . (int)$v['banner_id'] . "'");
			$data['banner'][$k]['info'] = $info_query->result_array();
		}

		$assets = array();
		
		//load all required css
		//if media type not defined, screen is default.
		//$assets['css'] = array('admin','swiff','box','upload');
		$assets['css'] = array(
							'screen' => array('admin','swiff','box','upload'),
							'print' => array('admin')
						);
		//load all required js
		//$assets['js'] = array('mootools-1.2.1-core','Swiff.Uploader','Fx.ProgressBar','FancyUpload2');
		
		$this->cf_asset_lib->load($assets);
		
		$this->load->view('admin/banner/banner_view', $data);
	}
	
	function create() 
	{
		$data = array();
		$data['banner'] = array('banner_title' => '',
								'banner_url' => '',
								'banner_image' => '',
								'banner_html_text' => '',
								'expire_date' => '',
								'expire_impressions' => '',
								'expire_clicks' => '',
								'date_scheduled' => '',
								'status' => '1');
		$data['action'] = 'new';
		$data['form_action'] = 'insert';
		
		$banner[0] = array('expire_date' => '',
                        'date_scheduled' => '',
                        'banner_title' => '',
                        'banner_url' => '',
                        'banner_group' => '',
                        'banner_image' => '',
                        'banner_html_text' => '',
                        'expire_impressions' => '',
                        'expire_clicks' => '');
		
		if ($this->uri->segment(3, 0))
		{
			$data['form_action'] = 'update';
			
			$data['bID'] = $this->uri->segment(3, 0);
			
			$banner_query = $this->db->query("select banner_title, banner_url, banner_image, banner_group, banner_html_text, status, date_format(date_scheduled, '%d/%m/%Y') as date_scheduled, date_format(expire_date, '%d/%m/%Y') as expire_date, expire_impressions, expire_clicks, date_status_change from cf_banner where banner_id = '" . (int)$data['bID'] . "'");
			
			$banner = $banner_query->result_array();
		
		}
		elseif (!empty($_POST))
		{
			$banner[0] = $_POST;
		}
		
		if(isset($banner[0])) $data['banner'] = $banner[0];
		/*
		
		
		
		TODO:: write validation part here
		
		
		*/
		if(isset($_POST['submit']))
		{
			$banner_id = (isset($_POST['banner_id'])) ? preg_replace('/[^0-9]+/','',$_POST['banner_id']) : false;
			
			$banner_title = $_POST['banner_title'];
			$banner_url = $_POST['banner_url'];
			$banner_image_local = $_POST['banner_image_local'];
			$banner_image_target = $_POST['banner_image_target'];
			$banner_html_text = $_POST['banner_html_text'];
			$db_image_location = '';
			$expire_date = $_POST['expire_date'];
			$expire_impressions = $_POST['expire_impressions'];
			$expire_clicks = $_POST['expire_clicks'];
			$date_scheduled = $_POST['date_scheduled'];
			
			/* 

			TODO:: upload image

			*/
			
	
			//if validation success do following 
			$db_image_location = (!empty($banner_image_local)) ? $banner_image_local : '';

			$sql_data_array = array('banner_title' => $banner_title,
									'banner_url' => $banner_url,
									'banner_image' => $db_image_location,
									'banner_html_text' => $banner_html_text,
									'expire_date' => $expire_date,
									'expire_impressions' => $expire_impressions,
									'expire_clicks' => $expire_clicks,
									'date_scheduled' => $date_scheduled,
									'status' => '1');
			
			/* if insert - then do following */
			if(!$banner_id)
			{
				$insert_sql_data = array('date_added' => 'now()');
				
				$sql_data_array = array_merge($sql_data_array, $insert_sql_data);
				
				$this->db->insert('banner', $sql_data_array);
				
				$banner_id = $this->db->insert_id();
			}
			else
			{
				$this->db->where('banner_id', (int)$banner_id);
				$this->db->update('banner', $sql_data_array);
			}
			
			if($banner_id) redirect('admin/banner');
		}

		$assets = array();
		
		//load all required css
		//if media type not defined, screen is default.
		//$assets['css'] = array('admin','swiff','box','upload');
		$assets['css'] = array(
							'screen' => array('admin','swiff','box','upload'),
							'print' => array('admin')
						);
		//load all required js
		//$assets['js'] = array('mootools-1.2.1-core','Swiff.Uploader','Fx.ProgressBar','FancyUpload2');
		
		$this->cf_asset_lib->load($assets);
		
		$this->load->view('admin/banner/banner_view', $data);
	}
	
	function status() 
	{
		//
		if ($this->uri->segment(3, 0))
		{
			$this->db->where('banner_id', (int)$this->uri->segment(3, 0));
			$this->db->set('status', (int)$this->uri->segment(5, 0));
			$this->db->update('banner');
		}
		redirect('admin/banner');
	}
	
	function delete() 
	{
		//TODO:: 
		if ($this->uri->segment(3, 0))
		{
			$this->db->where('banner_id', (int)$this->uri->segment(3, 0));
			$this->db->delete('banner');
		}
		redirect('admin/banner');
	}
	
	function _tep_banner_image_extension()
	{
		if (function_exists('imagetypes'))
		{
			if (imagetypes() & IMG_PNG)
			{
				return 'png';
			} 
			elseif (imagetypes() & IMG_JPG)
			{
				return 'jpg';
			} 
			elseif (imagetypes() & IMG_GIF)
			{
				return 'gif';
			}
		}
		elseif (function_exists('imagecreatefrompng') && function_exists('imagepng'))
		{
			return 'png';
		}
		elseif (function_exists('imagecreatefromjpeg') && function_exists('imagejpeg'))
		{
			return 'jpg';
		}
		elseif (function_exists('imagecreatefromgif') && function_exists('imagegif'))
		{
			return 'gif';
		}
		
		return false;
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */