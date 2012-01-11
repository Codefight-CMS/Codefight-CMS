<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo __('Submitted Form'); ?></h1>

<?php echo form_open('admin/form/submitted'); ?>
<div class="group_grid">

    <ul id="sortme">
        <li>
            <div class="floatLeft center block borderRightGrey bold group_grid_heading_chkbox"><?php echo __('SELECT'); ?></div>
            <div class="floatLeft center block borderRightGrey bold group_grid_heading_title"><?php echo __('Form'); ?></div>
            <?php if (isset($gridTitle) && is_array($gridTitle)) foreach ($gridTitle as $L): ?>
            <div class="floatLeft center block borderRightGrey bold group_grid_heading_title"><?php echo strtoupper($L); ?></div>
            <?php endforeach; ?>
            <div class="floatLeft block bold group_grid_heading_description"><?php echo __('STATUS'); ?></div>
        </li>
        <?php
                foreach ($submitted as $k => $v)
    {
        ?>
        <li id="<?php echo $k; ?>" class="message<?php echo ($v['status']) ? __('Read') : __('Unread'); ?>">
            <div class="floatLeft center block borderRightGrey group_grid_heading_chkbox">
                <input name="select[<?php echo $k; ?>]" type="checkbox" id="select_<?php echo $k; ?>"
                       value="<?php echo $k; ?>"/>
            </div>
            <div class="floatLeft center block borderRightGrey group_grid_heading_title"><a
                    href="<?php echo site_url('admin/form/submitted/' . $k); ?>"><?php echo $v['group_name']; ?></a>
            </div>
            <?php if (isset($v['list']) && is_array($v['list'])) foreach ($v['list'] as $L): ?>
            <div class="floatLeft center block borderRightGrey group_grid_heading_title"><a
                    href="<?php echo site_url('admin/form/submitted/' . $k); ?>"><?php echo $L['data']; ?></a></div>
            <?php endforeach; ?>
            <div class="floatLeft block group_grid_heading_description"><a
                    href="<?php echo site_url('admin/form/submitted/' . $k); ?>"><?php echo ($v['status'])
                    ? '<del>'.__('Read').'</del>' : '<strong>'.__('Unread').'</strong>'; ?></a></div>
        </li>
        <?php

    }
        ?>
    </ul>
    <p class="clear">&nbsp;</p>
    <input name="delete" type="submit" id="delete" value="Delete Selected"/>
    <input name="unread" type="submit" id="unread" value="Mark as Unread"/>
    <input name="read" type="submit" id="read" value="Mark as Read"/>
    <input name="reset" type="reset" id="reset" value="Reset"/>

    <p class="clear">&nbsp;</p>

</div>
<?php echo form_close(); ?>

<?php $this->load->view('admin/inc/footer'); ?>
