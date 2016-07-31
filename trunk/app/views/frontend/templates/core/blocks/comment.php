<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<script type="text/javascript">
    function process_comment() {
        jQuery('#comment_new').html('<p class="red"><img alt="<?php echo lang('processing_wait');?>" src="<?php echo skin_url('global/images','ajax-loader.gif') ?>" border="0" width="128" height="15"/></p>');
        jQuery.post(
                'page/ajax/get-page-comment',
                {
                    page_id: '<?php echo preg_replace('/[^0-9]+/', '', $this->uri->segment(3)); ?>',
                    name: document.getElementById("name").value,
                    email: document.getElementById("email").value,
                    url: document.getElementById("url").value,
                    comment: jQuery('textarea#comment').val(),//document.getElementById("comment").value,
                    spam: document.getElementById("spam").value,
                    page_url: '<?php echo current_url(); ?>'
                },
                function(data) {
                    if (data != '') {
                        jQuery('#comment_new').html(data);
                    }
                }
        );

        return false;
    }

</script>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a name="comment"></a>
            <span class="navbar-brand">Comments: </span>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li><?php echo anchor('feed/approved-comment', '<i class="fa fa-rss-square" aria-hidden="true"></i> Approved Comments'); ?></li>
            <li><?php echo anchor('feed/pending-comment', '<i class="fa fa-rss-square" aria-hidden="true"></i> Pending Comments'); ?></li>
        </ul>
    </div>
</nav>

<div class="comment_holder">
    <div id="comment"><?php Model('blog')->get_comment(preg_replace('/[^0-9]+/', '', $this->uri->segment(3, 0))); ?></div>
    <div id="comment_new">&nbsp;</div>
    <?php

    $attributes = array('id' => 'comment', 'class' => 'comment', 'onsubmit' => 'return false;');
    echo form_open(current_url(), $attributes);
    ?>
    <div class="form-group">
        <label for="name"><?php echo lang('name'); ?>*:</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="<?php echo lang('Name'); ?>" maxlength="35">
    </div>

    <div class="form-group">
        <label for="email"><?php echo lang('email'); ?>*:</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo lang('Email'); ?>" maxlength="100" aria-describedby="emailHelp">
        <small id="emailHelp" class="form-text text-muted"><?php echo lang('not published on website'); ?></small>
    </div>

    <div class="form-group">
        <label for="url"><?php echo lang('url'); ?>*:</label>
        <input type="text" class="form-control" id="url" name="url" placeholder="<?php echo lang('url'); ?>" maxlength="250">
    </div>

    <div class="form-group">
        <label for="comment"><?php echo lang('comment'); ?>*:</label>
        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
    </div>

    <div class="form-group">
        <label for="spam"><?php echo lang('spam_check'); ?>*:</label>
        <input type="text" class="form-control" id="spam" name="spam" placeholder="<?php echo lang('spam_check'); ?>" maxlength="250" aria-describedby="captchaHelp">

        <small id="captchaHelp" class="form-text text-muted">
            <img
                class="btn btn-warning"
                id="captcha"
                src="<?php echo base_url(); ?>tools/captcha/?<?php echo time(); ?>"
                alt=""
                border="0"
                onclick="jQuery('#captcha').attr('src', '<?php echo base_url(); ?>tools/captcha/?' + Math.floor(new Date().getTime() / 1000));"/>
        </small>
    </div>

    <br/>
    <label class="spam_question">

    </label>


    <br/>

    <input class="btn btn-primary" type="button" id="Btn" name="Btn" value="publish" onclick="process_comment();"/>

    <div id="js_req" class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span> <?php echo lang('enable_js_to_comment'); ?>
    </div>

    <?php echo form_close() ?>
</div>