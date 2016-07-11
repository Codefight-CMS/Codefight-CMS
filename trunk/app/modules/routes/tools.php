<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Package: Codefight CMS
 * Module: Tools
 * Author: Damodar Bashyal
 * Date: 5/10/2011
 */
// frontend routes
// tools
$route['tools(/.*)?'] = 'frontend/tools/sitemap/index$1';
$route['tools/captcha(/.*)?'] = 'frontend/tools/captcha/index$1';
$route['tools/sitemap(/.*)?'] = 'frontend/tools/sitemap/index$1';
$route['tools/version(/.*)?'] = 'frontend/tools/version/index$1';
