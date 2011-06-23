<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/inc/template_top'); ?>

	<h1>Update User(s)</h1>
	
	<?php echo form_open('admin/user'); ?>
	<?php if(isset($_POST['user'])) { ?>
		<?php
		$options_active = array('0'  => 'Pending',
							  '1'    => 'Active',
							  '2'   => 'Cancelled');
		$group_ary = $this->db->get('group');
		$g_rslt = $group_ary->result_array();
		$options_group = array();
		foreach($g_rslt as $v){
			$options_group[$v['group_id']] = $v['group_title'];
		}
		?>
	<div class="user_create">
		<?php foreach($_POST['user'] as $k => $v) { ?>
		<label>USER ID:</label><input readonly="readonly" name="user[<?php echo $k; ?>][id]" type="text" id="user_<?php echo $k; ?>_id" value="<?php echo $v['id']; ?>" />
		<p class="clear">&nbsp;</p>
		<label>STATUS:</label>
		<?php echo form_dropdown('user['.$k.'][active]', $options_active, $v['active'], 'class="txtFld"'); ?>
		<p class="clear">&nbsp;</p>
		<label>PASSWORD:</label><input class="txtFld" name="user[<?php echo $k; ?>][password]" type="password" id="user_<?php echo $k; ?>_password" value="" />
		<p class="clear">&nbsp;</p>
		<label>EMAIL:</label><input class="txtFld" name="user[<?php echo $k; ?>][email]" type="text" id="user_<?php echo $k; ?>_email" value="<?php echo $v['email']; ?>" />
		<p class="clear">&nbsp;</p>
		<label>FIRSTNAME:</label><input class="txtFld" name="user[<?php echo $k; ?>][firstname]" type="text" id="user_<?php echo $k; ?>_firstname" value="<?php echo $v['firstname']; ?>" />
		<p class="clear">&nbsp;</p>
		<label>LASTNAME:</label><input class="txtFld" name="user[<?php echo $k; ?>][lastname]" type="text" id="user_<?php echo $k; ?>_lastname" value="<?php echo $v['lastname']; ?>" />
		<p class="clear">&nbsp;</p>
		<label>GROUP:</label>
		<?php echo form_dropdown('user['.$k.'][group_id]', $options_group, $v['group_id'], 'class="txtFld"'); ?>
		
		<p class="clear">&nbsp;</p>
		
		<div class="editSeparator">&nbsp;</div>

		<?php } ?>
		<label>&nbsp;</label><input name="edit" type="submit" id="edit" value="Update" />&nbsp;<?php echo anchor('admin/user','BACK'); ?>
		
		<p class="clear">&nbsp;</p>
	</div>
	<?php } ?>
	<?php echo form_close(); ?>
		
<?php $this->load->view('admin/inc/template_bottom'); ?>
