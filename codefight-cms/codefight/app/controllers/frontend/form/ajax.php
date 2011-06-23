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
 * Form Ajax Controller
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
	 * Default method Index
	 *
	 * @access public
	 * @return void
	 */
	public function index()
	{
		$this->load->library('form_validation');
		
		//print_r($_POST);
		$identifier = preg_replace('/[^0-9]+/i', '', $_POST['identifier']);
		//echo $identifier;
		$this->db->select('*');
		$this->db->where('form_item_to_group.form_group_id', $identifier);
		$this->db->from('form_item_to_group');
		$this->db->join('form_item', 'form_item_to_group.form_item_id = form_item.form_item_id');
		$query = $this->db->get();
		$row = $query->result_array();
		
		$email_item = array();
		
		foreach($row as $v)
		{
			//if the post value has default value then unset the post value
			if(isset($_POST[$v['form_item_name']]) && $_POST[$v['form_item_name']] == $v['form_item_default_value'])
				unset($_POST[$v['form_item_name']]);
				
			//set form rules
			if(!in_array($v['form_item_input_type'], array('file','submit','image')))
			{
				$this->form_validation->set_rules($v['form_item_name'], $v['form_item_label'], $v['form_item_validations']);
				$email_item[$v['form_item_name']]['id'] = $v['form_item_id'];
				$email_item[$v['form_item_name']]['label'] = $v['form_item_label'];
				$email_item[$v['form_item_name']]['value'] = $v['form_item_default_value'];
				$email_item[$v['form_item_name']]['datatype'] = $v['form_item_data_type'];
			}
		}
		
		if ($this->form_validation->run() == FALSE)
		{
			echo '<div class="error">'.validation_errors().'</div>';
		}
		else
		{
			$this->db->insert('form_submitted', array('form_group_id'=>$identifier, 'form_status'=>'0'));
			$submitted_id = $this->db->insert_id();
			
			$message = "
Message Received From Web Form
===============================
";
			
			foreach($_POST as $k=>$v)
			{
				$form_data = array('form_submitted_id' => $submitted_id);
				$form_data_type = 'varchar';
				
				//if the POST value's index key is set in array email_item
				if(isset($email_item[$k]))
				{
					$form_data['form_item_id'] = $email_item[$k]['id'];
					$form_data_type = $email_item[$k]['datatype'];
					
					//Get Label Value
					$message .= $email_item[$k]['label'] . ": ";
					//If the default value doesn't have bar | (which is used in radio buttons etcs..)
					//So i.e. if not radio button etc... means 'normal text'
					if(!preg_match('#\|#isU',$email_item[$k]['value']))
					{
						//Then Get the entered message value
						$message .= set_value($k) . "\n";
						$form_data['form_item_data'] = set_value($k);
					}
					else
					{
						//Otherwise, split the default value from bar |
						$splita = split('\|', $email_item[$k]['value']);
						foreach($splita as $sv)
						{
							//The again split from is equal to =
							$splitb = split('=', $sv);
							//Now check the input/selected value and get it, if matched as...
							if(count($splitb)==2 && $splitb[0]==$v) 
							{
								//$message .= $splitb[1].'['.$splitb[0].'=='.$v.']';
								$message .= $splitb[1];
								$form_data['form_item_data'] = $splitb[1];
							}
						}
						$message .= "\n";
					}
				}
				//if it is array, like for checkboxes
				else if(isset($email_item[$k.'[]']))
				{
					if(!isset($form_data['form_item_id']))
					{
						$form_data['form_item_id'] = $email_item[$k.'[]']['id'];
						$form_data_type = $email_item[$k.'[]']['datatype'];
					}
					
					//First Get the Label
					$message .= $email_item[$k.'[]']['label'] . ": ";
					//Split the default value from bar |
					$splita = split('\|', $email_item[$k.'[]']['value']);
					$form_data['form_item_data'] = '';
					foreach($splita as $sv)
					{
						//The again split from is equal to =
						$splitb = split('=', $sv);
						//Now check the input/selected value and get it, if matched as...
						if(count($splitb)==2 && in_array($splitb[0],$v))
						{
							$message .= $splitb[1].',';
							$form_data['form_item_data'] .= $splitb[1].',';
						}
					}
					$message .= "\n";
				}
				
				//Save form data.
				if(isset($form_data['form_item_data'])) $this->db->insert('form_data_'.$form_data_type, $form_data);
			}

			$query = $this->db->get_where('form_group', array('form_group_id' => $identifier));
			$row = $query->result_array();
			
			$settings = $this->cf_setting_model->get_setting();
			if(isset($row[0]['form_group_send_to']))
			{
				$email = explode(',',$row[0]['form_group_send_to']);
				if(count($email) > 0)
				{
					$this->load->library('email');
					$email_sender = 'info@'.$_SERVER['HTTP_HOST'];
					$email_sender_name = $_SERVER['HTTP_HOST'];
					if(isset($settings['email_sender']['setting_value']))
					{
						$email_sender = $settings['email_sender']['setting_value'];
						$email_sender_name = $settings['site_name']['setting_value'];
					}
					
					$this->email->from($email_sender, $email_sender_name);
					
					foreach($email as $e) {
						if($this->form_validation->valid_email($e)) $this->email->to($e);
					}
					//$this->email->cc('another@another-example.com');
					//$this->email->bcc('them@their-example.com');
					
					$this->email->subject('Message from contact us page');
					$this->email->message($message . "\n" . base_url());
					
					$this->email->send();
				}
			}
			
			echo '<div class="success">Form Submitted Successfully.</div>';
		}
	}
}

/* End of file ajax.php */
/* Location: ./app/frontend/controllers/form/ajax.php */
?>