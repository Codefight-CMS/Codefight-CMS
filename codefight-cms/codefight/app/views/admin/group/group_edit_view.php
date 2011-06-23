<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/inc/template_top'); ?>

	<h1>Update Group(s)</h1>
	
	<?php echo form_open('admin/group'); ?>
	<?php if(isset($_POST['group'])) { ?>
	<div class="group_create">
		<?php foreach($_POST['group'] as $k => $v) { ?>
		<label>GROUP ID:</label><input readonly="readonly" name="group[<?php echo $k; ?>][id]" type="text" id="group_<?php echo $k; ?>_id" value="<?php echo $v['id']; ?>" />
		<p class="clear">&nbsp;</p>
		<label>TITLE:</label><input class="txtFld" name="group[<?php echo $k; ?>][title]" type="text" id="group_<?php echo $k; ?>_title" value="<?php echo $v['title']; ?>" />
		<p class="clear">&nbsp;</p>
		<label>DESCRIPTION:</label>
		<br />
		<textarea class="txtFld" name="group[<?php echo $k; ?>][description]" cols="35" rows="5" id="group_<?php echo $k; ?>_description"><?php echo $v['description']; ?></textarea>
		<p class="clear">&nbsp;</p>
		
		<div class="editSeparator">&nbsp;</div>

		<?php } ?>
		<label>&nbsp;</label><input name="edit" type="submit" id="edit" value="Update" />&nbsp;<?php echo anchor('admin/group','BACK'); ?>
		
		<p class="clear">&nbsp;</p>
	</div>
	<?php } ?>
	<?php echo form_close(); ?>
		
<?php $this->load->view('admin/inc/template_bottom'); ?>
