<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Package: Codefight CMS
 * Module: Form
 * Author: Damodar Bashyal
 * Date: 5/10/2011
 */
 
 // admin routes
$route['admin/form(/.*)?'] = 'admin/form/form/index$1';

// frontend routes
// form
$route['form(/.*)?'] = 'frontend/form/ajax/index$1';
