<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<form action="<?php echo current_url(); ?>" method="post">
	Keyword: <input type="text" name="keyword" /><br />

	Website: <input type="text" name="website" /><br />

	<input type="submit" />
</form>
<?php 
if(isset($keywordanalyzer)) print_r($keywordanalyzer); ?>