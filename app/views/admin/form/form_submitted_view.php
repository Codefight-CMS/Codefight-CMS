<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo __('Submitted Form'); ?></h1>
<?php $gridTitleList = array(); ?>
<?php echo form_open('admin/form/submitted'); ?>
<div class="group_grid">
    <table class="table table-striped table-bordered" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo __('Select'); ?></th>
            <th><?php echo __('Form'); ?></th>
            <?php
            if (isset($gridTitle) && is_array($gridTitle)) {
                foreach ($gridTitle as $L) {
                    $gridTitleList[$L]['data'] = ''; ?>
                    <th><?php echo strtoupper($L); ?></th>
                    <?php
                }
            } ?>
            <th><?php echo __('Status'); ?></th>
        </tr>
        <?php
        if (isset($submitted) && is_array($submitted) && count($submitted) > 0) foreach ($submitted as $k => $v)
        {
            ?>

            <tr id="<?php echo $k; ?>" class="message<?php echo ($v['status']) ? __('Read') : __('Unread'); ?>">
                <td><input name="select[<?php echo $k; ?>]" type="checkbox" id="select_<?php echo $k; ?>" value="<?php echo $k; ?>"/></td>
                <td><a href="<?php echo site_url('admin/form/submitted/' . $k); ?>"><?php echo $v['group_name']; ?></td>
                <?php
                if (isset($v['list']) && is_array($v['list'])){
                    $list = array_merge($gridTitleList, $v['list']);
                    foreach ($list as $L){ ?>
                        <td><a href="<?php echo site_url('admin/form/submitted/' . $k); ?>"><?php echo $L['data']; ?></a></td>
                        <?php
                    }
                } ?>
                <td><a href="<?php echo site_url('admin/form/submitted/' . $k); ?>"><?php echo ($v['status']) ? '<del>'.__('Read').'</del>' : '<strong>'.__('Unread').'</strong>'; ?></a></td>
            </tr>

            <?php } ?>

    </table>
    <p class="clear">&nbsp;</p>
    <input class="btn btn-danger" name="delete" type="submit" id="delete" value="Delete Selected"/>
    <input class="btn btn-primary" name="unread" type="submit" id="unread" value="Mark as Unread"/>
    <input class="btn btn-primary" name="read" type="submit" id="read" value="Mark as Read"/>
    <input class="btn btn-inverse" name="reset" type="reset" id="reset" value="Reset"/>

    <p class="clear">&nbsp;</p>

</div>
<?php echo form_close(); ?>

<?php $this->load->view('admin/inc/footer'); ?>
