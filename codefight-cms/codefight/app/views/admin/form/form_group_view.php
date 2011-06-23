<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/inc/template_top'); ?>

	<h1>Form Group</h1>
	
	<?php echo form_open('admin/form/group'); ?>
	<div class="group_grid">
		
		<ul id="sortme">
		<li>
			<div class="floatLeft center block borderRightGrey bold group_grid_heading_chkbox">SELECT</div>
			<div class="floatLeft center block borderRightGrey bold group_grid_heading_title">NAME (identifier)</div>
			<div class="floatLeft block bold group_grid_heading_description">SEND TO</div>
		</li>
		<?php foreach($keys as $g) { ?>
		<li id="<?php echo $g['form_group_id']; ?>" class="sortitem">
		  <div class="floatLeft center block borderRightGrey group_grid_heading_chkbox">
			<input name="select[<?php echo $g['form_group_id']; ?>]" type="checkbox" id="select_<?php echo $g['form_group_id']; ?>" value="<?php echo $g['form_group_id']; ?>" />
		  </div>
			<div class="floatLeft center block borderRightGrey group_grid_heading_title"><?php echo $g['form_group_name']; ?> (<?php echo $g['form_group_identifier']; ?>)</div>
			<div class="floatLeft block group_grid_heading_description"><?php echo character_limiter($g['form_group_send_to'], 70); ?></div>
		</li>
		<?php } ?>
		</ul>
		<p class="clear">&nbsp;</p>
		<input name="add_item" type="submit" id="add_item" value="Manage Group Items" />
		<input name="delete" type="submit" id="delete" value="Delete Selected" />
		<input name="edit" type="submit" id="edit" value="Edit Selected" />
		<input name="create" type="submit" id="create" value="Create New" />
		<input name="reset" type="reset" id="reset" value="Reset" />
		<p class="clear">&nbsp;</p>		
		
	</div>
	<?php echo form_close(); ?>
		
<?php $this->load->view('admin/inc/template_bottom'); ?>
