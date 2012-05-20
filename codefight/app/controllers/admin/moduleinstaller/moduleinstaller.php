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
 * @package     cf_modulecreator
 * @copyright   Copyright (c) 2010 Codefight CMS Team (http://codefight.org)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Admin Control Panel Main Page
 */
class Moduleinstaller extends MY_Controller
{

    function __construct()
    {
        parent::MY_Controller();
    }


    /**
     * Control Panel Admin(Index) Page Function
     * Get Top Page Of The Website.
     */
    function index()
    {
        $data = '';
		$sort = 1;
		$menu_item = Library('module')->_getAdminNav();

		$query = $this->db->order_by('parent')->get('module');
		$modules_db = $query->result_array();
		foreach($modules_db as $k => $v)
		{
			$modules_db[$v['url']] = $v;
			unset($modules_db[$k]);
		}

		foreach($menu_item as $v)
		{
			$sql = array();
			$key = 0;

			$sql[$key] = array(
				'parent' => 'top',
				'status' => 1,
				'sort' => $sort++,
				'url' => $v['url'],
				'title' => $v['title'],
				'is_menu' => $v['is_menu'],
				'void' => $v['void'],
				'menu' => serialize($v),
				'child' => ''
			);
			if(isset($v['child']) && count($v['child']) > 0)
			{
				$sql[$key++]['child'] = serialize(array_keys($v['child']));
				foreach($v['child'] as $k2 => $v2)
				{
					$sql[$key] = array(
						'parent' => $v['url'],
						'status' => 1,
						'sort' => $sort++,
						'url' => $v2['url'],
						'title' => $v2['title'],
						'is_menu' => $v2['is_menu'],
						'void' => $v2['void'],
						'child' => ''
					);
					if(isset($v2['child']) && count($v2['child']) > 0)
					{
						$sql[$key++]['child'] = serialize(array_keys($v2['child']));
						foreach($v2['child'] as $k3 => $v3)
						{
							$sql[$key++] = array(
								'parent' => $v2['url'],
								'status' => 1,
								'sort' => $sort++,
								'url' => $v3['url'],
								'title' => $v3['title'],
								'is_menu' => $v3['is_menu'],
								'void' => $v3['void'],
								'child' => ''
							);
						}
					}
					$key++;
				}
				$key++;
			}

			foreach($sql as $k => $v)
			{
				if(isset($modules_db[$v['url']]))
				{
					$this->db->update('module', $v, array('url' => $v['url']));
					unset($sql[$k]);
				}
			}
			if(count($sql) > 0)
			{
				$this->db->insert_batch('module', $sql);
			}
		}

        //---
        $html_string = $this->load->view('admin/moduleinstaller/moduleinstaller_view', $data, true); //Get view data in place of sending to browser.

        $this->cf_process_lib->view($html_string);
    }
}

/* End of file modulecreator.php */
/* Location: ./app/admin/controllers/modulecreator/modulecreator.php */
