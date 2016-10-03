<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>
<h1><?php echo __(ucwords(preg_replace('/\-/', ' ', $this->uri->segment(3, __('Static Page')))));?></h1>

<?php echo form_open(current_url()) ?>
<div class="page_grid">
    <table class="table table-striped table-bordered" cellspacing="1">
        <col width="60" align="center"/>
        <col/>
        <col/>
        <thead>
        <tr>
            <th class="{sorter: 'text'}"><?php echo __('Select') ?></th>
            <th><?php echo __('Title') ?></th>
            <th><?php echo __('Websites') ?></th>
            <th><?php echo __('Action') ?></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><input type="checkbox" name="select_all" id="select_all"/></td>
            <td><input type="text" name="search[title]" id="search_title"/></td>
            <td><input type="text" name="search[website]" id="search_website"/></td>
            <td><input type="submit" value="search" class="button"/> </td>
        </tr>
        <?php foreach ($page as $g) { ?>
        <tr>
            <td><input
                    type="checkbox"
                    name="select[<?php echo $g['page_id']; ?>]"
                    id="select_<?php echo $g['page_id']; ?>"
                    value="<?php echo $g['page_id']; ?>"
                    class="checkbox checkbox_select_all"
                /></td>
            <td onclick="jQuery('#desc<?php echo $g['page_id']; ?>').slideToggle(500);">
                <?php echo $g['page_title']; ?>
                <div id="desc<?php echo $g['page_id']; ?>" class="page_grid_heading_description displayNone">
                    <?php echo word_limiter(strip_tags($g['page_body']), 100); ?>
                </div>
            </td>
            <td><?php echo Model('websites')->websites_name($g['websites_id']); ?></td>
            <td>&nbsp;</td>
        </tr>
            <?php } ?>
        </tbody>
    </table>
    <p class="clear">&nbsp;</p>
    <input class="btn btn-danger" name="delete" type="submit" id="delete" value="<?php echo __('Delete Selected') ?>"/>
    <input class="btn btn-primary" name="edit" type="submit" id="edit" value="<?php echo __('Edit Selected') ?>"/>
    <input class="btn btn-primary" name="create" type="submit" id="create" value="<?php echo __('Create New Page') ?>"/>
    <input class="btn btn-inverse" name="reset" type="reset" id="reset" value="<?php echo __('Reset') ?>"/>
</div>
<?php echo form_close(); ?>

<p class="clear">&nbsp;</p>
<nav aria-label="Page navigation">
    <?php if (isset($pagination)) echo $pagination; ?>
</nav>

<?php $this->load->view('admin/inc/footer'); ?>
