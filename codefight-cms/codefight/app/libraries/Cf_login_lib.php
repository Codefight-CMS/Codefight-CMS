<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cf_login_lib
{
	function check_login($access = array())
	{
		$CI =& get_instance();
		
		if ($CI->session->userdata('logged_in') === '1') {
			
			$data = $CI->session->userdata('loggedData');

			if(in_array($data['group_id'],$access))
			{
				$CI->db->where(array('email' => $data['email'], 'password' => $data['password'], 'group_id' => $data['group_id']));
				$CI->db->where('active', '1');
				$CI->db->from('user');
				$query = $CI->db->count_all_results(); 
	
				if ($query < 1) {
					$CI->session->set_userdata('login_error', '1');
					
					$msg = array('login' => '<p>Some problem caused accessing this page. Please contact us regarding this issue.</p>');
					
					set_global_messages($msg, 'error');
					
					redirect('registration/login');
				}
			}
			else
			{
				$CI->session->set_userdata('login_error', '1');
				$msg = array('login' => '<p>You must have appropriate rights to access secure page.</p>');
				set_global_messages($msg, 'error');
				
				redirect('registration/login');
			}
			
		} else {
			
			$CI->session->set_userdata('login_error', '1');
			$msg = array('login' => '<p>You must be logged in to access secure area.</p>');
			set_global_messages($msg, 'error');
			
			redirect('registration/login');
		}
		//just in case
		$CI->session->set_userdata('redirect', '1');
		
	}

	function process_login($email, $password)
	{
		$CI =& get_instance();
		
		//set where options
		$CI->db->where('email',$email);
		$CI->db->where('password',$password);
		$CI->db->where('active','1');
		
		//query table for the user
		$query = $CI->db->get('user');
		
		//count number of rows
		$numrows = $query->num_rows();
		
		//if count of row == 1
		if ($numrows == 1) {
			
			$data = $query->result_array();
			$CI->session->set_userdata('logged_in', '1');
			
			//set where options to get group title
			$CI->db->where('group_id',$data[0]['group_id']);
			
			//query table for the group title
			$query = $CI->db->get('group');
			
			$g = $query->result_array();
			
			$data[0]['group_title'] = $g[0]['group_title'];
		
			$CI->session->set_userdata('loggedData', $data[0]);
			
			//print_r((($CI)));
			
			redirect($CI->session->userdata('history'));

			return TRUE;
			
		} else {
			
			$CI->session->set_userdata('logged_in', '0');
			
			return FALSE;
			
		}
		
	}
}
?>