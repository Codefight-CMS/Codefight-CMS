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
        // Are query strings enabled in the config file? Normally CI doesn't utilize query strings
        // since URI segments are more search-engine friendly, but they can optionally be used.
        // If this feature is enabled, we will gather the directory/class/method a little differently
        if ($this->enable_query_strings)
        {
            $_d = $this->config->item('directory_trigger');
            $_d = isset($_GET[$_d]) ? trim($_GET[$_d], " \t\n\r\0\x0B/") : '';
            if ($_d !== '')
            {
                $this->uri->filter_uri($_d);
                $this->set_directory($_d);
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

        // Load the routes.php file.
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
            isset($route['default_controller']) && $this->default_controller = $route['default_controller'];
            isset($route['translate_uri_dashes']) && $this->translate_uri_dashes = $route['translate_uri_dashes'];
            unset($route['default_controller'], $route['translate_uri_dashes']);
            $this->routes = $route;
        }

        /*
       * Updated for codefight cms
       */
        $route = $this->_generate_auto_routes();
        $this->routes = (!isset($route) OR !is_array($route)) ? array() : $route;
        /*---END---*/

        unset($route);

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

    // --------------------------------------------------------------------

    /**
     * Validates the supplied segments.  Attempts to determine the path to
     * the controller.
     *
     * @access    private
     * @param    array
     * @return    array
     */
    function _validate_request($segments)
   	{
   		if (count($segments) == 0)
   		{
   			return $segments;
   		}

   		// Does the requested controller exist in the root folder?
   		if (file_exists(APPPATH.'controllers/'.$segments[0] . '.php'))
   		{
   			return $segments;
   		}

   		// Is the controller in a sub-folder?
   		if (is_dir(APPPATH.'controllers/'.$segments[0]))
   		{
   			// Set the directory and remove it from the segment array
   			$this->set_directory($segments[0]);
   			$segments = array_slice($segments, 1);

               /*
                   * Updated for codefight cms
                   * Added new code to allow multi-level sub-folder
                   */
               $subfolder = false;
               if (((count($segments) > 0) && is_dir(APPPATH . 'controllers/' . $this->directory . $segments[0])) && (!file_exists(APPPATH . 'controllers/' . $this->directory . $segments[0] . '.php'))) $subfolder = true;

               while ($subfolder)
               {
                   if (!isset($segments[0])) break;

                   //Set the directory and remove it from the segment array
                   $this->set_directory($this->directory . $segments[0]);
                   $segments = array_slice($segments, 1);

                   // Does the requested controller exist in the root folder?
                   if ((count($segments) > 0) && file_exists(APPPATH . 'controllers/' . $this->directory . $segments[0] . '.php')) {
                       $subfolder = false;
                   }
               }
               /*---END--Sub-folder--*/


   			if (count($segments) > 0)
   			{
   				// Does the requested controller exist in the sub-folder?
   				if ( ! file_exists(APPPATH.'controllers/'.$this->fetch_directory().$segments[0] . '.php'))
   				{
   					show_404($this->fetch_directory().$segments[0]);
   				}
   			}
   			else
   			{
   				// Is the method being specified in the route?
   				if (strpos($this->default_controller, '/') !== FALSE)
   				{
   					$x = explode('/', $this->default_controller);

   					$this->set_class($x[0]);
   					$this->set_method($x[1]);
   				}
   				else
   				{
   					$this->set_class($this->default_controller);
   					$this->set_method('index');
   				}

   				// Does the default controller exist in the sub-folder?
   				if ( ! file_exists(APPPATH.'controllers/'.$this->fetch_directory().$this->default_controller . '.php'))
   				{
   					$this->directory = '';
   					return array();
   				}

   			}

   			return $segments;
   		}


   		// If we've gotten this far it means that the URI does not correlate to a valid
   		// controller class.  We will now see if there is an override
   		if ( ! empty($this->routes['404_override']))
   		{
   			$x = explode('/', $this->routes['404_override']);

   			$this->set_class($x[0]);
   			$this->set_method(isset($x[1]) ? $x[1] : 'index');

   			return $x;
   		}


   		// Nothing else to do at this point but show a 404
   		show_404($segments[0]);

        return false;
   	}

    // --------------------------------------------------------------------

    /**
     *  Set the controller overrides
     *
     * @access    public
     * @param    array
     * @return    null
     */
    function _generate_auto_routes()
    {
        $module_rotes = array();
        $module_rotes[0] = array();
        $module_rotes[1] = array();
        $module_rotes[2] = array();

        $dir = APPPATH . 'controllers' . '/';
        if ($handle = opendir($dir)) {
            while (false !== ($file = readdir($handle)))
            {
                if ($file != "." && $file != ".." && $file != 'Thumbs.db') {
                    if (is_file($dir . $file) && $file != 'index.html') {
                        $file = str_replace('.php', '', $file);
                        $module_rotes[0][$file . '(/.*)?'] = $file . '/index$1';
                    }
                    elseif (!in_array($file, array('index.html','_notes')) && (is_dir($dir2 = $dir . $file . '/')))
                    {
                        if ($handle2 = opendir($dir2)) {
                            while (false !== ($file2 = readdir($handle2)))
                            {
                                if ($file2 != "." && $file2 != ".." && $file2 != 'Thumbs.db') {
                                    if (is_file($dir2 . $file2) && $file2 != 'index.html') {
                                        $file2 = str_replace('.php', '', $file2);
                                        $module_rotes[1][$file . '/' . $file2 . '(/.*)?'] = $file . '/' . $file2 . '/index$1';
                                    }
                                    elseif (!in_array($file2, array('index.html','_notes')) && (is_dir($dir3 = $dir2 . $file2 . '/')))
                                    {

                                        /*
                                                  if($this->routes['front_controllers_folder'] != $file)
                                                  {
                                                      $module_rotes[$file . '/' . $file2.'(/.*)?'] = $file . '/' . $file2 . '/' . $file2 . '/index$1';
                                                  }
                                                  */

                                        if ($handle3 = opendir($dir3)) {
                                            while (false !== ($file3 = readdir($handle3)))
                                            {
                                                if ($file3 != "." && $file3 != ".." && $file3 != 'Thumbs.db') {
                                                    if (is_file($dir3 . $file3) && $file3 != 'index.html') {
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

                                                        $module_rotes[2][$key . '(/.*)?'] = $val . '/index$1';
                                                    }
                                                }
                                            }
                                            closedir($handle3);
                                        }
                                    }
                                }
                            }
                        }
                        closedir($handle2);
                    }
                }
            }
        }
        closedir($handle);

        $module_rotes = array_merge($module_rotes[2], $module_rotes[1], $module_rotes[0], $this->routes);
        krsort($module_rotes);

        return $module_rotes;
    }
}
// END MY_Router Class

/* End of file MY_Router.php */
/* Location: ./app/core/MY_Router.php */