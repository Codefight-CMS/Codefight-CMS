<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<h1><?php echo ucwords(preg_replace('/\-/', ' ', $this->uri->segment(2, __('comment'))));?></h1>

<?php echo form_open(current_url()) ?>
<div class="comment_grid">
    <table class="table table-striped table-bordered" cellspacing="1">
        <thead>
        <tr>
            <th><?php echo __('Select') ?></th>
            <th><?php echo __('Title') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($comment as $g) { ?>
        <tr id="<?php echo $g['page_comment_id']; ?>"
            onclick="jQuery('#desc<?php echo $g['page_comment_id']; ?>').slideToggle(500);">
            <td><input name="select[<?php echo $g['page_comment_id']; ?>]" type="checkbox"
                       id="select_<?php echo $g['page_comment_id']; ?>" value="<?php echo $g['page_comment_id']; ?>"/></td>
            <td>
                <?php echo $g['name'] . ' - ' . $g['email']; ?>
                <p class="clear">&nbsp;</p>
                <div id="desc<?php echo $g['page_comment_id']; ?>" class="comment_grid_heading_description">
                    <?php echo '<br /><u>Page:</u><br /><a target="_blank" href="' . $g['page_url'] . '">' . $g['page_url'] . '</a><br /><u>Comment:</u><br />' . strip_tags($g['comment']); ?>
                </div>
            </td>
        </tr>
            <?php } ?>
        </tbody>
    </table>
    <p class="clear">&nbsp;</p>
    <input class="btn btn-danger" name="delete" type="submit" id="delete" value="<?php echo __('Delete Selected') ?>"/>
    <input class="btn btn-primary" name="approve" type="submit" id="approve" value="<?php echo __('Approve Selected') ?>"/>
    <input class="btn btn-inverse" name="reset" type="reset" id="reset" value="<?php echo __('Reset') ?>"/>
</div>
<?php echo form_close(); ?>

<p class="clear">&nbsp;</p>
<nav aria-label="Page navigation">
    <?php if (isset($pagination)) echo $pagination; ?>
</nav>

<?php $this->load->view('admin/inc/footer'); ?>
