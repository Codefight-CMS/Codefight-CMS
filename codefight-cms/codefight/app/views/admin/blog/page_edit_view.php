<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo ucwords(preg_replace('/\-/', ' ', $this->uri->segment(3, __('Blog Page'))));?></h1>
<?php
    $options_active = array('0' => __('Inactive'),
                            '1' => __('Active'));

//get menu
$menu_type = $this->uri->segment(3, 'blog');
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
?>

<?php echo form_open('admin/page/' . $this->uri->segment(3, 'blog')); ?>
<?php if (isset($_POST['page'])) { ?>
<div class="page_create">
    <?php foreach ($_POST['page'] as $k => $v) { ?>
    <div class="left">
        <label><?php echo __('PAGE ID') ?>:</label><input class="txtFld" readonly="readonly"
                                                          name="page[<?php echo $k; ?>][id]" type="text"
                                                          id="page_<?php echo $k; ?>_id"
                                                          value="<?php echo $v['id']; ?>"/>

        <p class="clear">&nbsp;</p>

        <label><?php echo __('STATUS') ?>:</label>
        <?php echo form_dropdown('page[' . $k . '][page_active]', $options_active, $v['page_active'], 'class="txtFld"'); ?>
        <p class="clear">&nbsp;</p>

        <label><?php echo __('PAGE ACCESS BY') ?>:</label>
        <?php echo form_dropdown('page[' . $k . '][group_id][]', $options_group, $v['group_id'], 'class="txtFld"'); ?>
        <p class="clear">&nbsp;</p>

        <label><?php echo __('TITLE') ?>:</label><input class="txtFld" name="page[<?php echo $k; ?>][page_title]"
                                                        type="text" id="page_<?php echo $k; ?>_page_title"
                                                        value="<?php echo $v['page_title']; ?>"/>

        <p class="clear">&nbsp;</p>
    </div>
    <div class="right">
        <label><?php echo __('MENU') ?>:</label>

        <p class="clear">&nbsp;</p>
        <?php
                    foreach ($options_menu as $ko => $kv) {
        if (!is_array($v['menu_id'])) $v['menu_id'] = explode(',', $v['menu_id']);

        echo '<label>' . form_checkbox('page[' . $k . '][menu_id][' . $ko . ']', $ko, in_array($ko, $v['menu_id'])) . "&nbsp;$kv</label>\n";
        echo '<p class="clear">&nbsp;</p>';
    }
        ?>
        <p class="clear">&nbsp;</p>

        <p>&nbsp;</p>

        <label><?php echo __('WEBSITES') ?>:</label>

        <p class="clear">&nbsp;</p>
        <?php
                    foreach ($options_websites as $ko => $kv) {
        if (!is_array($v['websites_id'])) $v['websites_id'] = explode(',', $v['websites_id']);

        echo '<label>' . form_checkbox('page[' . $k . '][websites_id][' . $ko . ']', $ko, in_array($ko, $v['websites_id'])) . "&nbsp;$kv</label>\n";
        echo '<p class="clear">&nbsp;</p>';
    }
        ?>
        <p class="clear">&nbsp;</p>
    </div>
    <p class="clear">&nbsp;</p>
    <label><?php echo __('DESCRIPTION') ?>:</label>
    <br/>
    <textarea class="txtFld" name="page[<?php echo $k; ?>][page_body]" cols="80" rows="15"
              id="page_<?php echo $k; ?>_page_body"><?php echo form_prep($v['page_body']); ?></textarea>
    <p class="clear">&nbsp;</p><br/>

    <label><?php echo __('AUTHOR') ?>:</label><input class="txtFld" name="page[<?php echo $k; ?>][page_author]"
                                                     type="text" id="page_<?php echo $k; ?>_page_author"
                                                     value="<?php echo $v['page_author']; ?>"/>&nbsp;
    &nbsp;<?php echo __('Show Author') ?>&nbsp;<input type="checkbox" value="1"<?php if ($v['show_author']) {
        echo ' checked="checked"';
    } ?> id="page[<?php echo $k; ?>][show_author]" name="page[<?php echo $k; ?>][show_author]"/>
    <p class="clear">&nbsp;</p>

    <label><?php echo __('PUBLISHED DATE') ?>:</label><input class="txtFld" name="page[<?php echo $k; ?>][page_date]"
                                                             type="text" id="page_<?php echo $k; ?>_page_date"
                                                             value="<?php echo $v['page_date']; ?>"/>&nbsp;
    &nbsp;<?php echo __('Show Date') ?>&nbsp;<input type="checkbox" value="1"<?php if ($v['show_date']) {
        echo ' checked="checked"';
    } ?> id="page_<?php echo $k; ?>_show_date" name="page[<?php echo $k; ?>][show_date]"/>
    <p class="clear">&nbsp;</p>

    <label><?php echo __('ALLOW COMMENTS') ?>:</label><input type="checkbox" value="1"<?php if ($v['allow_comment']) {
        echo ' checked="checked"';
    } ?> id="page_<?php echo $k; ?>_allow_comment" name="page[<?php echo $k; ?>][allow_comment]"/>
    <p class="clear">&nbsp;</p>

    <label><?php echo __('TAGS') ?>:</label><input class="txtFld" name="page[<?php echo $k; ?>][page_tag]" type="text"
                                                   id="page_<?php echo $k; ?>_page_tag"
                                                   value="<?php echo $v['page_tag']; ?>" maxlength="255"/>
    <p class="clear">&nbsp;</p>

    <label><?php echo __('META TITLE') ?>:</label><input class="txtFld" name="page[<?php echo $k; ?>][page_meta_title]"
                                                         type="text" id="page_<?php echo $k; ?>_page_meta_title"
                                                         value="<?php echo $v['page_meta_title']; ?>"/>
    <p class="clear">&nbsp;</p>

    <label><?php echo __('META KEYWORDS') ?>:</label><input class="txtFld"
                                                            name="page[<?php echo $k; ?>][page_meta_keywords]"
                                                            type="text" id="page_<?php echo $k; ?>_page_meta_keywords"
                                                            value="<?php echo $v['page_meta_keywords']; ?>"/>
    <p class="clear">&nbsp;</p>

    <label><?php echo __('META DESCRIPTION') ?>:</label><input class="txtFld"
                                                               name="page[<?php echo $k; ?>][page_meta_description]"
                                                               type="text"
                                                               id="page_<?php echo $k; ?>_page_meta_description"
                                                               value="<?php echo $v['page_meta_description']; ?>"/>
    <p class="clear">&nbsp;</p>

    <label><?php echo __('SORT') ?>:</label><input class="txtFld" name="page[<?php echo $k; ?>][page_sort]" type="text"
                                                   id="page_<?php echo $k; ?>_page_sort"
                                                   value="<?php echo $v['page_sort']; ?>"/>
    <p class="clear">&nbsp;</p>

    <div class="editSeparator">&nbsp;</div>

    <?php } ?>
    <label>&nbsp;</label><input name="edit" type="submit" id="edit"
                                value="<?php echo __('Update') ?>"/>&nbsp;<?php echo anchor
('admin/page/blog', __('BACK')); ?>

    <p class="clear">&nbsp;</p>
</div>
<?php } ?>
<?php echo form_close(); ?>

<?php $this->load->view('admin/inc/footer'); ?>
