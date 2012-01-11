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
 * @package     cf_Home
 * @copyright   Copyright (c) 2010 Codefight CMS Team (http://codefight.org)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * SEO Home Controller
 */
class Home extends MY_Controller
{

    /**
     * Constructor method
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        parent::MY_Controller();
    }

    /**
     *
     *
     * @access public
     * @return void
     */
    public function index()
    {
        $this->load->model('blog/cf_blog_model');
        $this->load->model('cf_menu_model');
        $this->load->helper('text');

        //On clicking menu link, show all page contents linked to that link
        //if second uri segment not found return 1 as default menu id
        $menu_id = $this->uri->segment(2, 1);
        //On clicking more link of the page blurb show full text
        $page_id = $this->uri->segment(3, 0);
        //pagination
        $page = $this->uri->segment(4, 0);

        if (is_numeric($page_id) && $page_id > 0) {
            //Get full page text on clicking more>> link
            $data = $this->cf_blog_model->get_page_full($page_id);
        } else {
            /*
                * START: Pagination config and initialization
                */
            $this->load->library('pagination');
            if (!$page_id) $page_id = 'home';
            $config['base_url'] = base_url() . "page/$menu_id/$page_id/";
            $config['total_rows'] = $this->cf_blog_model->get_blog_count($menu_id);
            $config['per_page'] = '5';
            $config['uri_segment'] = 4;
            $config['num_links'] = 2;

            $this->pagination->initialize($config);
            //END: Pagination


            //Get page content for the selected menu item.
            $data = $this->cf_blog_model->get_blog_contents($menu_id, $config['per_page'], $page);
            $data['pagination'] = $this->pagination->create_links();
        }

        $assets = array();

        //load all required css
        //if media type not defined, screen is default.
        //$assets['css'] = array('admin','swiff','box','upload');
        $assets['css'] = array(
            'screen' => array('page')
        );
        //load all required js
        $assets['js'] = array();

        $this->cf_asset_lib->load($assets);

        //main content block [content view]
        $data['content_block'] = 'page_view';

        $this->load->view('templates/default/index', $data);
    }
}

/* End of file home.php */
/* Location: ./app/frontend/controllers/seo/home.php */
?>