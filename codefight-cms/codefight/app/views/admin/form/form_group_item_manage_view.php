<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/inc/template_top'); ?>

	<h1>Manage Group's Items</h1>
	
	<?php echo form_open('admin/form/group'); ?>
	<?php if(isset($_POST['group'])) { ?>
	<script type="text/javascript">
		//create function to get|edit|delete|add group item
		function get_group_item(act, gID, iID, iSort, niID, niSort) {
			jQuery.post(
				'<?php echo trim(site_url(), '/') ?>/admin/form/ajax',
				{
					action : act,
					group_id : gID,
					item_id : iID,
					item_sort : iSort,
					next_item_id : niID,
					next_item_sort : niSort,
					form_item_grid : iSort
				},
				function(data){
					if(data!=''){
					jQuery('#group_item_display'+gID).html(data);
					}else{
					jQuery('#group_item_display'+gID).html('error');
					}
				}
			);
		}
	</script>
	<div class="group_create">
		<?php
		foreach($_POST['group'] as $k => $v) { 
			echo '<p><strong>ID:</strong> ' . $v['form_group_id'] . ' <br />
			         <strong>Identifier:</strong> ' . $v['form_group_identifier'] . ' <br /> 
					 <strong>Name:</strong> ' . $v['form_group_name'] . ' <br /></p>';
		?>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			//on page load get all group item
			get_group_item('display_all', <?php echo $v['form_group_id'];?>);
		});
	</script>
			
		<p class="clear">&nbsp;</p>
		<p><strong>ITEMS:</strong></p>
		<p class="clear">&nbsp;</p>
		<div id="group_item_display<?php echo $v['form_group_id'];?>">&nbsp;</div>
		<div class="editSeparator">&nbsp;</div>
		
		<?php } ?>
		<label><?php echo anchor('admin/form/group','BACK'); ?></label>
		
		<p class="clear">&nbsp;</p>
	</div>
	<?php } ?>
	<?php echo form_close(); ?>
		
<?php $this->load->view('admin/inc/template_bottom'); ?>
