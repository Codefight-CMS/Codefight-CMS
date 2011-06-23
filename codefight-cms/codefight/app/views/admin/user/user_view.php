<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/inc/template_top'); ?>

	<h1>User Manager</h1>
	
	<?php echo form_open('admin/user'); ?>
	<div class="user_grid">
		
		<ul>
		<li>
			<div class="floatLeft center block borderRightGrey bold user_grid_heading_chkbox">SELECT</div>
			<div class="floatLeft center block borderRightGrey bold user_grid_heading_title">NAME</div>
			<div class="floatLeft center block borderRightGrey bold user_grid_heading_title">EMAIL</div>
			<div class="floatLeft block bold user_grid_heading_description">Group</div>
		</li>
		<?php foreach($user as $g) { ?>
		<li>
		  <div class="floatLeft center block borderRightGrey user_grid_heading_chkbox">
			<input name="select[<?php echo $g['user_id']; ?>]" type="checkbox" id="select_<?php echo $g['user_id']; ?>" value="<?php echo $g['user_id']; ?>" />
		  </div>
		  	<?php if($g['active'] == '0') {$bulb = 'yellow';} else if($g['active'] == '1') {$bulb = 'green';} else {$bulb = 'red';} ?>
			<div class="floatLeft center block borderRightGrey user_grid_heading_title"><img src="<?php echo base_url(); ?>assets/admin/img/icon_status_<?php echo $bulb; ?>.gif" alt="<?php echo $bulb; ?>" width="10" height="10" />&nbsp;<?php echo $g['firstname'] . ' ' . $g['lastname']; ?></div>
			<div class="floatLeft center block borderRightGrey user_grid_heading_title"><?php echo $g['email']; ?></div>
			<div class="floatLeft block user_grid_heading_description"><?php echo $g['group_title']; ?></div>
		</li>
		<?php } ?>
		</ul>
		<p class="clear">&nbsp;</p>
		<input name="delete" type="submit" id="delete" value="Delete Selected" />
		<input name="edit" type="submit" id="edit" value="Edit Selected" />
		<input name="create" type="submit" id="create" value="Create New User" />
		<input name="reset" type="reset" id="reset" value="Reset" />
		<p class="clear">&nbsp;</p>
		<?php if(isset($pagination)) echo $pagination; ?>
		

	</div>
	<?php echo form_close(); ?>
		
<?php $this->load->view('admin/inc/template_bottom'); ?>
