<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Package: Codefight CMS
 * Module: User
 * Author: Damodar Bashyal
 * Date: 5/10/2011
 */
$route['admin/user(/.*)?'] = 'admin/user/user/index$1';
$route['admin/group(/.*)?'] = 'admin/group/group/index$1';
$route['admin/group/permissions(/.*)?'] = 'admin/group/permissions/index$1';