<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo __('File Manager'); ?> <?php
    echo form_open('admin/file/file-search-form', array('id' => 'file_search_form')); ?>
    <input name="q" type="text" id="q" value=""/>
    <input name="search" type="submit" id="search" value="Search"/><?php
        echo form_close(); ?>
</h1>

<?php echo form_open_multipart('admin/file/manage-file'); ?>
<div class="file_grid">
    <table class="table table-striped table-bordered" cellspacing="1">
        <thead>
        <tr>
            <th><?php echo __('Select'); ?></th>
            <th><?php echo __('Title'); ?></th>
            <th><?php echo __('Name'); ?></th>
            <th><?php echo __('File Url'); ?></th>
            <th><?php echo __('Status'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($file as $g) { ?>
        <tr>
            <td>
                <input name="select[<?php echo $g['file_id']; ?>]" type="checkbox"
                       id="select_<?php echo $g['file_id']; ?>" value="<?php echo $g['file_id']; ?>"/>
            </td>
            <td>
                <?php echo $g['file_title']; ?>
            </td>
            <td>
                <a href="<?php echo base_url() . $g['file_path'] . $g['file_name']; ?>"><?php echo $g['file_name']; ?></a>
            </td>
            <td>
                [*[BASE_URL]*]<?php echo $g['file_path'] . $g['file_name']; ?>
            </td>
            <td>
                <?php if ($g['file_status'] == '0') {
                $bulb = 'yellow';
            } else if ($g['file_status'] == '1') {
                $bulb = 'green';
            } else {
                $bulb = 'red';
            } ?>
                <a href="<?php echo site_url('admin/file/file-status/' . $g['file_id'] . '/' . $g['file_status']); ?>"><img
                    src="<?php echo base_url(); ?>assets/admin/img/icon_status_<?php echo $bulb; ?>.gif"
                    alt="<?php echo $bulb; ?>" border="0" width="10" height="10"/></a>
            </td>
        </tr>
            <?php } ?>
        </tbody>
    </table>
    <p class="clear">&nbsp;</p>
    <input class="btn btn-danger" name="delete" type="submit" id="delete" value="Delete Selected"/>
    <input class="btn btn-primary" name="create" type="submit" id="create" value="Create New File"/>
    <input class="btn btn-primary" name="edit" type="submit" id="edit" value="Edit Selected"/>
    <input class="btn btn-inverse" name="reset" type="reset" id="reset" value="Reset"/>
</div>
<?php echo form_close(); ?>

<p class="clear">&nbsp;</p>
<nav aria-label="Page navigation">
    <?php if (isset($pagination)) echo $pagination; ?>
</nav>

<div class="footer_info"><?php echo __('You have used'); ?> <?php echo Model('file')->disk_free_space(FCPATH . "media/"); ?>
    <?php echo __('of'); ?> <?php echo Model('file')->disk_total_space(FCPATH . "media/"); ?> <?php echo __('Available space'); ?>.
</div>

<?php $this->load->view('admin/inc/footer'); ?>
