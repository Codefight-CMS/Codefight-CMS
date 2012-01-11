<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo __('Trim URLs'); ?></h1>

<?php echo form_open('admin/trim/trim'); ?>

<div class="trim_create">

    <?php
            if (isset($trim)) {
    echo '<p>' . __('Requested URL') . ': ' . $url . '</p>';
    echo '<p>' . __('Trimed URL') . ': ' . $trim . '</p>';
}
    ?>

    <label for="longurl"><?php echo __('URL to trim'); ?></label> <input class="txtFld" type="text" name="longurl"
                                                                         id="longurl">

    <p class="clear">&nbsp;</p>

    <label>&nbsp;</label><input name="submit" type="submit" id="submit" value="<?php echo __('trim'); ?>"/>&nbsp;
    <?php echo anchor('admin/trim/trim', __('BACK')); ?>

    <p class="clear">&nbsp;</p>

</div>

<?php echo form_close(); ?>

<?php $this->load->view('admin/inc/footer'); ?>
