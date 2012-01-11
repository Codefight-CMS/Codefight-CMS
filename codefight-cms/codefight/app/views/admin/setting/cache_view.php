<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo ucwords(preg_replace('/\-/', ' ', $this->uri->segment(3, 'Site')));?></h1>

<?php echo form_open('admin/setting/' . $this->uri->segment(3, 'site')); ?>
<div class="setting">
    <ul><?php // ?>
        <li>
            <label><?php echo __('Delete Cache'); ?></label>
            <label class="lblInner"><input type="radio" name="cache" id="cache"
                                           value="1"/>&nbsp;<?php echo __('YES'); ?></label>
            <label class="lblInner"><input name="cache" type="radio" id="cache" value="0" checked="checked"/>
                &nbsp;<?php echo __('NO'); ?></label>

            <p class="clear">&nbsp;</p>
        </li>
        <li>
            <label><?php echo __('Refresh Template Session'); ?></label>
            <label class="lblInner"><input type="radio" name="template" id="template"
                                           value="1"/>&nbsp;<?php echo __('YES'); ?></label>
            <label class="lblInner"><input name="template" type="radio" id="template" value="0" checked="checked"/>
                &nbsp;<?php echo __('NO'); ?></label>

            <p class="clear">&nbsp;</p>
        </li>
        <li>
            <label>&nbsp;</label>
            <input name="submit" type="submit" id="submit" value="submit"/>
        </li>
    </ul>
</div>
<?php echo form_close(); ?>

<?php $this->load->view('admin/inc/footer'); ?>
