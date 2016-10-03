<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo __('Update Website(s)'); ?></h1>
<?php
    $options_active = array('0' => __('Inactive'),
                            '1' => __('Active'));
?>
<?php echo form_open('admin/setting/websites'); ?>
<?php if (isset($_POST['websites'])) { ?>
<div class="group_create">
    <?php foreach ($_POST['websites'] as $k => $v) { ?>
    <label><?php echo __('WEBSITE ID'); ?>:</label><input readonly="readonly"
                                                          name="websites[<?php echo $k; ?>][websites_id]" type="text"
                                                          id="websites_<?php echo $k; ?>_websites_id"
                                                          value="<?php echo $v['websites_id']; ?>"/>
    <p class="clear">&nbsp;</p>
    <label><?php echo __('Website Status'); ?>
        :</label><?php echo form_dropdown('websites[' . $k . '][websites_status]', $options_active, $v['websites_status'], 'class="form-control txtFld"'); ?>
    <p class="clear">&nbsp;</p>
    <label><?php echo __('Website Name'); ?>:</label><input class="form-control txtFld"
                                                            name="websites[<?php echo $k; ?>][websites_name]"
                                                            type="text"
                                                            id="websites_<?php echo $k; ?>_websites_name"
                                                            value="<?php echo $v['websites_name']; ?>"/>
    <p class="clear">&nbsp;</p>
    <label><?php echo __('Website URL'); ?>:</label><input class="form-control txtFld"
                                                           name="websites[<?php echo $k; ?>][websites_url]" type="text"
                                                           id="websites_<?php echo $k; ?>_websites_url"
                                                           value="<?php echo $v['websites_url']; ?>"/>
    <p class="clear">&nbsp;</p>

    <div class="editSeparator">&nbsp;</div>

    <?php } ?>
    <label>&nbsp;</label><input class="btn btn-primary" name="edit" type="submit" id="edit" value="Update"/>&nbsp;<?php echo anchor('admin/setting/websites', __('BACK')); ?>

    <p class="clear">&nbsp;</p>
</div>
<?php } ?>
<?php echo form_close(); ?>

<?php $this->load->view('admin/inc/footer'); ?>
