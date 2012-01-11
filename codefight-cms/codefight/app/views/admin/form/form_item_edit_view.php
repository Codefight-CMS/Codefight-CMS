<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo __('Form Item(s)'); ?></h1>

<?php echo form_open('admin/form/item'); ?>
<?php if (isset($_POST['item'])) { ?>
<?php $form_option = array('textbox' => __('Textbox'),
                           'textarea' => __('Textarea'),
                           'select' => __('Select'),
                           'multiple_select' => __('Multiple Select'),
                           'checkbox' => __('Checkboxes'),
                           'radio' => __('Radio Buttons'),
                           'file' => __('File Upload'),
                           'submit' => __('Submit')
    ) ?>
<?php $form_data_option = array('int' => 'int', 'varchar' => 'varchar(255)', 'text' => 'text') ?>
<div class="group_create">
    <?php foreach ($_POST['item'] as $k => $v) { ?>
    <label><?php echo __('ID'); ?>:</label><input readonly="readonly" name="item[<?php echo $k; ?>][form_item_id]" type="text"
                             id="item_<?php echo $k; ?>_form_item_id" value="<?php echo $v['form_item_id']; ?>"/>
    <p class="clear">&nbsp;</p>
    <label><?php echo __('LABEL'); ?>:</label><input class="txtFld" name="item[<?php echo $k; ?>][form_item_label]" type="text"
                                id="item_<?php echo $k; ?>_form_item_label"
                                value="<?php echo $v['form_item_label']; ?>"/>
    <p class="clear">&nbsp;</p>
    <label><?php echo __('NAME'); ?>:</label><input class="txtFld" name="item[<?php echo $k; ?>][form_item_name]" type="text"
                               id="item_<?php echo $k; ?>_form_item_name" value="<?php echo $v['form_item_name']; ?>"/>
    <p class="clear">&nbsp;</p>
    <label><?php echo __('INPUT TYPE'); ?>:</label><?php echo form_dropdown("item[$k][form_item_input_type]", $form_option, $v['form_item_input_type'], 'class="txtFld"'); ?>
    <p class="clear">&nbsp;</p>
    <label><?php echo __('DATA TYPE'); ?>:</label><?php echo form_dropdown("item[$k][form_item_data_type]", $form_data_option, $v['form_item_data_type'], 'class="txtFld"'); ?>
    <p class="clear">&nbsp;</p>
    <label><?php echo __('VALIDATIONS'); ?>:</label><input class="txtFld" name="item[<?php echo $k; ?>][form_item_validations]" type="text"
                                      id="item_<?php echo $k; ?>_form_item_validations"
                                      value="<?php echo $v['form_item_validations']; ?>"/>
    <p class="clear">&nbsp;</p>
    <label class="lblclear"><?php echo __('DEFAULT VALUE'); ?>:</label><input class="txtFld"
                                                         name="item[<?php echo $k; ?>][form_item_default_value]"
                                                         type="text" id="item_<?php echo $k; ?>_form_item_default_value"
                                                         value="<?php echo $v['form_item_default_value']; ?>"/><br/>
    <p class="clear">&nbsp;</p>
    <label class="lblclear"><?php echo __('PARAMETERS'); ?>:</label><textarea class="txtFld"
                                                         name="item[<?php echo $k; ?>][form_item_parameters]"
                                                         id="item_<?php echo $k; ?>_form_item_parameters"><?php echo ($v['form_item_parameters']); ?></textarea>
    <br/>
    <p class="clear">&nbsp;</p>

    <div class="editSeparator">&nbsp;</div>

    <?php } ?>
    <label>&nbsp;</label><input name="edit" type="submit" id="edit"
                                value="Update"/>&nbsp;<?php echo anchor('admin/form/item', __('BACK')); ?>

    <p class="clear">&nbsp;</p>
</div>
<?php } ?>
<?php echo form_close(); ?>
<p>&nbsp;</p>
<p><?php echo __('Radios'); ?>: <?php echo __('default values'); ?> <?php echo __('e.g.'); ?> <strong>m=<?php echo __('Male'); ?>|f=<?php echo __('Female'); ?></strong></p>
<p><?php echo __('Checkboxes'); ?>: <?php echo __('NAME'); ?>: <strong>water_elements[]</strong><br/><?php echo __('DEFAULT VALUE'); ?> <?php echo __('e.g.'); ?>
    <strong>h=<?php echo __('hydrogen'); ?>|o=<?php echo __('oxygen'); ?>|n=<?php echo __('nitrogen'); ?></strong></p>

<?php $this->load->view('admin/inc/footer'); ?>
