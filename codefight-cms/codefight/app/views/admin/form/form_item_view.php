<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo __('Form Items'); ?></h1>

<?php echo form_open('admin/form/item'); ?>
<div class="group_grid">

    <ul id="sortme">
        <li>
            <div class="floatLeft center block borderRightGrey bold group_grid_heading_chkbox"><?php echo __('SELECT'); ?></div>
            <div class="floatLeft center block borderRightGrey bold group_grid_heading_title"><?php echo __('LABEL'); ?> (<?php echo __('name'); ?>)</div>
            <div class="floatLeft block bold group_grid_heading_description"><?php echo __('INPUT TYPE'); ?></div>
        </li>
        <?php foreach ($keys as $g) { ?>
        <li id="<?php echo $g['form_item_id']; ?>" class="sortitem">
            <div class="floatLeft center block borderRightGrey group_grid_heading_chkbox">
                <input name="select[<?php echo $g['form_item_id']; ?>]" type="checkbox"
                       id="select_<?php echo $g['form_item_id']; ?>" value="<?php echo $g['form_item_id']; ?>"/>
            </div>
            <div class="floatLeft center block borderRightGrey group_grid_heading_title"><?php echo $g['form_item_label']; ?>
                (<?php echo $g['form_item_name']; ?>)
            </div>
            <div class="floatLeft block group_grid_heading_description"><?php echo character_limiter($g['form_item_input_type'], 70); ?></div>
        </li>
        <?php } ?>
    </ul>
    <p class="clear">&nbsp;</p>
    <input name="delete" type="submit" id="delete" value="Delete Selected"/>
    <input name="edit" type="submit" id="edit" value="Edit Selected"/>
    <input name="create" type="submit" id="create" value="Create New"/>
    <input name="reset" type="reset" id="reset" value="Reset"/>

    <p class="clear">&nbsp;</p>

</div>
<?php echo form_close(); ?>

<?php $this->load->view('admin/inc/footer'); ?>
