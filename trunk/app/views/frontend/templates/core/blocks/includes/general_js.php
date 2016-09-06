<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<script language="javascript">
    /*Reason for this file is to pass php stuff*/
    function set_language(lang, url) {
        if (lang == '') {
            alert('Couldnot change language at this time.');
            return;
        }
        else {
            jQuery('#loading_language').html('<p class="alert alert-error" role="alert"><img alt="<?php echo lang('processing_wait');?>" src="<?php echo skin_url('global/images','ajax-loader.gif') ?>" border="0" width="128" height="15"/></p>');

            jQuery.post(
                    'page/ajax/set-language',
                    {
                        id: lang,
                    },
                    function(data) {
                        if (data == 'OK') {
                            if (url == '') {
                                window.location.replace(window.location.href);
                            } else {
                                window.location.href = url;
                            }
                        } else {
                            jQuery('#loading_language').html('<?php echo lang('language_change_error');?>');
                        }
                    }
            );

            return false;
        }
    }
</script>
