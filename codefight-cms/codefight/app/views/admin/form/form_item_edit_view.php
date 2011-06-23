<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/inc/template_top'); ?>

	<h1>Update Form Item(s)</h1>
	
	<?php echo form_open('admin/form/item'); ?>
	<?php if(isset($_POST['item'])) { ?>
	<?php $form_option = array('textbox'=>'Textbox','textarea'=>'Textarea','select'=>'Select','multiple_select'=>'Multiple Select','checkbox'=>'Checkboxes','radio'=>'Radio Buttons','file'=>'File Upload','submit'=>'Submit') ?>
	<?php $form_data_option = array('int'=>'int','varchar'=>'varchar(255)','text'=>'text') ?>
	<div class="group_create">
		<?php foreach($_POST['item'] as $k => $v) { ?>
		<label>ID:</label><input readonly="readonly" name="item[<?php echo $k; ?>][form_item_id]" type="text" id="item_<?php echo $k; ?>_form_item_id" value="<?php echo $v['form_item_id']; ?>" />
		<p class="clear">&nbsp;</p>
		<label>LABEL:</label><input class="txtFld" name="item[<?php echo $k; ?>][form_item_label]" type="text" id="item_<?php echo $k; ?>_form_item_label" value="<?php echo $v['form_item_label']; ?>" />
		<p class="clear">&nbsp;</p>
		<label>NAME:</label><input class="txtFld" name="item[<?php echo $k; ?>][form_item_name]" type="text" id="item_<?php echo $k; ?>_form_item_name" value="<?php echo $v['form_item_name']; ?>" />
		<p class="clear">&nbsp;</p>
		<label>INPUT TYPE:</label><?php echo form_dropdown("item[$k][form_item_input_type]", $form_option, $v['form_item_input_type'], 'class="txtFld"'); ?>
		<p class="clear">&nbsp;</p>
		<label>DATA TYPE:</label><?php echo form_dropdown("item[$k][form_item_data_type]", $form_data_option, $v['form_item_data_type'], 'class="txtFld"'); ?>
		<p class="clear">&nbsp;</p>
		<label>VALIDATIONS:</label><input class="txtFld" name="item[<?php echo $k; ?>][form_item_validations]" type="text" id="item_<?php echo $k; ?>_form_item_validations" value="<?php echo $v['form_item_validations']; ?>" />
		<p class="clear">&nbsp;</p>
		<label class="lblclear">DEFAULT VALUE:</label><input class="txtFld" name="item[<?php echo $k; ?>][form_item_default_value]" type="text" id="item_<?php echo $k; ?>_form_item_default_value" value="<?php echo $v['form_item_default_value']; ?>" /><br />
		<p class="clear">&nbsp;</p>
		<label class="lblclear">PARAMETERS:</label><textarea class="txtFld" name="item[<?php echo $k; ?>][form_item_parameters]" id="item_<?php echo $k; ?>_form_item_parameters"><?php echo ($v['form_item_parameters']); ?></textarea><br />
		<p class="clear">&nbsp;</p>
		
		<div class="editSeparator">&nbsp;</div>
		
		<?php } ?>
		<label>&nbsp;</label><input name="edit" type="submit" id="edit" value="Update" />&nbsp;<?php echo anchor('admin/form/item','BACK'); ?>
		
		<p class="clear">&nbsp;</p>
	</div>
	<?php } ?>
	<?php echo form_close(); ?>
	<p>&nbsp;</p>
	<p>Radios: default values e.g. <strong>m=Male|f=Female</strong></p>
	<p>Checkboxes: Name: <strong>water_elements[]</strong><br />default value e.g. <strong>h=hydrogen|o=oxygen|n=nitrogen</strong></p>
		
<?php $this->load->view('admin/inc/template_bottom'); ?>
