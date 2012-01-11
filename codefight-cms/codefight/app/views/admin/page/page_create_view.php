<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo ucwords(preg_replace('/\-/', ' ', $this->uri->segment(3, 'Static Page')));?></h1>

<?php
    $options_active = array('0' => __('Inactive'),
                            '1' => __('Active'));
//get menu
$menu_type = $this->uri->segment(3, 'page');
$menu_ary = $this->cf_menu_model->get_menu_array($menu_type);
$websites_ary = $this->cf_websites_model->get_websites();

$options_websites = array();
foreach ($websites_ary as $v)
{
    if ($v['websites_status']) $options_websites[$v['websites_id']] = $v['websites_name'];
}

$options_menu = array();
foreach ($menu_ary as $v)
{
    if ($v['menu_title_pull'] != 'N/A') $options_menu[$v['menu_id']] = $v['menu_title_pull'];
}

//get group
$options_ary = $this->cf_blog_model->get_group();
$options_group = array();
foreach ($options_ary as $v) {
    $options_group[$v['group_id']] = $v['group_title'];
}

//to make dropdown multiple, we need to workaround as there is no other option in CI 1.6.3
if (!isset($_POST['group_id']) || !is_array($_POST['group_id']) || count($_POST['group_id']) < 2) {
    $_POST['group_id'][] = '1';
    $_POST['group_id'][] = '2';
}
?>

<?php echo form_open('admin/page/' . $this->uri->segment(3, 'page')); ?>
<div class="page_create">
    <div class="left">
        <label><?php echo __('STATUS'); ?>:</label>
        <?php echo form_dropdown('page_active', $options_active, set_value('page_active'), 'class="txtFld"'); ?>
        <p class="clear">&nbsp;</p>

        <label><?php echo __('PAGE ACCESS BY'); ?>:</label>
        <?php echo form_dropdown('group_id[]', $options_group, $_POST['group_id'], 'class="txtFld"'); ?>
        <p class="clear">&nbsp;</p>

        <label><?php echo __('TITLE'); ?>:</label><input class="txtFld" name="page_title" type="text" id="page_title"
                                                         value="<?php echo set_value('page_title'); ?>"/>

        <p class="clear">&nbsp;</p>
    </div>
    <div class="right">
        <label><?php echo __('MENU'); ?>:</label>
        <?php //echo form_dropdown('menu_id', $options_menu, set_value('menu_id'), 'class="txtFld"'); ?>
        <p class="clear">&nbsp;</p>
<?php
            foreach ($options_menu as $ko => $kv) {
        if (!isset($_POST['menu_id'])) $_POST['menu_id'] = array('0');

        echo '<label>' . form_checkbox('menu_id[' . $ko . ']', $ko, in_array($ko, $_POST['menu_id'])) . "&nbsp;$kv</label>\n";
        echo '<p class="clear">&nbsp;</p>';
    } ?>
        <p class="clear">&nbsp;</p>

        <p>&nbsp;</p>
        <label><?php echo __('Websites'); ?>:</label>

        <p class="clear">&nbsp;</p>
<?php
            foreach ($options_websites as $ko => $kv) {
        if (!isset($_POST[' websites_id'])) $_POST[' websites_id'] = array('0');

        echo '<label>' . form_checkbox(' websites_id[' . $ko . ']', $ko, in_array($ko, $_POST[' websites_id'])) . "&nbsp;$kv</label>\n";
        echo '<p class="clear">&nbsp;</p>';
    } ?>
        <p class="clear">&nbsp;</p>
    </div>
    <p class="clear">&nbsp;</p>
    <label><?php echo __('DESCRIPTION'); ?>:</label>
    <br/>
    <textarea class="txtFld" name="page_body" cols="80" rows="15" id="page_body"
              style="width: 80%"><?php echo set_value('page_body'); ?></textarea>

    <p class="clear">&nbsp;</p><br/>

    <label><?php echo __('PUBLISHED DATE'); ?>:</label><input class="txtFld" name="page_date" type="text" id="page_date"
                                                              value="<?php echo date('Y-m-d H:i:s', time()); ?>"/>

    <p class="clear">&nbsp;</p>

    <div style="display:none;">&nbsp;&nbsp;<?php echo __('Show Date'); ?>&nbsp;<input type="checkbox"
                                                                                      value="1"<?php if (set_value('show_date')) {
        echo ' checked="checked"';
    } ?> id="show_date" name="show_date"/>
        <label><?php echo __('AUTHOR'); ?>:</label><input class="txtFld" name="page_author" type="text" id="page_author"
                                                          value="<?php echo set_value('page_author'); ?>"/>&nbsp;&nbsp;<?php echo __('Show Author'); ?>
        &nbsp;<input type="checkbox" value="1"<?php if (set_value('show_author')) {
            echo ' checked="checked"';
        } ?> id="show_author" name="show_author"/>

        <p class="clear">&nbsp;</p>

        <label><?php echo __('ALLOW COMMENTS'); ?>:</label><input type="checkbox"
                                                                  value="1"<?php if (set_value('allow_comment')) {
            echo ' checked="checked"';
        } ?> id="allow_comment" name="allow_comment"/>

        <p class="clear">&nbsp;</p>

        <label><?php echo __('TAGS'); ?>:</label>
        <input name="page_tag" type="text" class="txtFld" id="page_tag" value="<?php //echo set_value('page_tag'); ?>"
               maxlength="255"/>

        <p class="clear">&nbsp;</p>
    </div>

    <label><?php echo __('META TITLE'); ?>:</label><input class="txtFld" name="page_meta_title" type="text"
                                                          id="page_meta_title"
                                                          value="<?php echo set_value('page_meta_title'); ?>"/>

    <p class="clear">&nbsp;</p>

    <label><?php echo __('META KEYWORDS'); ?>:</label><input class="txtFld" name="page_meta_keywords" type="text"
                                                             id="page_meta_keywords"
                                                             value="<?php echo set_value('page_meta_keywords'); ?>"/>

    <p class="clear">&nbsp;</p>

    <label><?php echo __('META DESCRIPTION'); ?>:</label><input class="txtFld" name="page_meta_description" type="text"
                                                                id="page_meta_description"
                                                                value="<?php echo set_value('page_meta_description'); ?>"/>

    <p class="clear">&nbsp;</p>

    <label><?php echo __('SORT'); ?>:</label><input readonly="readonly" class="txtFld" name="page_sort" type="text"
                                                    id="page_sort"
                                                    value="<?php echo $this->cf_data_model->get_sort_id('page'); ?>"/>

    <p class="clear">&nbsp;</p>

    <label>&nbsp;</label><input name="create" type="submit" id="create"
                                value="Create"/>&nbsp;<?php echo anchor('admin/page', __('BACK')); ?>
    <p class="clear">&nbsp;</p>
</div>
<?php echo form_close(); ?>

<?php $this->load->view('admin/inc/footer'); ?>
