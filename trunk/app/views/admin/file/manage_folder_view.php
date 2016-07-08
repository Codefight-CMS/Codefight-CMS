<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo __('FOLDER'); ?> Manager</h1>

<?php echo form_open('admin/file/manage-folder'); ?>
<div class="file_grid">

    <ul>
        <li>
            <div class="floatLeft center block borderRightGrey bold file_grid_heading_chkbox"><?php echo __('SELECT'); ?></div>
            <div class="floatLeft center block borderRightGrey bold file_grid_heading_title"><?php echo __('FOLDER'); ?></div>
            <div class="floatLeft center block borderRightGrey bold file_grid_heading_status"><?php echo __('STATUS'); ?></div>
            <div class="floatLeft center block borderRightGrey bold file_grid_heading_status"><?php echo __('FILE COUNT'); ?></div>
        </li>
        <?php foreach ($folder as $g) { ?>
        <li>
            <div class="floatLeft center block borderRightGrey file_grid_heading_chkbox">
                <input name="select[<?php echo $g['folder_id']; ?>]" type="checkbox"
                       id="select_<?php echo $g['folder_id']; ?>" value="<?php echo $g['folder_id']; ?>"/>
            </div>
            <div class="floatLeft block borderRightGrey file_grid_heading_title">
                &nbsp;<?php echo $g['folder_path']; ?></div>
            <div class="floatLeft center block borderRightGrey file_grid_heading_status"><?php if ($g['folder_status'] == '0') {
                $bulb = 'yellow';
            } else if ($g['folder_status'] == '1') {
                $bulb = 'green';
            } else {
                $bulb = 'red';
            } ?>
                <a href="<?php echo site_url('admin/file/folder-status/' . $g['folder_id'] . '/' . $g['folder_status']); ?>"><img
                        src="<?php echo base_url(); ?>assets/admin/img/icon_status_<?php echo $bulb; ?>.gif"
                        alt="<?php echo $bulb; ?>" border="0" width="10" height="10"/></a></div>
            <div class="floatLeft center block borderRightGrey file_grid_heading_status"><a
                    href="<?php echo site_url('admin/file/search-file/' . $g['folder_id']); ?>"><?php echo Model('file')->get_file_count($g['folder_id']); ?></a>
            </div>
        </li>
        <?php } ?>
    </ul>
    <p class="clear">&nbsp;</p>
    <input class="btn btn-primary" name="create" type="submit" id="create" value="Create New Folder"/>
    <input class="btn btn-inverse" name="reset" type="reset" id="reset" value="Reset"/>

    <p class="clear">&nbsp;</p>
    <?php if (isset($pagination)) echo $pagination; ?>

    <div class="footer_info"><?php echo __('You have used'); ?> <?php echo Model('file')->disk_free_space(FCPATH . "media/"); ?>
        <?php echo __('of'); ?> <?php echo Model('file')->disk_total_space(FCPATH . "media/"); ?> <?php echo __('Available space'); ?>.
    </div>
</div>
<?php echo form_close(); ?>

<?php $this->load->view('admin/inc/footer'); ?>
