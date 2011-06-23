<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
	>menu_id | menu_active | menu_parent_id | menu_link
	>menu_title | menu_type | menu_meta_title | menu_meta_keywords
	>menu_meta_description | menu_sort
	
	Parameters that can be passed in an array:
	$parameters = array (
					'ul_param' => 'class="xyz"...',
					'li_param' => '...',
					'a_param' => '...',
					)

	multi level menu created for codefight cms by damodar bashyal
	visit codefight.org
*/
class Cf_form_lib {
	
	var $CI = '';

	function create($identifiers=array(), $url='') {
		
		//Get instance
		$this->CI =& get_instance();
		$this->CI->load->model('cf_form_mdl');
		$this->CI->load->library('form_validation');
		
		//identifier contains full identifer block and code
		$identifier_blocks = array();
		$identifier_codes = array();
		if(is_array($identifiers) && count($identifiers) == 2) {
			if(isset($identifiers[0]) && isset($identifiers[1]))
			{
				$identifier_blocks = $identifiers[0];
				$identifier_codes = $identifiers[1];
			}
		}
		
		$form_item = array();
		
		foreach($identifier_codes as $k => $v) {
			$form_item[$k]['block'] = $identifier_blocks[$k];
			$form_item[$k]['identifier'] = $v;
			$form_item[$k]['item'] = $this->CI->cf_form_mdl->get_form_item($v);
		}
		
		foreach($form_item as $k => $v) {
			foreach($v['item'] as $l => $w) {
				//if there is a file field form should be multipart
				if($w['form_item_input_type'] == 'file') {
					$form_item[$k]['item'][0]['form_type'] = 'multipart';
				}
				
				//set form element function that to be called
				$fn = '_input_' . $w['form_item_input_type'];
				if (method_exists($this,$fn)) {
					$form_item[$k]['item'][$l]['element'] = $this->$fn($w);
				}
			}
		}
		
		$form_item = $this->_prepare_form($form_item, $url);
		//print_r($form_item);
		
		return $form_item;
	}
	
	//Create textbox form element
	function _input_textbox($val) {
		$rtn = "<label class=\"cf_form_label textbox\">{$val['form_item_label']}</label>";
		$rtn .= "<input name=\"{$val['form_item_name']}\" type=\"textbox\" id=\"{$val['form_item_name']}\" value=\"".$this->_get_post_val($val['form_item_name'], $val['form_item_default_value'])."\" {$val['form_item_parameters']}/>";
		
		return $rtn;
	}
	
	//Create submit button form element
	function _input_submit($val) {
		$rtn = "<label class=\"cf_form_label submit\">&nbsp;</label>";
		$rtn .= "<input name=\"{$val['form_item_name']}\" type=\"submit\" id=\"{$val['form_item_name']}\" value=\"{$val['form_item_label']}\" {$val['form_item_parameters']}/>";
		
		return $rtn;
	}
	
	//Create select dropdown form element
	function _input_select($val) {
		//split options separated with bar
		$options=explode('|',$val['form_item_default_value']);
		$o_array = array();
		foreach($options as $o) {
			//split key and value if separated with =
			$op = explode('=',$o);
			if(count($op)==2) {$opK=$op[0];$opV=$op[1];} else {$opK=$op[0];$opV=$op[0];}
			//store value to options array
			$o_array[$opK]=$opV;
		}
		
		$rtn = "<label class=\"cf_form_label select\">{$val['form_item_label']}</label>";
		$rtn .= form_dropdown($val['form_item_name'], $o_array, $this->_get_post_val($val['form_item_name'], $val['form_item_default_value']), $val['form_item_parameters']. ' id='.$val['form_item_name']);
		
		return $rtn;
	}
	
	//Create radio form element
	function _input_radio($val) {
		$rtn2 = '';
		//split options separated with bar
		$options=explode('|',$val['form_item_default_value']);
		//$o_array = array();
		foreach($options as $o) {
			//split key and value if separated with =
			$op = explode('=',$o);
			if(count($op)==2) {$opK=$op[0];$opV=$op[1];} else {$opK=$op[0];$opV=$op[0];}
			//store value to options array
			$checked = ($opK==$this->_get_post_val($val['form_item_name'], $val['form_item_default_value']))?true:false;
			$o_array=array(
				'name'=>$val['form_item_name'],
				'id'=>$val['form_item_name'],
				'value'=>$opK,
				'checked'=>$checked
				);
				
			$rtn2 .= '<label class="lblInner">'.form_radio($o_array).'&nbsp;'.$opV."</label>\n";
		} 
		
		$rtn = "<label class=\"cf_form_label select\">{$val['form_item_label']}</label>";
		$rtn .= $rtn2;
		
		return $rtn;
	}
	
	//Create radio form element
	function _input_checkbox($val) {
		$rtn2 = '';
		//split options separated with bar
		$options=explode('|',$val['form_item_default_value']);
		//$o_array = array();
		foreach($options as $o) {
			//split key and value if separated with =
			$op = explode('=',$o);
			if(count($op)==2) {$opK=$op[0];$opV=$op[1];} else {$opK=$op[0];$opV=$op[0];}
			//store value to options array
			$posted_val = $this->_get_post_val(str_replace('[]',"[$opK]",$val['form_item_name']), $val['form_item_default_value']);
			$checked = ($opK===$posted_val) ? true : false;
			//echo "chk: ($opK==$posted_val) ";
			$o_array=array(
				'name'=>str_replace('[]',"[$opK]",$val['form_item_name']),
				'id'=>str_replace('[]',"[$opK]",$val['form_item_name']),
				'value'=>$opK,
				'checked'=>$checked
				);
				
			$rtn2 .= '<label class="lblInner">'.form_checkbox($o_array).'&nbsp;'.$opV."</label>\n";
		} 
		
		$rtn = "<label class=\"cf_form_label select\">{$val['form_item_label']}</label>";
		$rtn .= $rtn2;
		
		return $rtn;
	}
	
	//Create textarea form element
	function _input_textarea($val) {
		$rtn = "<label class=\"cf_form_label textarea\">{$val['form_item_label']}</label>";
		$rtn .= "<textarea cols=\"55\" rows=\"5\" name=\"{$val['form_item_name']}\" id=\"{$val['form_item_name']}\" {$val['form_item_parameters']}>".$this->_get_post_val($val['form_item_name'], $val['form_item_default_value']).'</textarea>';
		
		return $rtn;
	}
	
	/*
	 | Check to see if the form is posted
	 | If it is posted value return it
	 | Other wise return default value
	 | That was set in the form item
	 */
	function _get_post_val($name, $value) {
		//get posted value or default value
		//echo "$name - ";
		if(preg_match('#\[(.+)\]#',$name)) {
			$key = preg_replace('#(.+)\[(.+)\]#', "$2", $name);
			$id = preg_replace('#\[(.+)\]#','',$name);
			
			//echo "$id - $key";
			
			//Not sure why it didn't get value of array item, so tried this way.
			if(isset($_POST[$id][$key])) {
				$_POST['array_val'] = $_POST[$id][$key];
				$name = 'array_val';
				//echo ' comes ';
			}
		}
		
		$posted = $this->CI->input->post($name, TRUE);
		
		//print_r("posted: $name-$posted\n");
		
		//if array_val is set above unset it
		if(isset($_POST['array_val'])) unset($_POST['array_val']);
		
		//print_r($posted);
		if(!empty($posted) || $posted == '0')
			return $posted;
		else
			return $value;
	}
	
	function _prepare_form($val, $url) {
		$this->CI->load->helper('form');
		
		foreach($val as $k => $v) {
			$i = 1;
			$form = '';
			foreach($v['item'] as $l => $w) {
				/*open form tag*/
				$attributes = array(
										'name' => $w['form_group_identifier'],
										'id' => $w['form_group_identifier'],
									);
				if($i == 1) {
					if(isset($w['form_type']) && $w['form_type'] == 'multipart')
						$form = form_open_multipart($url, $attributes);//multipart form start tag
					else
						$form = form_open($url, $attributes);//simple form start tag
						
					$form .= '<input type="hidden" name="identifier" id="identifier" value="' . $w['form_group_id'] . '" />';
					$form .= '<div id="message_' . $w['form_group_id'] . '">&nbsp;</div>';
				}
				
				$fn = '_input_' . $w['form_item_input_type'];
				if (isset($w['element'])) {
					$form .= $w['element'] . '<p class="clear">&nbsp;</p>';
				}
				
				if($i == count($v['item'])) $form .= form_close(); //close form
				$i++;
			}
			//save form in the array
			$val[$k]['form'] = $form;
		}
		//return form
		return $val;
	}
}
/*
[form_group_id] =&gt; 1
[form_item_id] =&gt; 3
[form_item_sort] =&gt; 4
[form_group_name] =&gt; Contact Us
[form_group_identifier] =&gt; contact_us
[form_group_send_to] =&gt; dbashyal@xyz.com, dbashyal@abc.com


[form_item_name] =&gt; firstname
[form_item_label] =&gt; First Name
[form_item_input_type] =&gt; textbox
[form_item_validations] =&gt; trim|required
[form_item_default_value] =&gt; Please enter first name
[form_item_parameters] =&gt; onfocus=""
*/
?>