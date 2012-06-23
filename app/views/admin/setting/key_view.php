<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo __('Setting Manager'); ?></h1>

<?php echo form_open('admin/setting/keys'); ?>
<div class="group_grid">
    <table class="table table-striped table-bordered" cellspacing="1">
        <thead>
        <tr>
            <th><?php echo __('Select'); ?></th>
            <th><?php echo __('Key'); ?></th>
            <th><?php echo __('Info'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($keys as $g) { ?>
        <tr>
            <td>
                <input name="select[<?php echo $g['setting_id']; ?>]" type="checkbox" id="select_<?php echo $g['setting_id']; ?>" value="<?php echo $g['setting_id']; ?>"/>
            </td>
            <td>
                <?php echo $g['setting_key']; ?>
            </td>
            <td>
                <?php echo character_limiter($g['setting_info'], 70); ?>
            </td>
        </tr>
            <?php } ?>
        </tbody>
    </table>
    <p class="clear">&nbsp;</p>
    <input class="btn btn-danger" name="delete" type="submit" id="delete" value="Delete Selected"/>
    <input class="btn btn-primary" name="edit" type="submit" id="edit" value="Edit Selected"/>
    <input class="btn btn-primary" name="create" type="submit" id="create" value="Create New Key"/>
    <input class="btn btn-inverse" name="reset" type="reset" id="reset" value="Reset"/>

    <p class="clear">&nbsp;</p>

</div>
<?php echo form_close(); ?>

<?php $this->load->view('admin/inc/footer'); ?>
