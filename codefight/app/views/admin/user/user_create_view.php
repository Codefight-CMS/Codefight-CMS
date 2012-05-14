<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo __('Create New User'); ?></h1>

<?php echo form_open('admin/user'); ?>
<?php
    $options_active = array('0' => __('Pending'),
                            '1' => __('Active'),
                            '2' => __('Cancelled'));
    $yes_no = array('0' => __('No'),
                            '1' => __('Yes'));
$group_ary = $this->db->get('group');
$g_rslt = $group_ary->result_array();
$options_group = array();
foreach ($g_rslt as $v) {
    $options_group[$v['group_id']] = $v['group_title'];
}
?>
<div class="user_create">

    <label><?php echo __('Status'); ?>:</label>
    <?php echo form_dropdown('active', $options_active, set_value('active'), 'class="txtFld"'); ?>

    <p class="clear">&nbsp;</p>

    <label><?php echo __('Is Admin'); ?>:</label>
    <?php echo form_dropdown('is_admin', $yes_no, set_value('is_admin'), 'class="txtFld"'); ?>
    <p class="clear">&nbsp;</p>

    <label><?php echo __('Is Author'); ?>:</label>
    <?php echo form_dropdown('is_author', $yes_no, set_value('is_author'), 'class="txtFld"'); ?>
    <p class="clear">&nbsp;</p>

    <label><?php echo __('E-mail'); ?>:</label><input class="txtFld" name="email" type="text" id="email"
                                                     value="<?php echo set_value('email'); ?>"/>

    <p class="clear">&nbsp;</p>
    <label><?php echo __('Password'); ?>:</label><input class="txtFld" name="password" type="password" id="password"/>

    <p class="clear">&nbsp;</p>
    <label><?php echo __('Firstname'); ?>:</label><input class="txtFld" name="firstname" type="text" id="firstname"
                                                         value="<?php echo set_value('firstname'); ?>"/>

    <p class="clear">&nbsp;</p>
    <label><?php echo __('Lastname'); ?>:</label><input class="txtFld" name="lastname" type="text" id="lastname"
                                                        value="<?php echo set_value('lastname'); ?>"/>

    <p class="clear">&nbsp;</p>

    <label><?php echo __('Profile Link'); ?>:</label><input class="txtFld" name="profile_link"
                                                        type="text"
                                                        id="profile_link"
                                                        value="<?php echo set_value('profile_link'); ?>"/>


    <p class="clear">&nbsp;</p>

    <label><?php echo __('Group'); ?>:</label>
    <?php echo form_dropdown('group_id', $options_group, set_value('group_id'), 'class="txtFld"'); ?>

    <p class="clear">&nbsp;</p>
    <label><?php echo __('Profile'); ?>:</label>
    <br/>
    <textarea class="txtFld" name="profile" cols="80" rows="15"
              id="profile"><?php echo form_prep(set_value('profile')); ?></textarea>

	      <p class="clear">&nbsp;</p>

    <label>&nbsp;</label><input class="btn btn-primary" name="create" type="submit" id="create" value="Create"/>
    &nbsp;<?php echo anchor('admin/user', __('BACK')); ?>

    <p class="clear">&nbsp;</p>
</div>

<?php echo form_close(); ?>

<?php $this->load->view('admin/inc/footer'); ?>
