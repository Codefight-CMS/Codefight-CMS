<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Package: Codefight CMS
 * Module: Banner
 * Author: Damodar Bashyal
 * Date: 5/10/2011
 */
$route['admin/banner(/.*)?'] = 'admin/banner/banner/index$1';
$route['admin/banner/manage(/.*)?'] = 'admin/banner/banner/manage$1';
$route['admin/banner/create(/.*)?'] = 'admin/banner/banner/create$1';
$route['admin/banner/status(/.*)?'] = 'admin/banner/banner/status$1';