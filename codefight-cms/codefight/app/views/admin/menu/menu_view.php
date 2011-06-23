<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/inc/template_top'); ?>

	<h1><?php echo ucwords(preg_replace('/\-/',' ',$this->uri->segment(3,'Page Links')));?></h1>
	
	<?php echo form_open('admin/menu/'.$this->uri->segment(3, 'page')); ?>
	<div class="menu_grid">
		
		<ul id="sortme">
		<li>
			<div class="floatLeft center block borderRightGrey bold menu_grid_heading_chkbox">Select</div>
			<div class="floatLeft center block borderRightGrey bold menu_grid_heading_title">Title</div>
			<div class="floatLeft center block borderRightGrey bold menu_grid_heading_title">Link</div>
			<div class="floatLeft center block bold menu_grid_heading_title">Websites</div>
		</li>
		<?php
		if(isset($menu) && is_array($menu) && count($menu) > 0) foreach($menu as $g)
		{
			//$sort_id = $g['id'] . $g['sort'];
		?>
		
		<li id="<?php echo $g['id']; ?>" class="sortitem">
		  <div class="floatLeft center block borderRightGrey menu_grid_heading_chkbox">
			<input name="select[<?php echo $g['id']; ?>]" type="checkbox" id="select_<?php echo $g['id']; ?>" value="<?php echo $g['id']; ?>" />
		  </div>
			<div class="floatLeft block borderRightGrey menu_grid_heading_title"><?php echo $g['title']; ?></div>			
			<div class="floatLeft block borderRightGrey menu_grid_heading_title"><?php echo $g['url']; if(!preg_match('|http|i',$g['url'])) echo $this->config->item('url_suffix') ?></div>
			<div class="floatLeft block menu_grid_heading_title"><?php echo $this->cf_websites_model->websites_name($g['websites_id']); ?></div>			
		</li>
		
		<?php } ?>
		
		</ul>
		<p class="clear">&nbsp;</p>
		<input name="delete" type="submit" id="delete" value="Delete Selected" />
		<input name="edit" type="submit" id="edit" value="Edit Selected" />
		<input name="create" type="submit" id="create" value="Create New Menu" />
		<input name="reset" type="reset" id="reset" value="Reset" />
		
		

	</div>
	<?php echo form_close(); ?>
		
<?php $this->load->view('admin/inc/template_bottom'); ?>
