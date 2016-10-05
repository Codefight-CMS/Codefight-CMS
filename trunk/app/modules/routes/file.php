<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Package: Codefight CMS
 * Module: File Manager
 * Author: Damodar Bashyal
 * Date: 5/10/2011
 */

 // admin routes
$route['admin/file(/.*)?'] = 'admin/file/file/index$1';


// frontend routes
// file
$route['file/screenshot(/.*)?'] = 'frontend/file/screenshot/index$1';
$route['file(/.*)?'] = 'frontend/file/file/index$1';
$route['file/ajax(/.*)?'] = 'frontend/file/ajax/index$1';
