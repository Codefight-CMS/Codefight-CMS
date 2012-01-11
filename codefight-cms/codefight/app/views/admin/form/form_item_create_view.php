<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo __('Create New Form Items'); ?></h1>

<?php echo form_open('admin/form/item'); ?>
<?php $form_option =
        array(
            'textbox' => __('Textbox'),
            'textarea' => __('Textarea'),
            'select' => __('Select'),
            'multiple_select' => __('Multiple Select'),
            'checkbox' => __('Checkboxes'),
            'radio' => __('Radio Buttons'),
            'file' => __('File Upload'),
            'submit' => __('Submit')
        ) ?>
<?php $form_data_option =
        array(
            'int' => 'int',
            'varchar' => 'varchar(255)',
            'text' => 'text'
        ) ?>
<div class="group_create">
    <label><?php echo __('LABEL'); ?>:</label>
    <input name="form_item_label" type="text" class="txtFld" id="form_item_label"
           value="<?php echo set_value('form_item_label'); ?>" maxlength="50"/>

    <p class="clear">&nbsp;</p>
    <label><?php echo __('NAME'); ?>:</label><input class="txtFld" name="form_item_name" type="text" id="form_item_name"
                               value="<?php echo set_value('form_item_name'); ?>" maxlength="50"/>

    <p class="clear">&nbsp;</p>
    <label><?php echo __('INPUT TYPE'); ?>:</label><?php echo form_dropdown("form_item_input_type", $form_option, set_value('form_item_input_type'), 'class="txtFld"'); ?>
    <p class="clear">&nbsp;</p>
    <label><?php echo __('DATA TYPE'); ?>:</label><?php echo form_dropdown("form_item_data_type", $form_data_option, set_value('form_item_data_type'), 'class="txtFld"'); ?>
    <p class="clear">&nbsp;</p>
    <label><?php echo __('VALIDATIONS'); ?></label><input class="txtFld" name="form_item_validations" type="text" id="form_item_validations"
                                     value="<?php echo set_value('form_item_validations'); ?>"/><br/>

    <p class="clear">&nbsp;</p>
    <label><?php echo __('DEFAULT VALUE'); ?></label><input class="txtFld" name="form_item_default_value" type="text"
                                       id="form_item_default_value"
                                       value="<?php echo set_value('form_item_default_value'); ?>"/><br/>

    <p class="clear">&nbsp;</p>
    <label><?php echo __('PARAMETERS'); ?></label><textarea class="txtFld" name="form_item_parameters"
                                       id="form_item_parameters"><?php echo set_value('form_item_parameters'); ?></textarea><br/>

    <p class="clear">&nbsp;</p>
    <label>&nbsp;</label><input name="create" type="submit" id="create"
                                value="Create"/>&nbsp;<?php echo anchor('admin/form/item', __('BACK')); ?>
    <p class="clear">&nbsp;</p>
</div>
<?php echo form_close(); ?>
<p>&nbsp;</p>
<p><?php echo __('Radios'); ?>: <?php echo __('default values'); ?> <?php echo __('e.g.'); ?> <strong>m=<?php echo __('Male'); ?>|f=<?php echo __('Female'); ?></strong></p>
<p><?php echo __('Checkboxes'); ?>: <?php echo __('NAME'); ?>: <strong>water_elements[]</strong><br/><?php echo __('DEFAULT VALUE'); ?> <?php echo __('e.g.'); ?>
    <strong>h=<?php echo __('hydrogen'); ?>|o=<?php echo __('oxygen'); ?>|n=<?php echo __('nitrogen'); ?></strong></p>

<?php $this->load->view('admin/inc/footer'); ?>
