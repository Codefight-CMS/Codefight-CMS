<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/inc/template_top'); ?>

	<h1>Update Website(s)</h1>
	<?php
	$options_active = array('0'  => 'Inactive',
						  '1'    => 'Active');
	?>
	<?php echo form_open('admin/setting/websites'); ?>
	<?php if(isset($_POST['websites'])) { ?>
	<div class="group_create">
		<?php foreach($_POST['websites'] as $k => $v) { ?>
		<label>WEBSITE ID:</label><input readonly="readonly" name="websites[<?php echo $k; ?>][websites_id]" type="text" id="websites_<?php echo $k; ?>_websites_id" value="<?php echo $v['websites_id']; ?>" />
		<p class="clear">&nbsp;</p>
		<label>Website Status:</label><?php echo form_dropdown('websites['.$k.'][websites_status]', $options_active, $v['websites_status'], 'class="txtFld"'); ?>
		<p class="clear">&nbsp;</p>
		<label>Website Name:</label><input class="txtFld" name="websites[<?php echo $k; ?>][websites_name]" type="text" id="websites_<?php echo $k; ?>_websites_name" value="<?php echo $v['websites_name']; ?>" />
		<p class="clear">&nbsp;</p>
		<label>Website URL:</label><input class="txtFld" name="websites[<?php echo $k; ?>][websites_url]" type="text" id="websites_<?php echo $k; ?>_websites_url" value="<?php echo $v['websites_url']; ?>" />
		<p class="clear">&nbsp;</p>
		
		<div class="editSeparator">&nbsp;</div>
		
		<?php } ?>
		<label>&nbsp;</label><input name="edit" type="submit" id="edit" value="Update" />&nbsp;<?php echo anchor('admin/setting/websites','BACK'); ?>
		
		<p class="clear">&nbsp;</p>
	</div>
	<?php } ?>
	<?php echo form_close(); ?>
		
<?php $this->load->view('admin/inc/template_bottom'); ?>
