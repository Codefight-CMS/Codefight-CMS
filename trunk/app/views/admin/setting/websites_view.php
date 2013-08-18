<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo __('Websites Manager'); ?></h1>

<?php echo form_open('admin/setting/websites'); ?>
<div class="group_grid">
    <table class="table table-striped table-bordered" cellspacing="1">
        <thead>
        <tr>
            <th><?php echo __('Select'); ?></th>
            <th><?php echo __('Website'); ?></th>
            <th><?php echo __('Website ID'); ?></th>
            <th><?php echo __('Website URL'); ?></th>
            <th><?php echo __('Status'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($websites as $g) { ?>
        <tr>
            <td>
                <input name="select[<?php echo $g['websites_id']; ?>]" type="checkbox" id="select_<?php echo $g['websites_id']; ?>" value="<?php echo $g['websites_id']; ?>"/>
            </td>
            <td>
                <?php echo $g['websites_name']; ?>
            </td>
            <td>
                <?php echo $g['websites_id']; ?>
            </td>
            <td>
                <?php echo $g['websites_url']; ?>
            </td>
            <td>
                <?php echo ($g['websites_status']) ? __('enabled') : __('disabled'); ?>
            </td>
        </tr>
            <?php } ?>
        </tbody>
    </table>
    <p class="clear">&nbsp;</p>
    <input class="btn btn-warning" name="delete" type="submit" id="delete" value="Delete Selected"/>
    <input class="btn btn-primary" name="edit" type="submit" id="edit" value="Edit Selected"/>
    <input class="btn btn-primary" name="create" type="submit" id="create" value="Add New Website"/>
    <input class="btn btn-inverse" name="reset" type="reset" id="reset" value="Reset"/>

    <p class="clear">&nbsp;</p>

</div>
<?php echo form_close(); ?>

<?php $this->load->view('admin/inc/footer'); ?>
