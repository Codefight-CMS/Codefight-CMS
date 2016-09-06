<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo ucwords(preg_replace('/\-/', ' ', $this->uri->segment(3, 'Page Links')));?></h1>

<?php
    $options_active = array('0' => __('Inactive'),
                            '1' => __('Active'));

//get menu
$options_menu = array('0' => 'TOP');

foreach ($menu_array as $v)
{
    if (!empty($v) && $v['title'] != 'N/A') $options_menu[$v['id']] = $v['title'];
}
?>

<?php echo form_open('admin/menu/' . $this->uri->segment(3, 'page')); ?>
<div class="menu_create">
    <label><?php echo __('STATUS'); ?>:</label>
    <?php echo form_dropdown('menu_active', $options_active, set_value('menu_active'), 'class="form-control txtFld"'); ?>
    <p class="clear">&nbsp;</p>

    <label><?php echo __('PARENT MENU'); ?>:</label>
    <?php echo form_dropdown('menu_parent_id', $options_menu, set_value('menu_parent_id'), 'class="form-control txtFld"'); ?>
    <p class="clear">&nbsp;</p>

    <label><?php echo __('TITLE'); ?>:</label><input class="form-control txtFld" name="menu_title" type="text" id="menu_title"
                                                     value="<?php echo set_value('menu_title'); ?>"/>

    <p class="clear">&nbsp;</p>
    <label>&nbsp;</label>

    <p><?php echo __('Created Automatically'); ?>
        (<?php echo __('Enter Only If Linking External Site'); ?> <?php echo __('e.g.'); ?>
        http://www.codefight.org/)</p>
    <label><?php echo __('LINK'); ?>:</label><input class="form-control txtFld" name="menu_link" type="text" id="menu_link"
                                                    value="<?php echo set_value('menu_link'); ?>"/>
    <p class="clear">&nbsp;</p>

    <label><?php echo __('PARAMS'); ?>:</label><input class="form-control txtFld" name="menu_params" type="text" id="menu_params"
                                                     value="<?php echo form_prep(set_value('menu_params')); ?>"/>

    <p class="clear">&nbsp;</p>

    <label><?php echo __('SORT'); ?>:</label><input class="form-control txtFld" name="menu_sort" type="text" id="menu_sort"
                                                    value="<?php echo Model('data')->get_sort_id('menu'); ?>"/>

    <p class="clear">&nbsp;</p>

    <label><?php echo __('Show in Websites'); ?>:</label>

    <p class="clear">&nbsp;</p>
<?php
        if (isset($websites))
    foreach ($websites as $website) {
        echo form_checkbox('websites_id[' . $website['websites_id'] . ']', $website['websites_id'], false) . ' ' . $website['websites_name'] . "\n";
        echo '<p class="clear">&nbsp;</p>';
    }
    ?>
    <p class="clear">&nbsp;</p>

    <div class="editSeparator">&nbsp;</div>
    <label>&nbsp;</label><input class="btn btn-primary" name="create" type="submit" id="create" value="Create"/>&nbsp;<?php echo anchor('admin/menu/' . $this->uri->segment(3, ''), __('BACK')); ?>
    <p class="clear">&nbsp;</p>
</div>
<?php echo form_close(); ?>

<?php $this->load->view('admin/inc/footer'); ?>
