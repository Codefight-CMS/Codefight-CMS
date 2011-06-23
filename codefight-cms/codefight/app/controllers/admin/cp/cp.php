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
 * @package     cf_cp
 * @copyright   Copyright (c) 2010 Codefight CMS Team (http://codefight.org)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Admin Control Panel Main Page
 */
class Cp extends MY_Controller {

	function __construct()
	{
		parent::MY_Controller();
		error_reporting(0);
	}
	

    /**
     * Control Panel Admin(Index) Page Function
     * Get Top Page Of The Website.
     */
	function index()
	{
		$data = '';
		
		$this->load->model('cf_cp_model');

		$assets = array();
		
		//load all required css
		//if media type not defined, screen is default.
		//$assets['css'] = array('admin','swiff','box','upload');
		$assets['css'] = array(
							'all' => array('admin','box', 'cp')
						);
		//load all required js
		$assets['js'] = array('jquery');
		
		$this->cf_asset_lib->load($assets);
		
		$data['top_page'] = $this->cf_cp_model->get_top_page();

		//---
		$html_string = $this->load->view('admin/cp/cp_view', $data, true);//Get view data in place of sending to browser.
		
		$this->cf_process_lib->view($html_string);
	}
	

    /**
     * Control Panel Admin/Update Page Function
     * Get Release Notes From Official Site Of Codefight CMS.
     */
	function update()
	{
		$data = '';
		
		$assets = array();
		
		//load all required css
		//if media type not defined, screen is default.
		//$assets['css'] = array('admin','swiff','box','upload');
		$assets['css'] = array(
							'all' => array('admin','box', 'cp')
						);
		//load all required js
		$assets['js'] = array('jquery');
		
		$this->cf_asset_lib->load($assets);
		
		$codefight = array();
		if($xml = simplexml_load_file('http://codefight.org/tools/feed/releases'))
		{
			$channel = ($xml->channel);
			
			foreach($channel as $v)
			{
				foreach($v->item as $w)
				{
					$codefight[] = $w;
				}
			}
		}
		
		$data['codefight'] = $codefight;
		

		//---
		$html_string = $this->load->view('admin/cp/update_view', $data, true);//Get view data in place of sending to browser.
		
		$this->cf_process_lib->view($html_string);
	
	}
}

/* End of file cp.php */
/* Location: ./app/admin/controllers/cp/cp.php */