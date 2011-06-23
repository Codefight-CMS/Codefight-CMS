<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/inc/template_top'); ?>

	<h1>Generate New Sitemap</h1>
	
	<?php
	$atts = array(
              'width'      => '400',
              'height'     => '300',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '0',
              'screeny'    => '0'
            );

			echo anchor_popup('tools/sitemap', 'Click Here to generate sitemap.', $atts);
	?>
	
	<p>Once you visit above link sitemap.xml will be updated. If you want to auto update your sitemap you can run a cron to call the updater.</p> 
	<p><strong><?php echo site_url('tools/sitemap') ?></strong></p>
		
<?php $this->load->view('admin/inc/template_bottom'); ?>
