<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo __('Form Group'); ?></h1>

<?php echo form_open('admin/form/group'); ?>
<div class="group_grid">
    <table class="table table-striped table-bordered" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo __('Select'); ?></th>
            <th><?php echo __('Name'); ?> (<?php echo __('identifier'); ?>)</th>
            <th><?php echo __('Send To'); ?></th>
        </tr>
        <?php
        if (isset($keys) && is_array($keys) && count($keys) > 0) foreach ($keys as $g)
        {
            //$sort_id = $g['id'] . $g['sort'];
            ?>

            <tr id="<?php echo $g['form_group_id']; ?>">
                <td><input name="select[<?php echo $g['form_group_id']; ?>]" type="checkbox"
                           id="select_<?php echo $g['form_group_id']; ?>" value="<?php echo $g['form_group_id']; ?>"/></td>
                <td><?php echo $g['form_group_name']; ?>
                    (<?php echo $g['form_group_identifier']; ?>)</td>
                <td><?php echo character_limiter($g['form_group_send_to'], 70); ?></td>
            </tr>

            <?php } ?>

    </table>
    <p class="clear">&nbsp;</p>
    <input class="btn btn-primary" name="add_item" type="submit" id="add_item" value="Manage Group Items"/>
    <input class="btn btn-danger" name="delete" type="submit" id="delete" value="Delete Selected"/>
    <input class="btn btn-primary" name="edit" type="submit" id="edit" value="Edit Selected"/>
    <input class="btn btn-primary" name="create" type="submit" id="create" value="Create New"/>
    <input class="btn btn-inverse" name="reset" type="reset" id="reset" value="Reset"/>

    <p class="clear">&nbsp;</p>

</div>
<?php echo form_close(); ?>

<?php $this->load->view('admin/inc/footer'); ?>
