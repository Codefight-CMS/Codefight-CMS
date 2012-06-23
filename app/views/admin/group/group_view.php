<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo __('Group Manager'); ?></h1>

<?php echo form_open('admin/group'); ?>
<div class="group_grid">
    <table class="table table-striped table-bordered" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo __('Select'); ?></th>
            <th><?php echo __('Title'); ?></th>
            <th><?php echo __('Description'); ?></th>
        </tr>
        <?php foreach ($group as $g) { ?>
        <tr>
            <td><input name="select[<?php echo $g['group_id']; ?>]" type="checkbox"
                       id="select_<?php echo $g['group_id']; ?>" value="<?php echo $g['group_id']; ?>"/></td>
            <td><?php echo $g['group_title']; ?></td>
            <td><?php echo character_limiter($g['group_description'], 70); ?></td>
        </tr>
        <?php } ?>
    </table>
    <p class="clear">&nbsp;</p>
    <input class="btn btn-danger" name="delete" type="submit" id="delete" value="Delete Selected"/>
    <input class="btn btn-primary" name="edit" type="submit" id="edit" value="Edit Selected"/>
    <input class="btn btn-primary" name="create" type="submit" id="create" value="Create New Group"/>
    <input class="btn btn-inverse" name="reset" type="reset" id="reset" value="Reset"/>

    <p class="clear">&nbsp;</p>
    <?php if (isset($pagination)) echo $pagination; ?>


</div>
<?php echo form_close(); ?>

<?php $this->load->view('admin/inc/footer'); ?>
