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
 * @package     cf_sortdata
 * @copyright   Copyright (c) 2010 Codefight CMS Team (http://codefight.org)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Admin sortdata Controller
 */
class Sortdata extends MY_Controller
{

    function __construct()
    {
        parent::MY_Controller();
    }

    function index()
    {
        !isset($_POST['sortme']) ? $_POST['sortme'] = array() : '';

        $sortme = $_POST['sortme'];

        $table = $this->uri->segment(3, 0);

        for ($i = 0; $i < count($sortme); $i++)
        {
            if ($this->db->update($table, array($table . '_sort' => $i), array($table . '_id' => $sortme[$i]))) echo "OK";
        }

        //$this->load->view('welcome_message');
    }
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
?>