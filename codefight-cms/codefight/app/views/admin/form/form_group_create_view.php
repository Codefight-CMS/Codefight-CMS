<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/inc/template_top'); ?>

	<h1>Create New Form Group</h1>
	
	<?php echo form_open('admin/form/group'); ?>
	<div class="group_create">
		<label>NAME:</label>
		<input name="form_group_name" type="text" class="txtFld" id="form_group_name" value="<?php echo set_value('form_group_name'); ?>" maxlength="25" />
		<p class="clear">&nbsp;</p>
		<label>IDENTIFIER:</label><input class="txtFld" name="form_group_identifier" type="text" id="form_group_identifier" value="<?php echo set_value('form_group_identifier'); ?>" maxlength="35" />
		<p class="clear">&nbsp;</p>
		<label>SEND TO:</label><textarea class="txtFld" name="form_group_send_to" id="form_group_send_to"><?php echo set_value('form_group_send_to'); ?></textarea><br />
		<p class="clear">&nbsp;</p>
		<label>&nbsp;</label><input name="create" type="submit" id="create" value="Create" />&nbsp;<?php echo anchor('admin/form/group','BACK'); ?>
		<p class="clear">&nbsp;</p>
	</div>
	<?php echo form_close(); ?>
		
<?php $this->load->view('admin/inc/template_bottom'); ?>
