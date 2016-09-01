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
 * to info
 *
 * @codefight   .org so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Codefight CMS to newer
 * versions in the future.
 *
 * @category    Codefight CMS
 * @package     cf_Blog
 * @copyright   Copyright (c) 2010 Codefight CMS Team (http://codefight.org)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Blog Controller
 */
class Blog extends MY_Controller
{
    var $meta = false;

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
            'helper'  => 'text + form'
        );

        parent::__construct($load);

    }

    /**
     *
     *
     * @access public
     * @return void
     */
    public function index()
    {
        //Library('menu')->get(array('ul_param' => 'class="jd_menu test"'));

        //if page_id is numeric and is greater than 0, that means request for full article
        if (is_numeric($this->page_id) && $this->page_id > 0) {
            //Get full page text on clicking more >> link
            $data = Model('blog')->get_page_full($this->page_id);
        }
        else
        {

            /*
                * START: Pagination config and initialization
                */
            //if(!$this->page_id) $this->page_id = 'home';

            $config['base_url']    = base_url() . 'blog/' . $this->menu_id . '/' . $this->page_id . '/';
            $config['total_rows']  = Model('blog')->get_blog_count($this->menu_id);
            $config['uri_segment'] = 4;
            //END: Pagination

            //pagination, loaded from library -> MY_Controller
            $this->paginate($config);

            //Get page content for the selected menu item.
            $data = Model('blog')->get_blog_contents(
                $this->menu_id, $this->setting->pagination_per_page, $this->current_page
            );

            //get created page links from library -> MY_Controller (paginate_page)
            $data['pagination'] = $this->page_links;
        }

        /*
           | Send data to Format Content and get back.
           | See These Files For Processing:
           | libraries/block/block_Library.php
           */
        if (count($data['content']) > 0) {
            $data['content'] = Model('blog')->parseContent($data['content']);
        } else {
            Model('blog')->redirect_blog($this->page_id);

            header("HTTP/1.0 404 Not Found");
            //if content not found | Set meta to noindex to save your website value to search engines.
            $data['noindex'] = 'yes';
        }

        if (!empty($this->meta)) {
            $data['meta'] = array_merge($data['meta'], $this->meta);
        }

        if (($cur_page = $this->pagination->getCurPage()) > 1) {
            $data['meta']['title'] .= ' - ' . __('Page ') . __($cur_page);
            $data['noindex'] = 'yes';
        }

        //main content block [content view]
        $data['content_block'] = 'page_html/blog_view';

        /*
           | @process_view('data', 'master page')
           | @see app/core/MY_Controller.php
           */
        $this->process_view($data);
    }

    /**
     *
     *
     * @access public
     * @return void
     */
    public function c()
    {
        $this->menu_link = $this->uri->segment(3, 'home');

        $this->db->where('menu_type', 'blog');
        $this->db->where('menu_link', $this->menu_link);
        $this->db->limit(1);
        $query = $this->db->get('menu');
        $row   = $query->result_array();

        $this->menu_id = 0;
        $meta['title'] = $meta['keywords'] = $meta['description'] = $this->menu_link . ' - Blog Category';

        foreach ($row as $v)
        {
            $this->menu_id = $v['menu_id'];

            if (!empty($v['menu_meta_title'])) {
                $meta['title'] = $v['menu_meta_title'];
            } else {
                $meta['title'] = ucwords($v['menu_title']) . ' - ' . __('Category');
            }
            if (!empty($v['menu_meta_keywords'])) {
                $meta['keywords'] = $v['menu_meta_keywords'];
            } else {
                $meta['keywords'] = preg_replace('/\s+|\s/', ',', ucwords($v['menu_title'])) . ',Blog,Category';
            }
            if (!empty($v['menu_meta_description'])) {
                $meta['description'] = $v['menu_meta_description'];
            } else {
                $meta['description'] = ucwords($v['menu_title']) . ' - Category - Blog Posts';
            }
        }

        $this->meta = $meta;

        $this->index();
    }
}

/* End of file blog.php */
/* Location: ./app/frontend/controllers/blog/blog.php */
