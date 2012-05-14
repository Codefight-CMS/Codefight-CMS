<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo __('Update User(s)'); ?></h1>

<?php echo form_open(current_url()); ?>
<?php if (isset($_POST['user'])) { ?>
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
    <?php foreach ($_POST['user'] as $k => $v) { ?>
    <label><?php echo __('ID'); ?>:</label><input readonly="readonly" name="user[<?php echo $k; ?>][id]"
                                                       type="text"
                                                       id="user_<?php echo $k; ?>_id" value="<?php echo $v['id']; ?>"/>
    <p class="clear">&nbsp;</p>

    <label><?php echo __('Status'); ?>:</label>
    <?php echo form_dropdown('user[' . $k . '][active]', $options_active, $v['active'], 'class="txtFld"'); ?>
    <p class="clear">&nbsp;</p>

    <label><?php echo __('Is Admin'); ?>:</label>
    <?php echo form_dropdown('user[' . $k . '][is_admin]', $yes_no, $v['is_admin'], 'class="txtFld"'); ?>
    <p class="clear">&nbsp;</p>

    <label><?php echo __('Is Author'); ?>:</label>
    <?php echo form_dropdown('user[' . $k . '][is_author]', $yes_no, $v['is_author'], 'class="txtFld"'); ?>
    <p class="clear">&nbsp;</p>

    <label><?php echo __('Password'); ?>:</label><input class="txtFld" name="user[<?php echo $k; ?>][password]"
                                                        type="password"
                                                        id="user_<?php echo $k; ?>_password" value=""/>
    <p class="clear">&nbsp;</p>

    <label><?php echo __('E-mail'); ?>:</label><input class="txtFld" name="user[<?php echo $k; ?>][email]" type="text"
                                                     id="user_<?php echo $k; ?>_email"
                                                     value="<?php echo $v['email']; ?>"/>
    <p class="clear">&nbsp;</p>

    <label><?php echo __('Firstname'); ?>:</label><input class="txtFld" name="user[<?php echo $k; ?>][firstname]"
                                                         type="text"
                                                         id="user_<?php echo $k; ?>_firstname"
                                                         value="<?php echo $v['firstname']; ?>"/>
    <p class="clear">&nbsp;</p>

    <label><?php echo __('Lastname'); ?>:</label><input class="txtFld" name="user[<?php echo $k; ?>][lastname]"
                                                        type="text"
                                                        id="user_<?php echo $k; ?>_lastname"
                                                        value="<?php echo $v['lastname']; ?>"/>
    <p class="clear">&nbsp;</p>

    <label><?php echo __('Profile Link'); ?>:</label><input class="txtFld" name="user[<?php echo $k; ?>][profile_link]"
                                                        type="text"
                                                        id="user_<?php echo $k; ?>_profile_link"
                                                        value="<?php echo $v['profile_link']; ?>"/>
    <p class="clear">&nbsp;</p>

    <label><?php echo __('Group'); ?>:</label>
    <?php echo form_dropdown('user[' . $k . '][group_id]', $options_group, $v['group_id'], 'class="txtFld"'); ?>

    <p class="clear">&nbsp;</p>
    <label><?php echo __('Profile'); ?>:</label>
    <br/>
    <textarea class="txtFld" name="user[<?php echo $k; ?>][profile]" cols="80" rows="15"
              id="user_<?php echo $k; ?>_profile"><?php echo form_prep($v['profile']); ?></textarea>
    <p class="clear">&nbsp;</p><br/>

    <div class="editSeparator">&nbsp;</div>

    <?php } ?>
    <label>&nbsp;</label><input class="btn btn-primary" name="edit" type="submit" id="edit"
                                value="Update"/>&nbsp;<?php echo anchor('admin/user',
                                                                        __('BACK')); ?>

    <p class="clear">&nbsp;</p>
</div>
<?php } ?>
<?php echo form_close(); ?>

<?php $this->load->view('admin/inc/footer'); ?>
