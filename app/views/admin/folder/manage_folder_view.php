<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo __('Folder'); ?> <?php echo __('Manager'); ?></h1>

<?php echo form_open('admin/folder/manage-folder'); ?>
<div class="file_grid">
    <table class="table table-striped table-bordered" cellspacing="1">
        <thead>
        <tr>
            <th><?php echo __('Select'); ?></th>
            <th><?php echo __('Folder'); ?></th>
            <th><?php echo __('Status'); ?></th>
            <th><?php echo __('File Count'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($folder as $g) { ?>
        <tr>
            <td>
                <input name="select[<?php echo $g['folder_id']; ?>]" type="checkbox" id="select_<?php echo $g['folder_id']; ?>" value="<?php echo $g['folder_id']; ?>"/>
            </td>
            <td>
                <?php echo $g['folder_path']; ?>
            </td>
            <td>
                <?php if ($g['folder_status'] == '0') {
                $bulb = 'yellow';
            } else if ($g['folder_status'] == '1') {
                $bulb = 'green';
            } else {
                $bulb = 'red';
            } ?>
                <a href="<?php echo site_url('admin/folder/folder-status/' . $g['folder_id'] . '/' . $g['folder_status']); ?>">
                    <img src="<?php echo base_url(); ?>assets/admin/img/icon_status_<?php echo $bulb; ?>.gif" alt="<?php echo $bulb; ?>" border="0" width="10" height="10"/>
                </a>
            </td>
            <td>
                <a href="<?php echo site_url('admin/folder/search-file/' . $g['folder_id']); ?>"><?php echo Model('file')->get_file_count($g['folder_id']); ?></a>
            </td>
        </tr>
            <?php } ?>
        </tbody>
    </table>
    <p class="clear">&nbsp;</p>
    <input class="btn btn-primary" name="create" type="submit" id="create" value="Create New Folder"/>
    <input class="btn btn-primary" name="edit" type="submit" id="edit" value="Edit Folder"/>
    <input class="btn btn-inverse" name="reset" type="reset" id="reset" value="Reset"/>

    <p class="clear">&nbsp;</p>
    <?php if (isset($pagination)) echo $pagination; ?>

    <div class="footer_info"><?php echo __('You have used'); ?> <?php echo Model('file')->disk_free_space(FCPATH . "media/"); ?>
        <?php echo __('of'); ?> <?php echo Model('file')->disk_total_space(FCPATH . "media/"); ?> <?php echo __('Available space'); ?>.
    </div>
</div>
<?php echo form_close(); ?>

<?php $this->load->view('admin/inc/footer'); ?>
