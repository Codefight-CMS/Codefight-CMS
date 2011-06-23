<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/inc/template_top'); ?>

	<h1>File Manager <?php 
		echo form_open('admin/file/file-search-form', array('id'=>'file_search_form')); ?>
		<input name="q" type="text" id="q" value="" />
		<input name="search" type="submit" id="search" value="Search" /><?php
		echo form_close(); ?>
    </h1>
	
	<?php echo form_open_multipart('admin/file/manage-file'); ?>
	<div class="file_grid">
		
		<ul>
		<li>
			<div class="floatLeft center block borderRightGrey bold file_grid_heading_chkbox">SELECT</div>
			<div class="floatLeft center block borderRightGrey bold file_grid_heading_title">Title</div>
			<div class="floatLeft center block borderRightGrey bold file_grid_heading_title">NAME</div>
			<div class="floatLeft center block borderRightGrey bold file_grid_heading_title">FILE URL</div>
			<div class="floatLeft center block borderRightGrey bold file_grid_heading_status">STATUS</div>
		</li>
		<?php foreach($file as $g) { ?>
		<li>
            <div class="floatLeft center block borderRightGrey file_grid_heading_chkbox">
            <input name="select[<?php echo $g['file_id']; ?>]" type="checkbox" id="select_<?php echo $g['file_id']; ?>" value="<?php echo $g['file_id']; ?>" />
            </div>
            <div class="floatLeft block borderRightGrey file_grid_heading_title">&nbsp;<?php echo $g['file_title']; ?></div>
            <div class="floatLeft block borderRightGrey file_grid_heading_title"><a href="<?php echo base_url().$g['file_path'].$g['file_name']; ?>"><?php echo $g['file_name']; ?></a></div>
            <div class="floatLeft block borderRightGrey file_grid_heading_title">&nbsp;[*[BASE_URL]*]<?php echo $g['file_path'].$g['file_name']; ?></div>
            <div class="floatLeft center block borderRightGrey file_grid_heading_status"><?php if($g['file_status'] == '0') {$bulb = 'yellow';} else if($g['file_status'] == '1') {$bulb = 'green';} else {$bulb = 'red';} ?><a href="<?php echo site_url('admin/file/file-status/'.$g['file_id'].'/'.$g['file_status']); ?>"><img src="<?php echo base_url(); ?>assets/admin/img/icon_status_<?php echo $bulb; ?>.gif" alt="<?php echo $bulb; ?>" border="0" width="10" height="10" /></a></div>
		</li>
		<?php } ?>
		</ul>
		<p class="clear">&nbsp;</p>
		<input name="delete" type="submit" id="delete" value="Delete Selected" />
		<input name="create" type="submit" id="create" value="Create New File" />
		<input name="edit" type="submit" id="edit" value="Edit Selected" />
		<input name="reset" type="reset" id="reset" value="Reset" />
		<p class="clear">&nbsp;</p>
		<?php if(isset($pagination)) echo $pagination; ?>
	</div>
	<?php echo form_close(); ?>
    
    <div class="footer_info">You have used <?php echo $this->cf_file_model->disk_free_space(FCPATH . "media/"); ?> of <?php echo $this->cf_file_model->disk_total_space(FCPATH . "media/"); ?> Available space.</div>
		
<?php $this->load->view('admin/inc/template_bottom'); ?>
