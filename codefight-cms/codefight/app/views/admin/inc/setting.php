<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript" language="javascript">
function reload_settings($this)
{
	location.href='<?php echo base_url() ?>admin/setting/site/' + $this.value;
}
</script>