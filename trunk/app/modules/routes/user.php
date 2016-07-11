<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Package: Codefight CMS
 * Module: User / Registration
 * Author: Damodar Bashyal
 * Date: 5/10/2011
 */

  // admin routes
$route['admin/user(/.*)?'] = 'admin/user/user/index$1';
$route['admin/group(/.*)?'] = 'admin/group/group/index$1';
$route['admin/group/permissions(/.*)?'] = 'admin/group/permissions/index$1';



// frontend routes
// registration
$route['registration(/.*)?'] = 'frontend/registration/registration/index$1';

// user
$route['user(/.*)?'] = 'frontend/user/user/index$1';
