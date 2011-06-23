<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/inc/template_top'); ?>

	<h1><?php echo ucwords(preg_replace('/\-/',' ',$this->uri->segment(3,'Page Links')));?></h1>

	<?php
	$options_active = array('0'  => 'Inactive',
						  '1'    => 'Active');
	//get menu
	$menu_ary = $this->cf_menu_model->get_menu_array($this->uri->segment(3, 'page'));

	$options_menu = array('0' => 'TOP');
	foreach($menu_ary as $v){
		if($v['menu_title_pull'] != 'N/A') $options_menu[$v['menu_id']] = $v['menu_title_pull'];
	}
	?>
	
	<?php echo form_open('admin/menu/'.$this->uri->segment(3, 'page')); ?>
	<?php if(isset($_POST['menu'])) { ?>
	<div class="menu_create">
		<?php foreach($_POST['menu'] as $k => $v) { ?>

		<label>MENU ID:</label><input readonly="readonly" name="menu[<?php echo $k; ?>][id]" type="text" id="menu_<?php echo $k; ?>_id" value="<?php echo $v['id']; ?>" />
		<p class="clear">&nbsp;</p>
		<label>STATUS:</label>
		<?php echo form_dropdown('menu['.$k.'][menu_active]', $options_active, $v['menu_active'], 'class="txtFld"'); ?>
		<p class="clear">&nbsp;</p>

		<label>PARENT MENU:</label>
		<?php echo form_dropdown('menu['.$k.'][menu_parent_id]', $options_menu, $v['menu_parent_id'], 'class="txtFld"'); ?>
		<p class="clear">&nbsp;</p>

		<label>TITLE:</label><input class="txtFld" name="menu[<?php echo $k; ?>][menu_title]" type="text" id="menu_<?php echo $k; ?>_menu_title" value="<?php echo $v['menu_title']; ?>" />
		<p class="clear">&nbsp;</p>
		
		<label>&nbsp;</label><p>Created Automatically (Enter Only If Linking External Site e.g. http://www.codefight.org/)</p>
		<label>LINK:</label><input class="txtFld" name="menu[<?php echo $k; ?>][menu_link]" type="text" id="menu_<?php echo $k; ?>_menu_link" value="<?php echo $v['menu_link']; ?>" />
		<p class="clear">&nbsp;</p>
		
		<label>SORT:</label><input class="txtFld" name="menu[<?php echo $k; ?>][menu_sort]" type="text" id="menu_<?php echo $k; ?>_menu_sort" value="<?php echo $v['menu_sort']; ?>" />
		<p class="clear">&nbsp;</p>
	
		<label>Show in Websites:</label>
		<p class="clear">&nbsp;</p>
		<?php
		if(isset($websites))
		foreach($websites as $website) {
			if(!is_array($v['websites_id'])) $v['websites_id'] = explode(',',$v['websites_id']);
			
			echo form_checkbox('menu['.$k.'][websites_id]['.$website['websites_id'].']', $website['websites_id'], in_array($website['websites_id'],$v['websites_id'])) . ' ' . $website['websites_name'] . "\n";
			echo '<p class="clear">&nbsp;</p>';
		}
		?>
		<p class="clear">&nbsp;</p>

		<div class="editSeparator">&nbsp;</div>

		<?php } ?>
		<label>&nbsp;</label><input name="edit" type="submit" id="edit" value="Update" />&nbsp;<?php echo anchor('admin/menu/'.$this->uri->segment(3, ''),'BACK'); ?>
		
		<p class="clear">&nbsp;</p>
	</div>
	<?php } ?>
	<?php echo form_close(); ?>
		
<?php $this->load->view('admin/inc/template_bottom'); ?>
