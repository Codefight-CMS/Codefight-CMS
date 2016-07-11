<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Package: Codefight CMS
 * Module: Page / Blog / Feed
 * Author: Damodar Bashyal
 * Date: 5/10/2011
 */
// admin routes
$route['admin/page(/.*)?'] = 'admin/page/page/index$1';

// frontend routes
// page
$route['page(/.*)?'] = 'frontend/page/page/index$1';
$route['page/ajax(/.*)?'] = 'frontend/page/ajax/index$1';

// blog
$route['blog(/.*)?'] = 'frontend/blog/blog/index$1';
$route['blog/ajax(/.*)?'] = 'frontend/blog/ajax/index$1';
$route['blog/tag(/.*)?'] = 'frontend/blog/tag/index$1';

// feeds
$route['feed(/.*)?'] = 'frontend/feed/feed/index$1';
