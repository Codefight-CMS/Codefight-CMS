<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="header">
		<div class="logo"><a title="Goto <?php echo $this->setting->site_name ?> Home" href="<?php echo site_url();?>"><?php echo strtoupper($this->setting->site_name); ?></a></div>

		<div class="userLogged">
			<span class="userInfo"><?php

			echo $this->cf_data_model->welcome_get(); ?> 

			| </span><span>
			<?php $format = 'DATE_RFC822'; $time = time(); echo standard_date($format, $time); ?></span>
		</div>
    </div>