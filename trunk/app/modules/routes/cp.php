<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Package: Codefight CMS
 * Module: Admin Control Panel Home
 * Author: Damodar Bashyal
 * Date: 5/10/2011
 * @todo:: define language file, models, libraries, helpers, controller, routes.
 */
$route['admin/cp(/.*)?'] = 'admin/cp/cp/index$1';
$route['admin/cp/update(/.*)?'] = 'admin/cp/cp/update$1';
