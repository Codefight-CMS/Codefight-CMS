<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/inc/template_top'); ?>

	<h1>Create New Form Items</h1>
	
	<?php echo form_open('admin/form/item'); ?>
	<?php $form_option = array('textbox'=>'Textbox','textarea'=>'Textarea','select'=>'Select','multiple_select'=>'Multiple Select','checkbox'=>'Checkboxes','radio'=>'Radio Buttons','file'=>'File Upload','submit'=>'Submit') ?>
	<?php $form_data_option = array('int'=>'int','varchar'=>'varchar(255)','text'=>'text') ?>
	<div class="group_create">
		<label>LABEL:</label>
		<input name="form_item_label" type="text" class="txtFld" id="form_item_label" value="<?php echo set_value('form_item_label'); ?>" maxlength="50" />
		<p class="clear">&nbsp;</p>
		<label>NAME:</label><input class="txtFld" name="form_item_name" type="text" id="form_item_name" value="<?php echo set_value('form_item_name'); ?>" maxlength="50" />
		<p class="clear">&nbsp;</p>
		<label>INPUT TYPE:</label><?php echo form_dropdown("form_item_input_type", $form_option, set_value('form_item_input_type'), 'class="txtFld"'); ?>
		<p class="clear">&nbsp;</p>
		<label>DATA TYPE:</label><?php echo form_dropdown("form_item_data_type", $form_data_option, set_value('form_item_data_type'), 'class="txtFld"'); ?>
		<p class="clear">&nbsp;</p>
		<label>VALIDATIONS</label><input class="txtFld" name="form_item_validations" type="text" id="form_item_validations" value="<?php echo set_value('form_item_validations'); ?>" /><br />
		<p class="clear">&nbsp;</p>
		<label>DEFAULT VALUE</label><input class="txtFld" name="form_item_default_value" type="text" id="form_item_default_value" value="<?php echo set_value('form_item_default_value'); ?>" /><br />
		<p class="clear">&nbsp;</p>
		<label>PARAMETERS</label><textarea class="txtFld" name="form_item_parameters" id="form_item_parameters"><?php echo set_value('form_item_parameters'); ?></textarea><br />
		<p class="clear">&nbsp;</p>
		<label>&nbsp;</label><input name="create" type="submit" id="create" value="Create" />&nbsp;<?php echo anchor('admin/form/item','BACK'); ?>
		<p class="clear">&nbsp;</p>
	</div>
	<?php echo form_close(); ?>
	<p>&nbsp;</p>
	<p>Radios: default values e.g. <strong>m=Male|f=Female</strong></p>
	<p>Checkboxes: Name: <strong>water_elements[]</strong><br />default value e.g. <strong>h=hydrogen|o=oxygen|n=nitrogen</strong></p>
		
<?php $this->load->view('admin/inc/template_bottom'); ?>
