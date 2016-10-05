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
 * @package     cf_Ajax
 * @copyright   Copyright (c) 2010 Codefight CMS Team (http://codefight.org)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Screenshot extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * default method index
     *
     * @access public
     * @return string
     */
    public function index()
    {
        $page = $this->uri->segment(4);
        if(!$page){
            $page = '';
        } else {
            $page = base64_decode($page);
        }

        $url = base_url($page);
        $dir = FCPATH . 'media' . DIRECTORY_SEPARATOR . 'screenshots' . DIRECTORY_SEPARATOR;
        $filename = md5($url) . '.png';

        $command = $this->_get_phantomjs_path() . ' ' . $this->_get_rasterize_path() . ' ' . $url . ' ' . $dir . $filename .' "500px*500px"';

        $response = exec($command);

        echo base_url() . 'media/screenshots/' . $filename;
    }

    private function _get_rasterize_path()
    {
        return FCPATH . 'skin/global/js/phantomjs/rasterize.js';
    }

    private function _get_phantomjs_path()
    {
        return 'phantomjs'; // currently assumes you have phantomjs on your path
        // local copy not used available
        // copy this to your server path
        // /usr/local/bin/
        // chmod +x phantomjs
        // skin/global/js/phantomjs/phantomjs
    }
}