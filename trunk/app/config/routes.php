<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> MY_Controller/index
|		my-controller/my-method	-> MY_Controller/my_method
*/
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

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
 * folder_path/controller/default_method
 */
$route['default_controller'] = $route['front_controllers_folder'] . "/page/page/index";

/*
* Route to Admin control panel
*/
$route['admin/' . '(.*)?'] = 'admin/$1';
$route['admin'] = "admin/cp/cp";


$route['(.*)?'] = $route['default_controller'] . '/$1';

// lets rename trim to go
$route['go/(.+)'] = $route['front_controllers_folder'] . '/trim/trim/index$1';

// load custom route configs
// move this to somewhere that can be cached
$dir = APPPATH . 'modules' . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR;
if ($handle = opendir($dir)) {
    while (false !== ($file = readdir($handle))) {
        if(is_file($dir . $file) && substr($file, -4) == '.php'){
            include_once ($dir . $file);
        }
    }
}
krsort($route);
