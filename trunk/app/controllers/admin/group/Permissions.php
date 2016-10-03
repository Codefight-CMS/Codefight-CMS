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
class Permissions extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('form', 'text'));

		$id = $this->uri->segment(5, 0);

		if(!isset($_POST['group_id']) && $id)
		{
			$_POST['group_id'] = (int)$id;
		}
    }

    /**
     * User Group
     * Create group
     */
    function index()
    {
        $data = '';

        $data['group_id'] = $group_id = $this->input->post('group_id', 1);
        $data['modules'] = Model('module')->get();
        $data['module_ids'] = Model('module')->get_ids();
        $data['groups'] = Model('groups/permission')->get_group();

		if(isset($_POST['group_id']) && isset($_POST['permission']))
		{
			Model('groups/permission')->update_permissions($_POST['group_id'], $_POST['permission']);
		}

		$data['permissions'] = Model('groups/permission')->get_group_permission($group_id);

		//---
		$html_string = $this->load->view('admin/group/permission_view', $data, true); //Get view data in place of sending to browser.

		Library('process')->view($html_string);
    }
}
