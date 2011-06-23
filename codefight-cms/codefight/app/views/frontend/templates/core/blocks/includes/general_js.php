<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script language="javascript">
/*Reason for this file is to pass php stuff*/
function set_language(lang, url) {
	if(lang == '') {
		alert('Couldnot change language at this time.');
		return;
	}
	else
	{
		jQuery('#loading_language').html('<p class="red"><img alt="<?php echo lang('processing_wait');?>" src="assets/img/processing.gif" border="0" width="200" height="20"/></p>');
		
		jQuery.post(
			'page/ajax/set-language',
			{
				id: lang,
			},
			function(data){
				if(data == 'OK'){
					if(url == '') {window.location.replace(window.location.href);} else {window.location.href = url;}
				} else {
					jQuery('#loading_language').html('<?php echo lang('language_change_error');?>');
				}
			}
		);
			
		return false;
	}
}
</script>