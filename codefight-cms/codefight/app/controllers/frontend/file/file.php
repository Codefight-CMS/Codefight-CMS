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

/**
 * Page Controller
 */
class File extends MY_Controller
{

    /**
     * Constructor method
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        /*
           | define an array $load with keys model,library etc
           | you can load multiple models etc separated by + sign
           | you can load the CI way as well though :)
           */
        $load = array(
            'model' => 'page/cf_page_model + blog/cf_blog_model + cf_menu_model + file/cf_file_model',
            'library' => 'cf_bbcode_lib + cf_form_lib',
            'helper' => 'text + form'
        );

        parent::MY_Controller($load);

    }

    /**
     * default method index
     *
     * @access public
     * @return void
     */
    public function index($id = 'file')
    {
        //Get page content for the selected menu item.
        $this->menu_link = $id; //$this->uri->segment(1, 'home');

        $data = $this->cf_page_model->get_page_contents($this->menu_link);

        /*
           | Send data to Format Content and get back.
           | See These Files For Processing:
           | models/cf_blog_model.php
           | models/cf_data_model.php
           | libraries/cf_block_lib.php
           */
        if (isset($data['content']) && count((array)$data['content']) > 0) {
            //For static page, display full content by passing 2nd param as false.
            $data['content'] = $this->cf_page_model->parse_content($data['content'], FALSE);
            $data['content'] = $this->cf_file_model->process($data['content']);
        }
        else
        {
            //if content not found | Set meta to noindex, nofollow to save your website value to search engines.
            $data['noindex'] = 'yes';
        }

        //load all required css
        $assets['css'] = array('page', 'file');

        //load all required js
        //$assets['js'] = array();

        $this->cf_asset_lib->load($assets);

        //main content block [content view]
        $data['content_block'] = 'page_html/page_view';

        /*
           | @process_view('data', 'master page')
           | @see app/core/MY_Controller.php
           */
        $this->process_view($data);
    }

    public function folder()
    {
        //---
        $id = (int)$this->uri->segment(3, 0);

        if ($id < 1) {
            return $this->index();
            exit;
        }

        //return $this->index('folder');
        return $this->index();
    }

    public function search()
    {
        //--
        //TODO::
        $this->index();
    }
}

/* End of file page.php */
/* Location: ./app/frontend/controllers/page/page.php */
?>