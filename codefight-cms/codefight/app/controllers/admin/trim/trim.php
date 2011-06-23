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
 * @package     cf_file
 * @copyright   Copyright (c) 2010 Codefight CMS Team (http://codefight.org)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Admin User Controller
 */
class Trim extends MY_Controller
{
	var $out;
	var $base;
	
	function __construct()
	{
		parent::MY_Controller();
		
		$this->load->helper(array('form','text'));
	}

	function index()
	{
		$url_to_trim = $this->input->post('longurl', TRUE);
		
		//Remove the last slash
		while(substr($url_to_trim, -1) == '/') $url_to_trim = substr($url_to_trim, 0, -1);
		
		//$url_to_trim = prep_url($url_to_trim);
		$error = FALSE;
		$data = array();
		
		if(!empty($url_to_trim) && preg_match('|^https?://|', $url_to_trim))
		{
			$this->config->load('trim.php');
			$this->base = $this->config->item('allowed_chars');

			//check if the client's IP is allowed to trim
			if($_SERVER['REMOTE_ADDR'] != $this->config->item('limit_to_ip'))
			{
				$msg = array('error' => '<p>You are not allowed to trim URLs with this service.</p>');
				set_global_messages($msg, 'error');
				$error = TRUE;
			}

			// check if the URL is valid
			$pos = strpos($url_to_trim, base_url());
			if(($this->config->item('verify_url') && !$error) || ($pos === FALSE))
			{
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url_to_trim);
				curl_setopt($ch,  CURLOPT_RETURNTRANSFER, TRUE);
				$response = curl_exec($ch);
				if(curl_getinfo($ch, CURLINFO_HTTP_CODE) == '404')
				{
					$msg = array('error' => '<p>That is not a valid URL.</p>');
					set_global_messages($msg, 'error');
					$error = TRUE;
				}
				curl_close($ch);
			}

			if(!$error)
			{
				// check if the URL has already been trimed
				$this->db->where('long_url', $url_to_trim);
				$query = $this->db->get('trim');
				$already_trimed = $query->result_array();
				
				if(!empty($already_trimed))
				{
					// URL has already been trimed
					$integer = $already_trimed[0]['trim_id'];
					$trimed_url = $this->_getShortUrl($integer);
				}
				else
				{
					// URL not in database, insert
					$sql = array(
								'long_url' => $url_to_trim,
								'created'  => time(), 
								'creator'  => $_SERVER['REMOTE_ADDR']
								);
					$this->db->insert('trim', $sql);
					$trimed_url = $this->_getShortUrl($this->db->insert_id());
				}
				$data['trim'] = site_url('trim/'.$trimed_url);
				$data['url'] = $url_to_trim;
				
				$msg = array('success' => '<p>URL successfully Trimed.</p>');
				set_global_messages($msg, 'success');
			}
		} elseif(isset($_POST['longurl'])) {
			$msg = array('error' => '<p>Not a valid URL.</p>');
			set_global_messages($msg, 'error');
		}
		
		$assets = array();
		
		//load all required css
		//if media type not defined, screen is default.
		//$assets['css'] = array('admin','swiff','box','upload');
		$assets['css'] = array(
							'all' => array('admin','group','box')
						);
		//load all required js
		$assets['js'] = array('jquery','interface');
		
		$this->cf_asset_lib->load($assets);
		
		$html_string = $this->load->view('admin/trim/trim_view', $data, true);//Get view data in place of sending to browser.
		
		$this->cf_process_lib->view($html_string);
	}

	function _getShortUrl($integer)
	{
		$length = strlen($this->base);
		while($integer > $length - 1)
		{
			$this->out = $this->base[fmod($integer, $length)] . $this->out;
			$integer = floor( $integer / $length );
		}
		return $this->base[$integer] . $this->out;
	}
}