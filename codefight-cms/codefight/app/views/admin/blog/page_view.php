<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/inc/template_top'); ?>
<script>jQuery(document).ready(function() {/*call the tablesorter plugin, the magic happens in the markup*/jQuery("table").tablesorter({widgets: ['zebra']});});</script>
	<h1><?php echo ucwords(preg_replace('/\-/',' ',$this->uri->segment(3,'Static Page')));?></h1>
	
	<?php echo form_open(uri_string()); ?>
	<div class="page_grid">
		<table class="tablesorter" cellspacing="1">             
			<col width="60" align="center" />
			<col />
			<col />
			<thead>
				<tr> 
					<th class="{sorter: 'text'}">Select</th> 
					<th>Title</th> 
					<th>Websites</th> 
				</tr> 
			</thead> 
			<tbody> 
				<?php foreach($page as $g) { ?>
				<tr> 
					<td><input name="select[<?php echo $g['page_id']; ?>]" type="checkbox" id="select_<?php echo $g['page_id']; ?>" value="<?php echo $g['page_id']; ?>" /></td> 
					<td onclick="jQuery('#desc<?php echo $g['page_id']; ?>').slideToggle(500);"><?php echo $g['page_title']; ?><div id="desc<?php echo $g['page_id']; ?>" class="page_grid_heading_description displayNone"><?php echo word_limiter(strip_tags($g['page_body']), 100); ?></div></td> 
					<td><?php echo $this->cf_websites_model->websites_name($g['websites_id']); ?></td> 
				</tr> 
				<?php } ?>
			</tbody> 
		</table>
		<p class="clear">&nbsp;</p>
		<input name="delete" type="submit" id="delete" value="Delete Selected" />
		<input name="edit" type="submit" id="edit" value="Edit Selected" />
		<input name="create" type="submit" id="create" value="Create New Page" />
		<input name="reset" type="reset" id="reset" value="Reset" />
		<p class="clear">&nbsp;</p>
		<?php if(isset($pagination)) echo $pagination; ?>


	</div>
	<?php echo form_close(); ?>
		
<?php $this->load->view('admin/inc/template_bottom'); ?>
