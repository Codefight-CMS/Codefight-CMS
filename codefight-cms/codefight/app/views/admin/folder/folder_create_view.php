<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo __('Create New Folder'); ?></h1>

<?php echo form_open_multipart('admin/folder/create-folder'); ?>
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

    <?php echo form_dropdown('active', $options_active, $active, 'class="txtFld"'); ?>

    <p class="clear">&nbsp;</p>
    <label><?php echo __('PARENT FOLDER'); ?>:</label><?php echo form_dropdown('parent', $options_group,
                                                                                     set_value('parent'), 'class="txtFld"'); ?>
    <p class="clear">&nbsp;</p>

    <label><?php echo __('FOLDER NAME'); ?>:</label><input class="txtFld" name="name" type="text" id="name"
                                      value="<?php echo set_value('name'); ?>"/><em><?php echo __('do not use'); ?> <span style="color:#f00"> \ : / * ? " < | > </span></em>

    <p class="clear">&nbsp;</p>

    <label><?php echo __('THUMBNAIL'); ?>:</label><input class="txtFld" name="file" type="file" id="file"/>

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
                echo form_multiselect('group[]', $groups, set_value('group[]'), 'class="txtFld"');
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
                echo form_multiselect('user[]', $users, set_value('user[]'), 'class="txtFld"');
                ?>
            </td>
        </tr>
    </table>

    <p class="clear">&nbsp;</p>

    <label>&nbsp;</label><input name="create" type="submit" id="create" value="Create"/>
    &nbsp;<?php echo anchor('admin/folder/manage-folder', __('BACK')); ?>

    <p class="clear">&nbsp;</p>


</div>

<?php echo form_close(); ?>

<div class="footer_info"><?php echo __('You have used'); ?> <?php echo $this->cf_file_model->disk_free_space(FCPATH . "media/"); ?>
    <?php echo __('of'); ?> <?php echo $this->cf_file_model->disk_total_space(FCPATH . "media/"); ?> <?php echo __('Available space'); ?>.
</div>

<?php $this->load->view('admin/inc/footer'); ?>
