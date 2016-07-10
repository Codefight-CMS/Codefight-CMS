<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package        CodeIgniter
 * @author        ExpressionEngine Dev Team
 * @copyright    Copyright (c) 2008 - 2010, EllisLab, Inc.
 * @license        http://codeigniter.com/user_guide/license.html
 * @link        http://codeigniter.com
 * @since        Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * MY_Router Class
 *
 * Parses URIs and determines routing
 *
 * @package        Codefight CMS
 * @subpackage    Libraries
 * @author        Damodar Bashyal @dbashyal
 * @category    Libraries
 * @link        http://codeigniter.com/user_guide/general/routing.html
 */
class MY_Router extends CI_Router
{

    /**
     * Set the route mapping
     *
     * This function determines what should be served based on the URI request,
     * as well as any "routes" that have been set in the routing config file.
     *
     * @access    private
     * @return    void
     */
    protected function _set_routing()
    {
        // Load the routes.php file. It would be great if we could
        // skip this for enable_query_strings = TRUE, but then
        // default_controller would be empty ...
        if (file_exists(APPPATH.'config/routes.php'))
        {
            include(APPPATH.'config/routes.php');
        }

        if (file_exists(APPPATH.'config/'.ENVIRONMENT.'/routes.php'))
        {
            include(APPPATH.'config/'.ENVIRONMENT.'/routes.php');
        }

        // Validate & get reserved routes
        if (isset($route) && is_array($route))
        {
            /*
             * Updated for codefight cms
             * to be @deprecated as now we have custom router files
             * see @ apppath / modules / routes
             */
            //$this->routes = $route;
            //$_route = $this->_generate_auto_routes();
            //$route = array_merge($_route, $route);
            /*---END---*/


            isset($route['default_controller']) && $this->default_controller = $route['default_controller'];
            isset($route['translate_uri_dashes']) && $this->translate_uri_dashes = $route['translate_uri_dashes'];
            unset($route['default_controller'], $route['translate_uri_dashes']);
            $this->routes = $route;
        }

        // Are query strings enabled in the config file? Normally CI doesn't utilize query strings
        // since URI segments are more search-engine friendly, but they can optionally be used.
        // If this feature is enabled, we will gather the directory/class/method a little differently
        if ($this->enable_query_strings)
        {
            // If the directory is set at this time, it means an override exists, so skip the checks
            if ( ! isset($this->directory))
            {
                $_d = $this->config->item('directory_trigger');
                $_d = isset($_GET[$_d]) ? trim($_GET[$_d], " \t\n\r\0\x0B/") : '';

                if ($_d !== '')
                {
                    $this->uri->filter_uri($_d);
                    $this->set_directory($_d);
                }
            }

            $_c = trim($this->config->item('controller_trigger'));
            if ( ! empty($_GET[$_c]))
            {
                $this->uri->filter_uri($_GET[$_c]);
                $this->set_class($_GET[$_c]);

                $_f = trim($this->config->item('function_trigger'));
                if ( ! empty($_GET[$_f]))
                {
                    $this->uri->filter_uri($_GET[$_f]);
                    $this->set_method($_GET[$_f]);
                }

                $this->uri->rsegments = array(
                    1 => $this->class,
                    2 => $this->method
                );
            }
            else
            {
                $this->_set_default_controller();
            }

            // Routing rules don't apply to query strings and we don't need to detect
            // directories, so we're done here
            return;
        }

        // Is there anything to parse?
        if ($this->uri->uri_string !== '')
        {
            $this->_parse_routes();
        }
        else
        {
            $this->_set_default_controller();
        }
    }

    /**
     * Set default controller
     *
     * @return	void
     */
    protected function _set_default_controller()
    {
        if (empty($this->default_controller))
        {
            show_error('Unable to determine what should be displayed. A default route has not been specified in the routing file.');
        }

        // override for Codefight CMS starts here
        $default_controller = explode('/', trim($this->default_controller, '/'));
        if(count($default_controller) > 2){
            $method = array_pop($default_controller);
            $class = array_pop($default_controller);
            $this->default_controller = $class . '/' . $method;

            $directory = implode(DIRECTORY_SEPARATOR, $default_controller);
            $this->set_directory($directory);
        }
        // override for Codefight CMS ends here

        // Is the method being specified?
        if (sscanf($this->default_controller, '%[^/]/%s', $class, $method) !== 2)
        {
            $method = 'index';
        }

        if ( ! file_exists(APPPATH.'controllers/'.$this->directory.ucfirst($class).'.php'))
        {
            // This will trigger 404 later
            return;
        }

        $this->set_class($class);
        $this->set_method($method);

        // Assign routed segments, index starting from 1
        $this->uri->rsegments = array(
            1 => $class,
            2 => $method
        );

        log_message('debug', 'No URI present. Default controller set.');
    }

    // --------------------------------------------------------------------

    /**
     *  Set the controller overrides
     *
     * @access    public
     * @param    array
     * @return    null
     *
     * @deprecated: auto generated disabled, must define using custom routes
     * @see apppath / modules / routes
     */
    function _generate_auto_routes()
    {
        $module_routes = array();
        $module_routes[0] = array();
        $module_routes[1] = array();
        $module_routes[2] = array();
        $module_routes[3] = array();

        $dir = APPPATH . 'controllers' . '/';
        if ($handle = opendir($dir)) {
            while (false !== ($file = readdir($handle)))
            {
                if(is_file($dir . $file) && substr($file, -4) == '.php'){
                    $file = str_replace('.php', '', $file);
                    $file = strtolower($file);
                    $module_routes[0][$file . '(/.*)?'] = $file . '/index$1';
                } elseif(is_dir($dir2 = $dir . $file . DS) && !preg_match('/[^a-z0-9\/\\\_\-]/i', $dir2)) {
                    if ($handle2 = opendir($dir2)) {
                        while (false !== ($file2 = readdir($handle2))) {
                            if(!preg_match('/[^a-z0-9]/i', $file2)){
                                $module_routes[3][$file2 . '(/.*)?'] = strtolower($file) . '/' . strtolower($file2) . '/' . strtolower($file2) . '/index$1';
                            }
                            if(is_file($dir2 . $file2) && substr($file2, -4) == '.php'){
                                $file2 = str_replace('.php', '', $file2);
                                $file = strtolower($file);
                                $file2 = strtolower($file2);
                                $module_routes[1][$file . '/' . $file2 . '(/.*)?'] = $file . '/' . $file2 . '/index$1';
                            } elseif(is_dir($dir3 = $dir2 . $file2 . DS) && !preg_match('/[^a-z0-9\/\\\_\-]/i', $dir3)) {
                                if ($handle3 = opendir($dir3)) {
                                    while (false !== ($file3 = readdir($handle3))) {
                                        if(is_file($dir3 . $file3) && substr($file3, -4) == '.php'){
                                            $file3 = str_replace('.php', '', $file3);
                                            $key = '';
                                            $val = $file . '/';
                                            if ($this->routes['front_controllers_folder'] != $file) {
                                                $key .= $file . '/';
                                                //$val = '';
                                            }

                                            if ($file2 == $file3) {
                                                $key .= $file3;
                                            }
                                            else
                                            {
                                                $key .= $file2 . '/' . $file3;
                                            }

                                            $val .= $file2 . '/' . $file3;

                                            $key = strtolower($key);
                                            $val = strtolower($val);

                                            $module_routes[2][$key . '(/.*)?'] = $val . '/index$1';
                                        }
                                    }
                                    closedir($handle3);
                                }
                            }
                        }
                        closedir($handle2);
                    }
                }
            }
        }
        closedir($handle);

        $module_routes = array_merge($module_routes[3], $module_routes[2], $module_routes[1], $module_routes[0], $this->routes);
        krsort($module_routes);

        return $module_routes;
    }
}
// END MY_Router Class

/* End of file MY_Router.php */
/* Location: ./app/core/MY_Router.php */