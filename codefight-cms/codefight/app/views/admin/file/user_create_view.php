<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo __('Create New User'); ?></h1>

<?php echo form_open('admin/user'); ?>
<?php
    $options_active = array('0' => __('Pending'),
                            '1' => __('Active'),
                            '2' => __('Cancelled'));
$group_ary = $this->db->get('group');
$g_rslt = $group_ary->result_array();
$options_group = array();
foreach ($g_rslt as $v) {
    $options_group[$v['group_id']] = $v['group_title'];
}
?>
<div class="user_create">

    <label><?php echo __('STATUS'); ?>:</label>
    <?php echo form_dropdown('active', $options_active, set_value('active'), 'class="txtFld"'); ?>

    <p class="clear">&nbsp;</p>
    <label><?php echo __('EMAIL'); ?>:</label><input class="txtFld" name="email" type="text" id="email"
                                value="<?php echo set_value('email'); ?>"/>

    <p class="clear">&nbsp;</p>
    <label><?php echo __('PASSWORD'); ?>:</label><input class="txtFld" name="password" type="password" id="password"/>

    <p class="clear">&nbsp;</p>
    <label><?php echo __('FIRSTNAME'); ?>:</label><input class="txtFld" name="firstname" type="text" id="firstname"
                                    value="<?php echo set_value('firstname'); ?>"/>

    <p class="clear">&nbsp;</p>
    <label><?php echo __('LASTNAME'); ?>:</label><input class="txtFld" name="lastname" type="text" id="lastname"
                                   value="<?php echo set_value('lastname'); ?>"/>

    <p class="clear">&nbsp;</p>
    <label><?php echo __('GROUP'); ?>:</label>
    <?php echo form_dropdown('group_id', $options_group, set_value('group_id'), 'class="txtFld"'); ?>

    <p class="clear">&nbsp;</p>

    <label>&nbsp;</label><input name="create" type="submit" id="create" value="Create"/>
    &nbsp;<?php echo anchor('admin/user', __('BACK')); ?>

    <p class="clear">&nbsp;</p>
</div>

<?php echo form_close(); ?>

<?php $this->load->view('admin/inc/footer'); ?>
