<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/inc/template_top'); ?>

	<h1><?php echo ucwords(preg_replace('/\-/',' ',$this->uri->segment(2,'comment')));?></h1>
	
	<?php //echo form_open('comment/'.$this->uri->segment(2, 'pending-comment').'/'.$this->uri->segment(3, false)); ?>
	<?php echo form_open('admin/comment/'.$this->uri->segment(2, '')); ?>
	<div class="comment_grid">
		
		<ul id="sortme">
		<li>
			<div class="floatLeft center block borderRightGrey bold comment_grid_heading_chkbox">SELECT</div>
			<div class="floatLeft center block borderRightGrey bold comment_grid_heading_title">TITLE</div>
		</li>
		<?php foreach($comment as $g) { ?>
		<li id="<?php echo $g['page_comment_id']; ?>" onclick="jQuery('#desc<?php echo $g['page_comment_id']; ?>').slideToggle(500);">
		  <div class="floatLeft center block borderRightGrey comment_grid_heading_chkbox">
			<input name="select[<?php echo $g['page_comment_id']; ?>]" type="checkbox" id="select_<?php echo $g['page_comment_id']; ?>" value="<?php echo $g['page_comment_id']; ?>" />
		  </div>
		  <div class="floatLeft block borderRightGrey comment_grid_heading_title"><?php echo $g['name'] . ' - ' . $g['email']; ?></div>
		  <div id="desc<?php echo $g['page_comment_id']; ?>" class="comment_grid_heading_description"><?php echo '<br /><u>Page:</u><br /><a target="_blank" href="'.$g['page_url'].'">'.$g['page_url'].'</a><br /><u>Comment:</u><br />' . strip_tags($g['comment']); ?></div>
			<p class="clear">&nbsp;</p>
		</li>
		<?php } ?>
		</ul>
		<p class="clear">&nbsp;</p>
		<input name="delete" type="submit" id="delete" value="Delete Selected" />
		<input name="approve" type="submit" id="approve" value="Approve Selected" />
		<input name="reset" type="reset" id="reset" value="Reset" />
		<p class="clear">&nbsp;</p>
		<?php if(isset($pagination)) echo $pagination; ?>
		
		

	</div>
	<?php echo form_close(); ?>
		
<?php $this->load->view('admin/inc/template_bottom'); ?>
