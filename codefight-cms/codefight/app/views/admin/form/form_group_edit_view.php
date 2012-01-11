<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo __('Update Form Group(s)'); ?></h1>

<?php echo form_open('admin/form/group'); ?>
<?php if (isset($_POST['group'])) { ?>
<div class="group_create">
    <?php foreach ($_POST['group'] as $k => $v) { ?>
    <label><?php echo __('ID'); ?>:</label><input readonly="readonly" name="group[<?php echo $k; ?>][form_group_id]" type="text"
                             id="group_<?php echo $k; ?>_form_group_id" value="<?php echo $v['form_group_id']; ?>"/>
    <p class="clear">&nbsp;</p>
    <label><?php echo __('NAME'); ?>:</label><input class="txtFld" name="group[<?php echo $k; ?>][form_group_name]" type="text"
                               id="group_<?php echo $k; ?>_form_group_name"
                               value="<?php echo $v['form_group_name']; ?>"/>
    <p class="clear">&nbsp;</p>
    <label><?php echo __('IDENTIFIER'); ?>:</label><input class="txtFld" name="group[<?php echo $k; ?>][form_group_identifier]" type="text"
                                     id="group_<?php echo $k; ?>_form_group_identifier"
                                     value="<?php echo $v['form_group_identifier']; ?>"/>
    <p class="clear">&nbsp;</p>
    <label><?php echo __('SEND TO'); ?>:</label><input class="txtFld" name="group[<?php echo $k; ?>][form_group_send_to]" type="text"
                                  id="group_<?php echo $k; ?>_form_group_send_to"
                                  value="<?php echo $v['form_group_send_to']; ?>"/>
    <p class="clear">&nbsp;</p>

    <div class="editSeparator">&nbsp;</div>

    <?php } ?>
    <label>&nbsp;</label><input name="edit" type="submit" id="edit"
                                value="Update"/>&nbsp;<?php echo anchor('admin/form/group', __('BACK')); ?>

    <p class="clear">&nbsp;</p>
</div>
<?php } ?>
<?php echo form_close(); ?>

<?php $this->load->view('admin/inc/footer'); ?>
