<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo __('Create New Folder'); ?></h1>

<?php echo form_open('admin/file/create-folder'); ?>
<?php
    $options_active = array(
    '0' => __('Disable'),
    '1' => __('Enable')
);

$options_group = array();
foreach ($folder as $v) {
    $options_group[$v['folder_id']] = $v['folder_path'];
}
?>
<div class="file_create">

    <label><?php echo __('STATUS'); ?>:</label>
    <?php echo form_dropdown('active', $options_active, set_value('active'), 'class="txtFld"'); ?>

    <p class="clear">&nbsp;</p>
    <label><?php echo __('PARENT FOLDER'); ?>:</label><?php echo form_dropdown('parent', $options_group,
                                                                                     set_value('parent'), 'class="txtFld"'); ?>
    <p class="clear">&nbsp;</p>

    <label><?php echo __('FOLDER NAME'); ?>:</label><input class="txtFld" name="name" type="text" id="name"
                                      value="<?php echo set_value('name'); ?>"/>

    <p class="clear">&nbsp;</p>

    <label>&nbsp;</label><input name="create" type="submit" id="create" value="Create"/>
    &nbsp;<?php echo anchor('admin/file/manage-folder', __('BACK')); ?>

    <p class="clear">&nbsp;</p>

    <div class="footer_info"><?php echo __('You have used'); ?> <?php echo $this->cf_file_model->disk_free_space(FCPATH . "media/"); ?>
        <?php echo __('of'); ?> <?php echo $this->cf_file_model->disk_total_space(FCPATH . "media/"); ?> <?php echo __('Available space'); ?>.
    </div>
</div>

<?php echo form_close(); ?>

<?php $this->load->view('admin/inc/footer'); ?>
