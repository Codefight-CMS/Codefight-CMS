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
 * Blog Ajax Controller
 */
class Ajax extends MY_Controller {

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
	 * Default method index
	 *
	 * @access public
	 * @return void
	 */
	public function index()
	{
	}
	
	/**
	 * Set Selected Language
	 *
	 * @access public
	 * @return void
	 */
	public function set_language() {

		$lang = preg_replace('/[^0-9a-z]+/', '', strtolower($_POST['id']));
		
		if($lang) {
			$this->session->set_userdata('cf_language', $lang);
			echo 'OK';
		} else {
			echo $lang;
		}
	}
	
	/**
	 * Set Selected Template
	 *
	 * @access public
	 * @return void
	 */
	public function set_template()
	{
		if(isset($_POST['template'])) $this->session->set_userdata('template', array(CFWEBSITEID => $_POST['template']));
		if(isset($_POST['url'])) { ?>
			<script type="text/javascript">
			window.location = '<?php echo $_POST['url']; ?>'
			</script><?php
		}
	}
	
	/**
	 * Get Page Comment
	 *
	 * @access public
	 * @return void
	 */
	public function get_page_comment()
	{
		//Load comment language file
		$this->lang->load('comment');

		if($this->setting->site_comment) {
			if($this->session->userdata('logged_in') == '1') {
				$proceed = true;
			}
			else {
				$proceed = false;
				echo '<div class="error"><p>You must be logged in to post comment.</p></div>';
			}
		}
		else {
			$proceed = true;
		}
		
		if($proceed)
		if(isset($_POST)) {
			if(isset($_POST['name'])) {
				$this->form_validation->set_rules('page_id', lang('page_id'), 'xss_clean|trim|required');
				$this->form_validation->set_rules('name', lang('name'), 'xss_clean|trim|required');
				$this->form_validation->set_rules('email', lang('email'), 'xss_clean|trim|required|valid_email');
				$this->form_validation->set_rules('url', lang('url'), 'xss_clean|trim');
				$this->form_validation->set_rules('comment', lang('comment'), 'xss_clean|trim|required');
				$this->form_validation->set_rules('spam', lang('spam_check'), 'xss_clean|trim|required|callback__captcha_check');
				$this->form_validation->set_rules('page_url', lang('page_url'), 'xss_clean|trim');
				
				if ($this->form_validation->run() == FALSE)
				{
					echo '<div class="error">' . validation_errors() . '</div>';
				}
				else
				{
					$page_id = set_value('page_id');
					if($page_id) {
						$name = set_value('name');
						$email = set_value('email');
						$url = prep_url(set_value('url'));
						$comment = set_value('comment');
						$page_url = set_value('page_url');
						$spam = set_value('spam');
						
						$this->db->insert('page_comment', array('name' => $name, 'page_url' => $page_url, 'email' => $email, 'url' => $url, 'comment' => $comment, 'page_id' => $page_id));
						
						if($this->db->insert_id()) {
							echo "<p>
							You Just Posted: [<em>Subject to approval</em>] <br />
							--------------------------------------------<br />
							name: $name<br />
							email: ***<br />
							url: $url<br />
							comment: " . nl2br($comment) . "<br />
							Time:" . date("d/m/y h:i:s", time()) . "<br />
							check @ pending comment feed above.
							</p>";
						}
					}
					//$this->load->view('formuccess');
				}
				
				
			}
			else {
				if(isset($_POST['page_id']))
					$page_id = preg_replace('/[^0-9]+/', '', $_POST['page_id']);
				else
					$page_id = '0';
				
				$query = $this->db->get_where('page_comment', array('page_id' => $page_id, 'page_comment_status' => '1'));
				$q = $query->result_array();
				
				$c = '';
				if(is_array($q) && count($q) > 0) foreach($q as $v) {
					$c .= "\n" . '<div class="comment"><a name="cmnt'. $v['page_comment_id'] .'"></a>';
					$c .= "\n" . '<p class="comment">' . nl2br($v['comment']) . '</p>';
					$c .= "\n" . '<p class="commenter"><span> ' . date("d/m/y h:i:s", $v['time']) . '</span><span>|</span>';
					$c .= "\n" . '<a rel="external nofollow" href="' . prep_url($v['url']) . '#" target="_blank">' . $v['name'] . '</a></p>';
					$c .= "\n" . '</div>';
				}
				echo $c;
			}
		}
		
	}
	
	/**
	 * Callback From: get_page_comment()
	 *
	 * @access public
	 * @param string
	 * @return bool
	 */
	public function _captcha_check($str)
	{
		$answer = $this->session->userdata('captcha');
		if ($str == $answer)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('_captcha_check', '%s is not correct value at spam check field.');
			return FALSE;
		}
	}
}

/* End of file ajax.php */
/* Location: ./app/frontend/controllers/blog/ajax.php */
?>