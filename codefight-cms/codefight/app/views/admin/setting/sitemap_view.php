<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo __('Generate New Sitemap'); ?></h1>

<ol>
<?php
    $atts = array(
    'width' => '400',
    'height' => '300',
    'scrollbars' => 'yes',
    'status' => 'yes',
    'resizable' => 'yes',
    'screenx' => '0',
    'screeny' => '0'
);

foreach($websites as $v) { ?>
	<li><?php echo anchor_popup("{$v['websites_url']}tools/sitemap", __("Generate sitemap of {$v['websites_name']}."), $atts); ?></li>
	<?php
}
?>
</ol>

<p><?php echo __('Once you visit above link sitemap.xml will be updated. If you want to auto update your sitemap you can run a cron to
    call the updater.'); ?></p>

<ol>
<?php
foreach($websites as $v) { ?>
	<li><p><strong><?php echo "{$v['websites_url']}tools/sitemap"; ?></strong></p></li>
	<?php
}
?>
</ol>

<?php $this->load->view('admin/inc/footer'); ?>
