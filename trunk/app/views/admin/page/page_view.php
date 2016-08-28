<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>
<h1><?php echo ucwords(preg_replace('/\-/', ' ', $this->uri->segment(3, 'Static Page')));?></h1>

<?php echo form_open(uri_string()); ?>
<div class="page_grid">
    <table class="table table-striped table-bordered" cellspacing="1">
        <col width="60" align="center"/>
        <col/>
        <col/>
        <thead>
        <tr>
            <th class="{sorter: 'text'}"><?php echo __('Select'); ?></th>
            <th><?php echo __('Title'); ?></th>
            <th><?php echo __('Websites'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($page as $g) { ?>
        <tr>
            <td><input name="select[<?php echo $g['page_id']; ?>]" type="checkbox"
                       id="select_<?php echo $g['page_id']; ?>" value="<?php echo $g['page_id']; ?>"/></td>
            <td onclick="jQuery('#desc<?php echo $g['page_id']; ?>').slideToggle(500);"><?php echo $g['page_title']; ?>
                <div id="desc<?php echo $g['page_id']; ?>"
                     class="page_grid_heading_description displayNone"><?php echo word_limiter(strip_tags($g['page_body']), 100); ?></div>
            </td>
            <td><?php echo Model('websites')->websites_name($g['websites_id']); ?></td>
        </tr>
            <?php } ?>
        </tbody>
    </table>
    <p class="clear">&nbsp;</p>
    <input class="btn btn-danger" name="delete" type="submit" id="delete" value="Delete Selected"/>
    <input class="btn btn-primary" name="edit" type="submit" id="edit" value="Edit Selected"/>
    <input class="btn btn-primary" name="create" type="submit" id="create" value="Create New Page"/>
    <input class="btn btn-inverse" name="reset" type="reset" id="reset" value="Reset"/>
</div>
<?php echo form_close(); ?>

<p class="clear">&nbsp;</p>
<nav aria-label="Page navigation">
    <?php if (isset($pagination)) echo $pagination; ?>
</nav>

<?php $this->load->view('admin/inc/footer'); ?>
