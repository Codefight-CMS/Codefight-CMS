<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo __('Websites Manager'); ?></h1>

<?php echo form_open('admin/setting/websites'); ?>
<div class="group_grid">

    <ul id="sortme">
        <li>
            <div class="floatLeft center block borderRightGrey bold group_grid_heading_chkbox"><?php echo __('SELECT'); ?></div>
            <div class="floatLeft center block borderRightGrey bold group_grid_heading_title"><?php echo __('Website'); ?></div>
            <div class="floatLeft center block borderRightGrey bold group_grid_heading_title"><?php echo __('Website ID'); ?></div>
            <div class="floatLeft center block borderRightGrey bold group_grid_heading_description"><?php echo __('Website URL'); ?></div>
            <div class="floatLeft block bold group_grid_heading_title"><?php echo __('Status'); ?></div>
        </li>
        <?php foreach ($websites as $g) { ?>
        <li id="<?php echo $g['websites_id']; ?>" class="sortitem">
            <div class="floatLeft center block borderRightGrey group_grid_heading_chkbox">
                <input name="select[<?php echo $g['websites_id']; ?>]" type="checkbox"
                       id="select_<?php echo $g['websites_id']; ?>" value="<?php echo $g['websites_id']; ?>"/>
            </div>
            <div class="floatLeft center block borderRightGrey group_grid_heading_title"><?php echo $g['websites_name']; ?></div>
            <div class="floatLeft center block borderRightGrey group_grid_heading_title"><?php echo $g['websites_id']; ?></div>
            <div class="floatLeft center block borderRightGrey group_grid_heading_description"><?php echo $g['websites_url']; ?></div>
            <div class="floatLeft block group_grid_heading_title"><?php echo $g['websites_status']; ?></div>
        </li>
        <?php } ?>
    </ul>
    <p class="clear">&nbsp;</p>
    <input name="delete" type="submit" id="delete" value="Delete Selected"/>
    <input name="edit" type="submit" id="edit" value="Edit Selected"/>
    <input name="create" type="submit" id="create" value="Add New Website"/>
    <input name="reset" type="reset" id="reset" value="Reset"/>

    <p class="clear">&nbsp;</p>

</div>
<?php echo form_close(); ?>

<?php $this->load->view('admin/inc/footer'); ?>
