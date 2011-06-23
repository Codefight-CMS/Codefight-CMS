<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/inc/template_top'); ?>

	<h1>Trim URLs</h1>
	
	<?php echo form_open('admin/trim/trim'); ?>
	
	<div class="trim_create">
		
		<?php
		if(isset($trim))
		{
			echo '<p>Requested URL: '.$url.'</p>';
			echo '<p>Trimed URL: '.$trim.'</p>';
		}
		?>
		
		<label for="longurl">URL to trim</label> <input class="txtFld" type="text" name="longurl" id="longurl">
		<p class="clear">&nbsp;</p>
		
		<label>&nbsp;</label><input name="submit" type="submit" id="submit" value="trim" />&nbsp;<?php echo anchor('admin/trim/trim', 'BACK'); ?>
		
		<p class="clear">&nbsp;</p>
	
	</div>	
	
	<?php echo form_close(); ?>
		
<?php $this->load->view('admin/inc/template_bottom'); ?>
