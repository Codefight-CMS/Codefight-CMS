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
 * @package     cf_Blog
 * @copyright   Copyright (c) 2010 Codefight CMS Team (http://codefight.org)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Blog Controller
 */
class Blog extends MY_Controller
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
			'model' 	=> 'blog/cf_blog_model + cf_menu_model',
			'library' 	=> 'cf_bbcode_lib + cf_form_lib',
			'helper' 	=> 'text + form'
		);

		parent::MY_Controller($load);

	}
	
	/**
	 * 
	 *
	 * @access public
	 * @return void
	 */
	public function index()
	{
		//$this->cf_menu_lib->get(array('ul_param' => 'class="jd_menu test"'));

		//if page_id is numeric and is greater than 0, that means request for full article
		if(is_numeric($this->page_id) && $this->page_id > 0)
		{
			//Get full page text on clicking more >> link
			$data = $this->cf_blog_model->get_page_full($this->page_id);
		} 
		else
		{
			
			/*
			 * START: Pagination config and initialization
			 */
			//if(!$this->page_id) $this->page_id = 'home';
			
			$config['base_url'] = base_url() . 'blog/'.$this->menu_id.'/'.$this->page_id.'/';
			$config['total_rows'] = $this->cf_blog_model->get_blog_count($this->menu_id);
			$config['uri_segment'] = 4;
			//END: Pagination
			
			//pagination, loaded from library -> MY_Controller
			$this->paginate($config);
			
			//Get page content for the selected menu item.
			$data = $this->cf_blog_model->get_blog_contents($this->menu_id, $this->setting->pagination_per_page, $this->current_page);
			
			//get created page links from library -> MY_Controller (paginate_page)
			$data['pagination'] = $this->page_links;
		}
		
		/*
		 | Send data to Format Content and get back.
		 | See These Files For Processing:
		 | models/cf_blog_model.php
		 | models/cf_data_model.php
		 | libraries/cf_block_lib.php
		 */
		if(isset($data['content']) && count((array)$data['content']) > 0) {
			$data['content'] = $this->cf_blog_model->parse_content($data['content']);
		} else {
			header("HTTP/1.0 404 Not Found");
			//if content not found | Set meta to noindex, nofollow to save your website value to search engines.
			$data['noindex'] = 'yes';
		}
		
		//load all required css
		$assets['css'] = array('page');
		
		//load all required js
		//$assets['js'] = array();
		
		$this->cf_asset_lib->load($assets);
		
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
		$row = $query->result_array();
		
		
		if(isset($row[0]['menu_id']))
			$this->menu_id = $row[0]['menu_id'];
		else
			$this->menu_id = 0;
		
		$this->index();
	}
}

/* End of file blog.php */
/* Location: ./app/frontend/controllers/blog/blog.php */
?>