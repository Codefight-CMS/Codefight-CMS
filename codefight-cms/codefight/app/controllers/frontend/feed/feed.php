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
 * @package     cf_Feed
 * @copyright   Copyright (c) 2010 Codefight CMS Team (http://codefight.org)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Feed Controller
 */
class Feed extends MY_Controller
{

	/*
	 * Constructor method
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::MY_Controller();
		$this->load->model('blog/cf_blog_model', '', TRUE);
		$this->load->helper('xml');
	}
    
	public function index()
	{
		$data['encoding'] = 'utf-8';
		$data['feed_name'] = $this->setting->site_name;//str_replace('http://', '', trim(base_url(), '/'));
		$data['feed_url'] = trim(base_url(), '/');
		$data['page_description'] = $this->setting->meta_description;//'Code Fight, PHP, and the World of CMS';
		$data['page_language'] = 'en-au';
		$data['creator_email'] = 'Damodar Bashyal is at enjoygame at hotmail dot com';
		
		$feed_section = $this->uri->segment(3, 0);
		
		if ($feed_section)
		{
			if($feed_section == 'approved-comment')
			{
				$data['posts'] = $this->cf_blog_model->getApprovedComment();
				$view_file = 'frontend/templates/core/blocks/feed/rss_comments';
			}
			else if ($feed_section == 'pending-comment')
			{
				$data['posts'] = $this->cf_blog_model->getPendingComment();
				$view_file = 'frontend/templates/core/blocks/feed/rss_comments';
			}
			else
			{
				$feed_section = false;
			}
		}
		
		if (!$feed_section)
		{
			$data['posts'] = $this->cf_blog_model->getRecentPosts();
			$view_file = 'frontend/templates/core/blocks/feed/rss';
		}
		
		header("Content-Type: application/rss+xml");
		$this->load->view($view_file, $data);
	}
	
    public function releases()
    {
        $data['encoding'] = 'utf-8';
        $data['feed_name'] = $this->setting->site_name;//str_replace('http://', '', trim(base_url(), '/'));
        $data['feed_url'] = trim(base_url(), '/');
        $data['page_description'] = $this->setting->meta_description;//'Code Fight, PHP, and the World of CMS';
        $data['page_language'] = 'en-au';
        $data['creator_email'] = 'Damodar Bashyal is at enjoygame at hotmail dot com';

	$data['posts'] = $this->cf_blog_model->get_posts(10, 86);
	$view_file = 'frontend/templates/core/blocks/feed/rss';

        header("Content-Type: application/rss+xml");
        $this->load->view($view_file, $data);
    }
}
?>
