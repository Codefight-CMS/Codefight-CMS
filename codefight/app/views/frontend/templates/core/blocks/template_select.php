<?php  /*if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
	
			<div class="template_chooser">
				<script type="text/javascript">
					function set_template(a) {
		jQuery.post(
			'page/ajax/set-template',
			{
				template: a,
				url: '<?php echo current_url(); ?>'
			},
			function(data){
				if(data!=''){
					window.location = '<?php echo current_url(); ?>';
				}
			}
		);
			
		return false;
	}
				</script>
				<select name="template" id="template" onchange="set_template(this.value);">
					<?php 
					foreach($this->cf_setting_model->get_templates() as $k => $v) { ?>
					<option value="<?php echo $v; ?>"<?php if($k=='selected') echo ' selected="selected"'; ?>><?php echo $v; ?></option>
					<?php } ?>
				</select>
			</div>*/