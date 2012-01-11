<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo __('Create New Setting Key'); ?></h1>

<?php echo form_open('admin/setting/keys'); ?>
<?php $form_option = array(
    'textbox' => __('Textbox'),
    'textarea' => __('Textarea'),
    'select' => __('Select'),
    'checkbox' => __('Checkboxes'),
    'radio' => __('Radio Buttons')
) ?>
<div class="group_create">
    <label><?php echo __('KEY'); ?>:</label><input class="txtFld" name="setting_key" type="text" id="setting_key"
                                                   value="<?php echo set_value('setting_key'); ?>"/>

    <p class="clear">&nbsp;</p>
    <label><?php echo __('INFO'); ?>:</label>
    <input name="setting_info" type="text" class="txtFld" id="setting_info"
           value="<?php echo set_value('setting_info'); ?>" maxlength="100"/>

    <p class="clear">&nbsp;</p>
    <label><?php echo __('FORM TYPE'); ?>:</label><?php echo form_dropdown("setting_form", $form_option,
                                                                           set_value('setting_form'), 'class="txtFld"'); ?>
    <p class="clear">&nbsp;</p>
    <label><?php echo __('OPTIONS'); ?>:[<?php echo __('separated with bar'); ?>(|)]</label><input class="txtFld"
                                                                                                   name="setting_option"
                                                                                                   type="text"
                                                                                                   id="setting_option"
                                                                                                   value="<?php echo set_value('setting_option'); ?>"/><br/>

    <p class="clear">&nbsp;</p>
    <label>&nbsp;</label><input name="create" type="submit" id="create" value="Create"/>&nbsp;<?php echo anchor('admin/setting/key', __('BACK')); ?>
    <p class="clear">&nbsp;</p>
</div>
<?php echo form_close(); ?>

<?php $this->load->view('admin/inc/footer'); ?>
