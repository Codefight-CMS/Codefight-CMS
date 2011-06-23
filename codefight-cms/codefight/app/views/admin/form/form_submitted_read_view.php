<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/inc/template_top'); ?>

<?php
foreach($submitted as $k => $v)
{
	?>
	<h1><?php echo $v['group_name']; ?></h1>
	<div class="read_message">
		<ul>
		<?php foreach($v as $item): ?>
		<?php if(is_array($item) && isset($item['label'])): ?>
		<li><strong><?php echo $item['label']; ?>:</strong> <?php echo nl2br($item['data']); ?></li>
		<?php endif; ?>
		<?php endforeach; ?>
		</ul>
		<p class="clear">&nbsp;</p>
		<p>&nbsp;</p>
		<a href="<?php echo site_url('admin/form/submitted'); ?>">&laquo; BACK</a>
	</div>
	<?php
}
?>

<?php $this->load->view('admin/inc/template_bottom'); ?>
