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
<div class="comment_holder">
    <div class="title"><a name="comment"></a>COMMENTS: <img src="assets/common/icons/feed.png" alt="FEED" name="Feed"
                                                            width="16" height="16" border="0"
                                                            id="Feed"/>( <?php echo anchor('feed/approved-comment', 'Approved Comment'); ?>
        | <?php echo anchor('feed/pending-comment', 'Pending Comment'); ?> )
    </div>
    <div id="comment"><?php $this->cf_blog_model->get_comment(preg_replace('/[^0-9]+/', '', $this->uri->segment(3, 0))); ?></div>
    <div id="comment_new">&nbsp;</div>
    <?php

    $attributes = array('id' => 'comment', 'class' => 'comment', 'onsubmit' => 'return false;');
    echo form_open(current_url(), $attributes);
    ?>
    <label><?php echo lang('name'); ?>*:</label><input name="name" type="text" class="txtfield inputtxt" id="name"
                                                       value="" maxlength="35"/>
    <br/>
    <label><?php echo lang('email'); ?>*:</label><input name="email" type="text" class="txtfield inputtxt" id="email"
                                                        value="" maxlength="100"/>

    <p class="clear">&nbsp;</p>
    <label><?php echo lang('url'); ?>*:</label><input name="url" type="text" class="txtfield inputtxt" id="url" value=""
                                                      maxlength="250"/>

    <br/>
    <label><?php echo lang('comment'); ?>*:</label><textarea class="txtarea inputtxt" name="comment"
                                                             id="comment"></textarea>

    <br/>
    <label><?php echo lang('spam_check'); ?>*:</label><input name="spam" type="text" class="txtfield inputtxt" id="spam"
                                                             value="" maxlength="250"/>
    <br/>
    <label class="spam_question">
        <img class="btn btn-warning" id="captcha" src="<?php echo base_url(); ?>tools/captcha/?<?php echo time(); ?>"
                                      alt=""
                                      border="0" onclick="jQuery('#captcha').attr('src', '<?php echo base_url(); ?>tools/captcha/?' + Math.floor(new Date().getTime() / 1000));"/>
    </label>


    <br/>

    <input class="btn btn-primary" type="button" id="Btn" name="Btn" value="publish" onclick="process_comment();"/>

    <div id="js_req" class="alert alert-error"><?php echo lang('enable_js_to_comment'); ?></div>
    </form>
</div>
