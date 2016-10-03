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
 * @package     cf_User
 * @copyright   Copyright (c) 2010 Codefight CMS Team (http://codefight.org)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * User Controller
 */
class User extends MY_Controller
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
            'helper' => 'text + form'
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
	$data = array();

	/*
	 * Get User Data
	 */
	 $user_id = (int)$this->uri->segment(2, 0);

	 $query = $this->db->where('user_id', $user_id)->limit(1)->get('user');
	 $data['user'] = $query->result_array();

	 foreach($data['user'] as $v)
	 {
		$user['name'] = $v['firstname'] . ' ' . $v['lastname'];
		$data['meta'] = array(
				'title' => 'Profile - '.$user['name'] . ' - ' . $this->setting->site_name,
				'keywords' => $v['firstname'] . ',' . $v['lastname'] . ',' . $user['name'] . ',profile,author,editor,writer,user'.$v['user_id'],
				'description' => character_limiter(strip_tags($v['profile']), 60),
				);
	 }


	 $query = $this->db
			->where('user_id', $user_id)
			->where('page_active', 1)
			->order_by('page_date', 'desc')
			->limit(5)
			->get('page');
	 $result = $query->result_array();
	 $blogs = array();
	 foreach($result as $v)
	 {
		$v['menu_id'] = explode(',', trim($v['menu_id'], ','));
		$v['menu_id'] = $v['menu_id'][0];
		$title = url_title($v['page_title']);
		$blogs[$v['page_id']]['url'] = site_url('blog/'.$v['menu_id'].'/'.$v['page_id'].'/'.$title);
		$blogs[$v['page_id']]['title'] = $v['page_title'];
	 }
	 $data['blogs']['Latest'] = $blogs;

	 $query = $this->db
			->where('user_id', $user_id)
			->where('page_active', 1)
			->order_by('page_view', 'desc')
			->limit(5)
			->get('page');
	 $result = $query->result_array();
	 $blogs = array();
	 foreach($result as $v)
	 {
		$v['menu_id'] = explode(',', trim($v['menu_id'], ','));
		$v['menu_id'] = $v['menu_id'][0];
		$title = url_title($v['page_title']);
		$blogs[$v['page_id']]['url'] = site_url('blog/'.$v['menu_id'].'/'.$v['page_id'].'/'.$title);
		$blogs[$v['page_id']]['title'] = $v['page_title'];
	 }
	 $data['blogs']['Most Viewed'] = $blogs;

        //main content block [content view]
        $data['content_block'] = 'user/user_view';

        /*
           | @process_view('data', 'master page')
           | @see app/core/MY_Controller.php
           */
        $this->process_view($data);
    }
}

/* End of file user.php */
/* Location: ./app/controllers/frontend/user/user.php */
?>
