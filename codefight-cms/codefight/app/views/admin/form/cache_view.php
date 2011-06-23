<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/inc/template_top'); ?>

	<h1><?php echo ucwords(preg_replace('/\-/',' ',$this->uri->segment(2,'Site')));?></h1>
	
	<?php echo form_open('admin/setting/'.$this->uri->segment(2, 'site')); ?>
<div class="setting">
		<ul><?php // ?>
			<li>
				<label>Delete Cache</label>
				<label class="lblInner"><input type="radio" name="cache" id="cache" value="1" />&nbsp;YES</label>
				<label class="lblInner"><input name="cache" type="radio" id="cache" value="0" checked="checked" />
				&nbsp;NO</label>
				<p class="clear">&nbsp;</p>
			</li>
			<li>
				<label>Refresh Template Session</label>
				<label class="lblInner"><input type="radio" name="template" id="template" value="1" />&nbsp;YES</label>
				<label class="lblInner"><input name="template" type="radio" id="template" value="0" checked="checked" />
				&nbsp;NO</label>
				<p class="clear">&nbsp;</p>
			</li>
			<li>
				<label>&nbsp;</label>
				<input name="submit" type="submit" id="submit" value="submit" />
			</li>
		</ul>
	</div>
	<?php echo form_close(); ?>
	
<?php $this->load->view('admin/inc/template_bottom'); ?>
