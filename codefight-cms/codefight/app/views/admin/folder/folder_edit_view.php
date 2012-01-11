<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo __('Create New Folder'); ?></h1>

<?php echo form_open_multipart('admin/folder/edit-folder'); ?>
<?php
    $options_active = array(
    '0' => __('Disable'),
    '1' => __('Enable')
);

$options_group = array();
foreach ($folder as $v) {
    $options_group[$v['folder_id']] = $v['folder_path'];
}
?>
<?php foreach ($_POST['file'] as $k => $v) { ?>
<div class="file_create">
    <input name="file[<?php echo $k; ?>][id]" type="hidden" id="file_<?php echo $k; ?>_id"
           value="<?php echo $v['id']; ?>"/>
    <label><?php echo __('STATUS'); ?>:</label>
    <?php echo form_dropdown('file[' . $k . '][active]', $options_active, $v['active'], 'class="txtFld"'); ?>
    <p class="clear">&nbsp;</p>

    <input name="file[<?php echo $k; ?>][parent]" type="hidden" id="file_<?php echo $k; ?>_parent"
           value="<?php echo $v['parent']; ?>"/>
    <?php
            /*
		<label>PARENT FOLDER:</label><?php echo form_dropdown('file['.$k.'][parent]', $options_group, $v['parent'], 'class="txtFld"'); ?>
		<p class="clear">&nbsp;</p>
		*/
    ?>

    <label><?php echo __('FOLDER NAME'); ?>:</label><input class="txtFld" name="file[<?php echo $k; ?>][name]" type="text"
                                      id="file_<?php echo $k; ?>_name" value="<?php echo $v['name']; ?>"/><em><?php echo __('do not use'); ?>
    <span style="color:#f00"> \ : / * ? " < | > </span></em>

    <p class="clear">&nbsp;</p>

    <label><?php echo __('THUMBNAIL'); ?>:</label><input class="txtFld" name="file_<?php echo $k; ?>" type="file"
                                    id="file_<?php echo $k; ?>"/>

    <p class="clear">&nbsp;</p>

    <label><?php echo __('ASSIGN TO'); ?>:</label>
    <table border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="20"><input<?php if ($v['access'] == 'all' || $v['access'] == '') echo ' checked="checked"'; ?>
                    name="file[<?php echo $k; ?>][access]" type="radio" id="file_<?php echo $k; ?>_access" value="all"/>
            </td>
            <td><?php echo __('All Users'); ?> (<?php echo __('requires login'); ?>)</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td><input<?php if ($v['access'] == 'public') echo ' checked="checked"'; ?>
                    name="file[<?php echo $k; ?>][access]" type="radio" id="file_<?php echo $k; ?>_access"
                    value="Public"/></td>
            <td><?php echo __('Public'); ?></td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td><input<?php if ($v['access'] == 'group') echo ' checked="checked"'; else $v['group'] = ''; ?>
                    name="file[<?php echo $k; ?>][access]" type="radio" id="file_<?php echo $k; ?>_access"
                    value="group"/></td>
            <td>
                <?php echo __('Selected User Group'); ?>
                <br/>
    <?php
                        $groups = array();
                foreach ($group as $g)
                {
                    $groups[$g['group_id']] = $g['group_title'];
                }
                echo form_multiselect('file[' . $k . '][group][]', $groups, $v['group'], 'class="txtFld"');
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td><input<?php if ($v['access'] == 'user') echo ' checked="checked"'; else $v['user'] = ''; ?>
                    name="file[<?php echo $k; ?>][access]" type="radio" id="file_<?php echo $k; ?>_access"
                    value="user"/></td>
            <td>
                <?php echo __('Selected Users'); ?>
                <br/>
    <?php
                        $users = array();
                foreach ($user as $g)
                {
                    $users[$g['user_id']] = $g['firstname'] . ' ' . $g['lastname'] . ' (' . $g['email'] . ')';
                }
                echo form_multiselect('file[' . $k . '][user][]', $users, $v['user'], 'class="txtFld"');
                ?>
            </td>
        </tr>
    </table>

    <p class="clear">&nbsp;</p>


    <div class="editSeparator">&nbsp;</div>

</div>
<?php } ?>

<label>&nbsp;</label><input name="edit" type="submit" id="edit" value="Update"/>
&nbsp;<?php echo anchor('admin/folder/manage-folder', __('BACK')); ?>

<p class="clear">&nbsp;</p>

<?php echo form_close(); ?>

<div class="footer_info"><?php echo __('You have used'); ?> <?php echo $this->cf_file_model->disk_free_space(FCPATH . "media/"); ?>
    <?php echo __('of'); ?> <?php echo $this->cf_file_model->disk_total_space(FCPATH . "media/"); ?> <?php echo __('Available space'); ?>.
</div>

<?php $this->load->view('admin/inc/footer'); ?>
