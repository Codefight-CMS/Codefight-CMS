<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo __('User Manager'); ?></h1>

<?php echo form_open('admin/user'); ?>
<div class="user_grid">
    <table class="table table-striped table-bordered" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo __('Select'); ?></th>
            <th><?php echo __('Name'); ?></th>
            <th><?php echo __('E-Mail'); ?></th>
            <th><?php echo __('Group'); ?></th>
        </tr>
        <?php foreach ($user as $g) { ?>
            <tr>
                <td><input name="select[<?php echo $g['user_id']; ?>]" type="checkbox"
                           id="select_<?php echo $g['user_id']; ?>" value="<?php echo $g['user_id']; ?>"/></td>
                <td>
                    <?php if ($g['active'] == '0') {
                    $bulb = 'yellow';
                } else if ($g['active'] == '1') {
                    $bulb = 'green';
                } else {
                    $bulb = 'red';
                } ?>
                    <img
                        src="<?php echo base_url(); ?>assets/admin/img/icon_status_<?php echo $bulb; ?>.gif"
                        alt="<?php echo $bulb; ?>" width="10"
                        height="10"/>&nbsp;<?php echo $g['firstname'] . ' ' . $g['lastname']; ?>
                </td>
                <td><?php echo $g['email']; ?></td>
                <td><?php echo $g['group_title']; ?></td>
            </tr>
            <?php } ?>
    </table>
    <p class="clear">&nbsp;</p>
    <input class="btn btn-danger" name="delete" type="submit" id="delete" value="Delete Selected"/>
    <input class="btn btn-primary" name="edit" type="submit" id="edit" value="Edit Selected"/>
    <input class="btn btn-primary" name="create" type="submit" id="create" value="Create New User"/>
    <input class="btn btn-inverse" name="reset" type="reset" id="reset" value="Reset"/>
</div>
<?php echo form_close(); ?>

<p class="clear">&nbsp;</p>
<nav aria-label="Page navigation">
    <?php if (isset($pagination)) echo $pagination; ?>
</nav>

<?php $this->load->view('admin/inc/footer'); ?>
