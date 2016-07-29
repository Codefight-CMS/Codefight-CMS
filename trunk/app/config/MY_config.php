<?php  if (!defined('BASEPATH')) {
    exit('No direct access allowed');
}

/*
 * DEFFINE BELOW ITEMS FOR ASSETS MANAGEMENT
 * dir is relative to base dir
 * filenames shouldn't have extensions i.e. no .css or .js
 */

//Base Path where index.php or admin.php is located
$config['cf']['base_path'] = SKINPATH;

/*
 * assets directory relative to base_path above
 * trailing slash (/) required if not empty e.g. 'assets/'
 * if empty then just ''
 */
$config['cf']['assets_dir'] = 'skin/';

/*
 * js (script) directory
 * No trailing or leading slashes (/)
 */
$config['cf']['js_dir'] = 'js';

/*
 * css directory
 * No trailing or leading slashes (/)
 */
$config['cf']['css_dir'] = 'css';

/*
 * Images directory
 * No trailing or leading slashes (/)
 */
$config['cf']['images_dir'] = 'images';

/*
 * Cache directory
 * No trailing or leading slashes (/)
 */
$config['cf']['cache_dir'] = 'cache';

//do js and css located in multifolder like admin, frontend, common
//default is false
$config['cf']['is_js_css_split'] = true;

/*
 * Define disallowed words
 */
$config['cf']['disallowed'] = array('nude', 'anal', 'nudity', 'nudist', 'naked', 'erotic', 'fetish', 'boob', 'damn',
                                    'xxx', 'sucks', 'golly', 'phooey', 'fuck', 'dick', 'pussy', 'porn', 'sex', 'slut',
                                    'cum', 'rape', 'camgirls', 'incest', 'exotic', 'hardcore', '(met art)', 'metart',
                                    'cock', 'horny', 'tits', 'seducing', 'seduce', 'seduction', 'shit', 'filipina18',
                                    'breast', 'penis');

/* End of file MY_config.php */
/* Location: ./system/application/config/MY_config.php */
