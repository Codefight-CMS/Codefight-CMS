<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/inc/template_top'); ?>

	<h1><?php echo ucwords(preg_replace('/\-/',' ',$this->uri->segment(3,'Page Links')));?></h1>

	<?php
	$options_active = array('0'  => 'Inactive',
						  '1'    => 'Active');

	//get menu
	$options_menu = array('0' => 'TOP');
	
	foreach($menu_array as $v)
	{
		if(!empty($v) && $v['title'] != 'N/A') $options_menu[$v['id']] = $v['title'];
	}
	?>
	
	<?php echo form_open('admin/menu/'.$this->uri->segment(3, 'page')); ?>
	<div class="menu_create">
		<label>STATUS:</label>
		<?php echo form_dropdown('menu_active', $options_active, set_value('menu_active'), 'class="txtFld"'); ?>
		<p class="clear">&nbsp;</p>

		<label>PARENT MENU:</label>
		<?php echo form_dropdown('menu_parent_id', $options_menu, set_value('menu_parent_id'), 'class="txtFld"'); ?>
		<p class="clear">&nbsp;</p>

		<label>TITLE:</label><input class="txtFld" name="menu_title" type="text" id="menu_title" value="<?php echo set_value('menu_title'); ?>" />
		<p class="clear">&nbsp;</p>
		<label>&nbsp;</label><p>Created Automatically (Enter Only If Linking External Site e.g. http://www.codefight.org/)</p>
		<label>LINK:</label><input class="txtFld" name="menu_link" type="text" id="menu_link" value="<?php echo set_value('menu_link'); ?>" />
		<p class="clear">&nbsp;</p>
		
		<label>SORT:</label><input class="txtFld" name="menu_sort" type="text" id="menu_sort" value="<?php echo $this->cf_data_model->get_sort_id('menu'); ?>" />
		<p class="clear">&nbsp;</p>
	
		<label>Show in Websites:</label>
		<p class="clear">&nbsp;</p>
		<?php
		if(isset($websites))
		foreach($websites as $website) {
			echo form_checkbox('websites_id['.$website['websites_id'].']', $website['websites_id'], false) . ' ' . $website['websites_name'] . "\n";
			echo '<p class="clear">&nbsp;</p>';
		}
		?>
		<p class="clear">&nbsp;</p>

		<div class="editSeparator">&nbsp;</div>
		<label>&nbsp;</label><input name="create" type="submit" id="create" value="Create" />&nbsp;<?php echo anchor('admin/menu/'.$this->uri->segment(3, ''),'BACK'); ?>
		<p class="clear">&nbsp;</p>
	</div>
	<?php echo form_close(); ?>
		
<?php $this->load->view('admin/inc/template_bottom'); ?>
