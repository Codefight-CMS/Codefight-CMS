<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Do you want to limit to yourself only? If so add your IP here.
$config['limit_to_ip'] =  $_SERVER['REMOTE_ADDR'];

//Do you want to track your referrals?
$config['track'] =  TRUE;

//Do you want to verify if the URL exists?
$config['verify_url'] =  TRUE;

//What characters do you want to allow on the Trim URL?
$config['allowed_chars'] =  '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

//Do you want to save cache?
$config['cache'] =  TRUE;

//Where is your cache directory? end with trailing slash(/)
$config['cache_dir'] =  FCPATH . 'media/cache/';

/* End of file config.php */
/* Location: ./app/config/trim.php */