<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/inc/template_top'); ?>

	<h1>Create New Setting Key</h1>
	
	<?php echo form_open('admin/setting/keys'); ?>
	<?php $form_option = array('textbox'=>'Textbox','textarea'=>'Textarea','select'=>'Select','checkbox'=>'Checkboxes','radio'=>'Radio Buttons') ?>
	<div class="group_create">
		<label>KEY:</label><input class="txtFld" name="setting_key" type="text" id="setting_key" value="<?php echo set_value('setting_key'); ?>" />
		<p class="clear">&nbsp;</p>
		<label>INFO:</label>
		<input name="setting_info" type="text" class="txtFld" id="setting_info" value="<?php echo set_value('setting_info'); ?>" maxlength="100" />
		<p class="clear">&nbsp;</p>
		<label>FORM TYPE:</label><?php echo form_dropdown("setting_form", $form_option, set_value('setting_form'), 'class="txtFld"'); ?>
		<p class="clear">&nbsp;</p>
		<label>OPTIONS:[separated with bar(|)]</label><input class="txtFld" name="setting_option" type="text" id="setting_option" value="<?php echo set_value('setting_option'); ?>" /><br />
		<p class="clear">&nbsp;</p>
		<label>&nbsp;</label><input name="create" type="submit" id="create" value="Create" />&nbsp;<?php echo anchor('admin/setting/key','BACK'); ?>
		<p class="clear">&nbsp;</p>
	</div>
	<?php echo form_close(); ?>
		
<?php $this->load->view('admin/inc/template_bottom'); ?>
