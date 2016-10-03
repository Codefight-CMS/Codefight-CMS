<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo __('Upload New File'); ?></h1>

<?php echo form_open_multipart('admin/file/upload-file'); ?>
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
<div class="file_create">

    <label><?php echo __('STATUS'); ?>:</label>
<?php
        $active = set_value('active');
    if ($active == '') $active = 1;
    ?>
    <?php echo form_dropdown('active', $options_active, $active, 'class="form-control txtFld"'); ?>
    <p class="clear">&nbsp;</p>

    <label><?php echo __('UPLOAD TO'); ?>:</label><?php echo form_dropdown('parent', $options_group, set_value('parent'), 'class="form-control txtFld"'); ?>
    <p class="clear">&nbsp;</p>

    <label><?php echo __('FILE'); ?>:</label><input class="form-control txtFld" name="file" type="file" id="file"/>

    <p class="clear">&nbsp;</p>

    <label><?php echo __('FILE TITLE'); ?>:</label><input class="form-control txtFld" name="name" type="text" id="name"
                                     value="<?php echo set_value('name'); ?>"/>

    <p class="clear">&nbsp;</p>

    <label><?php echo __('FILE DESCRIPTION'); ?>:</label><textarea class="form-control txtFld" cols="35" rows="3" name="description"
                                              id="description"><?php echo set_value('description'); ?></textarea>

    <p class="clear">&nbsp;</p>

    <label><?php echo __('ASSIGN TO'); ?>:</label>
    <table border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="20">
                <input<?php if (set_value('access') == 'all' || set_value('access') == '') echo ' checked="checked"'; ?>
                        name="access" type="radio" id="access_1" value="all"/></td>
            <td><?php echo __('All Users'); ?> (<?php echo __('requires login'); ?>)</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td><input<?php if (set_value('access') == 'public') echo ' checked="checked"'; ?> name="access"
                                                                                               type="radio"
                                                                                               id="access_2"
                                                                                               value="public"/></td>
            <td><?php echo __('Public'); ?></td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td><input<?php if (set_value('access') == 'group') echo ' checked="checked"'; ?> name="access" type="radio"
                                                                                              id="access_3"
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
                echo form_multiselect('group[]', $groups, set_value('group[]'), 'class="form-control txtFld"');
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td><input<?php if (set_value('access') == 'user') echo ' checked="checked"'; ?> name="access" type="radio"
                                                                                             id="access_4"
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
                echo form_multiselect('user[]', $users, set_value('user[]'), 'class="form-control txtFld"');
                ?>
            </td>
        </tr>
    </table>

    <p class="clear">&nbsp;</p>

    <label>&nbsp;</label><input class="btn btn-primary" name="create" type="submit" id="create" value="Upload"/>
    &nbsp;<?php echo anchor('admin/file/manage-file', __('BACK')); ?>

    <p class="clear">&nbsp;</p>
</div>

<?php echo form_close(); ?>

<div class="footer_info"><?php echo __('You have used'); ?> <?php echo Model('file')->disk_free_space(FCPATH . "media/"); ?>
    <?php echo __('of'); ?> <?php echo Model('file')->disk_total_space(FCPATH . "media/"); ?> <?php echo __('Available space'); ?>.
</div>

<?php $this->load->view('admin/inc/footer'); ?>
