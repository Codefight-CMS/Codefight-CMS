<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo __('Add New Website'); ?></h1>
<?php
    $options_active = array('0' => __('Inactive'),
                            '1' => __('Active'));
?>
<?php echo form_open('admin/setting/websites'); ?>
<div class="group_create">
    <label><?php echo __('Website Status'); ?>
        :</label><?php echo form_dropdown('websites_status', $options_active, set_value('websites_status'), 'class="txtFld"'); ?>
    <p class="clear">&nbsp;</p>
    <label><?php echo __('Website Name'); ?>:</label>
    <input name="websites_name" type="text" class="txtFld" id="websites_name"
           value="<?php echo set_value('websites_name'); ?>" maxlength="255"/>

    <p class="clear">&nbsp;</p>
    <label><?php echo __('Website URL'); ?>:</label>
    <input name="websites_url" type="text" class="txtFld" id="websites_url"
           value="<?php echo set_value('websites_url'); ?>" maxlength="255"/>

    <p class="clear">&nbsp;</p>
    <label>&nbsp;</label><input name="create" type="submit" id="create" value="Create"/>&nbsp;<?php echo anchor('admin/setting/websites', __('BACK')); ?>
    <p class="clear">&nbsp;</p>
</div>
<?php echo form_close(); ?>

<?php $this->load->view('admin/inc/footer'); ?>
