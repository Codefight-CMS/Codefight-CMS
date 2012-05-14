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
    	 * Constructor
    	 *
    	 * Runs the route mapping function.
    	 */
    	function __construct()
    	{
    		parent::__construct();
    	}

    // --------------------------------------------------------------------

    /**
     * Set the route mapping
     *
     * This function determines what should be served based on the URI request,
     * as well as any "routes" that have been set in the routing config file.
     *
     * @access    private
     * @return    void
     */
    function _set_routing()
   	{
   		// Are query strings enabled in the config file?  Normally CI doesn't utilize query strings
   		// since URI segments are more search-engine friendly, but they can optionally be used.
   		// If this feature is enabled, we will gather the directory/class/method a little differently
   		$segments = array();
   		if ($this->config->item('enable_query_strings') === TRUE AND isset($_GET[$this->config->item('controller_trigger')]))
   		{
   			if (isset($_GET[$this->config->item('directory_trigger')]))
   			{
   				$this->set_directory(trim($this->uri->_filter_uri($_GET[$this->config->item('directory_trigger')])));
   				$segments[] = $this->fetch_directory();
   			}

   			if (isset($_GET[$this->config->item('controller_trigger')]))
   			{
   				$this->set_class(trim($this->uri->_filter_uri($_GET[$this->config->item('controller_trigger')])));
   				$segments[] = $this->fetch_class();
   			}

   			if (isset($_GET[$this->config->item('function_trigger')]))
   			{
   				$this->set_method(trim($this->uri->_filter_uri($_GET[$this->config->item('function_trigger')])));
   				$segments[] = $this->fetch_method();
   			}
   		}

   		// Load the routes.php file.
   		if (defined('ENVIRONMENT') AND is_file(APPPATH.'config/'.ENVIRONMENT.'/routes'.EXT))
   		{
   			include(APPPATH.'config/'.ENVIRONMENT.'/routes'.EXT);
   		}
   		elseif (is_file(APPPATH.'config/routes'.EXT))
   		{
   			include(APPPATH.'config/routes'.EXT);
   		}

   		$this->routes = ( ! isset($route) OR ! is_array($route)) ? array() : $route;

   		/*
          * Updated for codefight cms
          */
           $route = $this->_generate_auto_routes();
           $this->routes = (!isset($route) OR !is_array($route)) ? array() : $route;
           /*---END---*/

   		unset($route);

   		// Set the default controller so we can display it in the event
   		// the URI doesn't correlated to a valid controller.
   		$this->default_controller = ( ! isset($this->routes['default_controller']) OR $this->routes['default_controller'] == '') ? FALSE : strtolower($this->routes['default_controller']);

   		// Were there any query string segments?  If so, we'll validate them and bail out since we're done.
   		if (count($segments) > 0)
   		{
   			return $this->_validate_request($segments);
   		}

   		// Fetch the complete URI string
   		$this->uri->_fetch_uri_string();

   		// Is there a URI string? If not, the default controller specified in the "routes" file will be shown.
   		if ($this->uri->uri_string == '')
   		{
   			return $this->_set_default_controller();
   		}

   		// Do we need to remove the URL suffix?
   		$this->uri->_remove_url_suffix();

   		// Compile the segments into an array
   		$this->uri->_explode_segments();

   		// Parse any custom routing that may exist
   		$this->_parse_routes();

   		// Re-index the segment array so that it starts with 1 rather than 0
   		$this->uri->_reindex_segments();
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
   		if (file_exists(APPPATH.'controllers/'.$segments[0].EXT))
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
               if (((count($segments) > 0) && is_dir(APPPATH . 'controllers/' . $this->directory . $segments[0])) && (!file_exists(APPPATH . 'controllers/' . $this->directory . $segments[0] . EXT))) $subfolder = true;

               while ($subfolder)
               {
                   if (!isset($segments[0])) break;

                   //Set the directory and remove it from the segment array
                   $this->set_directory($this->directory . $segments[0]);
                   $segments = array_slice($segments, 1);

                   // Does the requested controller exist in the root folder?
                   if ((count($segments) > 0) && file_exists(APPPATH . 'controllers/' . $this->directory . $segments[0] . EXT)) {
                       $subfolder = false;
                   }
               }
               /*---END--Sub-folder--*/


   			if (count($segments) > 0)
   			{
   				// Does the requested controller exist in the sub-folder?
   				if ( ! file_exists(APPPATH.'controllers/'.$this->fetch_directory().$segments[0].EXT))
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
   				if ( ! file_exists(APPPATH.'controllers/'.$this->fetch_directory().$this->default_controller.EXT))
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
   	}

    // --------------------------------------------------------------------

    /**
     *  Set the directory name
     *
     * @access    public
     * @param    string
     * @return    void
     */
    function set_directory($dir)
    {
        $this->directory = trim($dir, '/') . '/';
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
                        $file = str_replace(EXT, '', $file);
                        $module_rotes[0][$file . '(/.*)?'] = $file . '/index$1';
                    }
                    elseif (!in_array($file, array('index.html','_notes')) && (is_dir($dir2 = $dir . $file . '/')))
                    {
                        if ($handle2 = opendir($dir2)) {
                            while (false !== ($file2 = readdir($handle2)))
                            {
                                if ($file2 != "." && $file2 != ".." && $file2 != 'Thumbs.db') {
                                    if (is_file($dir2 . $file2) && $file2 != 'index.html') {
                                        $file2 = str_replace(EXT, '', $file2);
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
                                                        $file3 = str_replace(EXT, '', $file3);
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
        //print_r($module_rotes);
        //$this->routes['front_controllers_folder']
        //EXT

        return $module_rotes;
    }
}
// END MY_Router Class

/* End of file MY_Router.php */
/* Location: ./app/core/MY_Router.php */