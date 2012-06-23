<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo ucwords(preg_replace('/\-/', ' ', $this->uri->segment(3, 'Page Links')));?></h1>

<?php
$attributes = array('class' => 'overflow-x', 'id' => 'menu-form');
echo form_open(current_url(), $attributes);
?>
<div class="menu_grid">

    <table id="sortme" class="table table-striped table-bordered" border="0" cellpadding="0" cellspacing="0">
        <tr id="exclude">
            <th><?php echo __('Select'); ?></th>
            <th><?php echo __('Title'); ?></th>
            <th><?php echo __('Link'); ?></th>
            <th><?php echo __('Websites'); ?></th>
        </tr>
        <?php
                if (isset($menu) && is_array($menu) && count($menu) > 0) foreach ($menu as $g)
    {
        //$sort_id = $g['id'] . $g['sort'];
        ?>

        <tr id="<?php echo $g['id']; ?>" class="sortitem">
            <td><input name="select[<?php echo $g['id']; ?>]" type="checkbox" id="select_<?php echo $g['id']; ?>"
                       value="<?php echo $g['id']; ?>"/></td>
            <td><?php echo $g['title']; ?></td>
            <td><?php echo $g['url']; if (!preg_match('|http|i', $g['url'])) echo $this->config->item('url_suffix') ?></td>
            <td><?php echo Model('websites')->websites_name($g['websites_id']); ?></td>
        </tr>

        <?php } ?>

    </table>
    <p class="clear">&nbsp;</p>
    <input class="btn btn-danger" name="delete" type="submit" id="delete" value="Delete Selected"/>
    <input class="btn btn-primary" name="edit" type="submit" id="edit" value="Edit Selected"/>
    <input class="btn btn-primary" name="create" type="submit" id="create" value="Create New Menu"/>
    <input class="btn btn-inverse" name="reset" type="reset" id="reset" value="Reset"/>


</div>
<?php echo form_close(); ?>

<?php $this->load->view('admin/inc/footer'); ?>
