<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
| 	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
/* 
 * Front Controllers Folder
 */
/*
 * TODO:: Generate automatically based on controllers
 */

$route['front_controllers_folder'] = "frontend";

/* 
 * Blog Controller
 */
//$route['blog(/.*)?'] = $route['front_controllers_folder'] . '/blog/blog/index$1';

/* 
 * Default Controller [page]
 */
$route['default_controller'] = $route['front_controllers_folder'] . "/page/page";


/*
* Route to Admin control panel
*/
$route['admin'] = "admin/cp/cp";


$route['admin' . '(/.*)?'] = 'admin$1';


$route['(.*)?'] = $route['default_controller'] . '/index/$1';
$route['scaffolding_trigger'] = "";
/*
$route['blog/(.+)'] = "blog/blog/index/$1";
$route['page/(.+)'] = "page/page/index/$1";
$route['page/(.+)'] = "page/page/index/$1";
$route['tag/(.+)'] = "blog/tag/index/$1";
$route['ajax/(.+)'] = "blog/ajax/$1";
$route['home'] = "page/page";
$route['registration/(.+)'] = "registration/registration/$1";
$route['registration'] = "registration/registration/";
//$route['feed'] = "feed";
//$route['sitemap'] = "sitemap";
$route['default_controller'] = "page/page";

$route['admin'.'(/.*)?'] = 'admin$1';

$route['scaffolding_trigger'] = "";


/* End of file routes.php */
/* Location: ./application/config/routes.php */