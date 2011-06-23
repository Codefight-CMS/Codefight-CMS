<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
//Get Tag Cloud
$cloud = $this->cf_data_model->get_tag_cloud();
if(!empty($cloud)): ?>
	<h2 onclick="jQuery('#tag_cloud').slideToggle(500);">TAG CLOUD:</h2>
	
	<div id="tag_cloud"><?php 
		
		//Shuffle the Cloud
		shuffle($cloud);
		
		//Display Cloud Tags
		foreach($cloud as $c) { ?>
			<a class="<?php echo $c['class']; ?>" href="<?php echo site_url($c['type'] . '/' . 'tag/' . $c['tag']); ?>" title="Total posts for <?php echo trim($c['title']); ?> is <?php echo $c['count']; ?>"><strong><?php echo trim($c['title']); ?></strong></a><?php
		}?>
		
		<p class="clear">&nbsp;</p>

	</div>
<?php endif;?>
