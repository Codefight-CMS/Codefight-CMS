<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo __('Create New Group'); ?></h1>

<?php echo form_open('admin/group'); ?>
<div class="group_create">
    <label><?php echo __('TITLE'); ?>:</label><input class="txtFld" name="title" type="text" id="title"
                                value="<?php echo set_value('title'); ?>"/>

    <p class="clear">&nbsp;</p>
    <label><?php echo __('DESCRIPTION'); ?>:</label>
    <br/>
    <textarea class="txtFld" name="description" cols="35" rows="5"
              id="description"><?php echo set_value('description'); ?></textarea>

    <p class="clear">&nbsp;</p>
    <label>&nbsp;</label><input name="create" type="submit" id="create"
                                value="Create"/>&nbsp;<?php echo anchor('admin/group', __('BACK')); ?>
    <p class="clear">&nbsp;</p>
</div>
<?php echo form_close(); ?>

<?php $this->load->view('admin/inc/footer'); ?>
