<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
* @property CI_DB_active_record $db
* @property CI_DB_forge $dbforge
* @property CI_Benchmark $benchmark
* @property CI_Calendar $calendar
* @property CI_Cart $cart
* @property CI_Config $config
* @property CI_Controller $controller
* @property CI_Email $email
* @property CI_Encrypt $encrypt
* @property CI_Exceptions $exceptions
* @property CI_Form_validation $form_validation
* @property CI_Ftp $ftp
* @property CI_Hooks $hooks
* @property CI_Image_lib $image_lib
* @property CI_Input $input
* @property CI_Lang $lang
* @property CI_Loader $load
* @property CI_Log $log
* @property CI_Model $model
* @property CI_Output $output
* @property CI_Pagination $pagination
* @property CI_Parser $parser
* @property CI_Profiler $profiler
* @property CI_Router $router
* @property CI_Session $session
* @property CI_Sha1 $sha1
* @property CI_Table $table
* @property CI_Trackback $trackback
* @property CI_Typography $typography
* @property CI_Unit_test $unit_test
* @property CI_Upload $upload
* @property CI_URI $uri
* @property CI_User_agent $user_agent
* @property CI_Validation $validation
* @property CI_Xmlrpc $xmlrpc
* @property CI_Xmlrpcs $xmlrpcs
* @property CI_Zip $zip
* @property CI_Javascript $javascript
* @property CI_Jquery $jquery
* @property CI_Utf8 $utf8
* @property CI_Security $security
*/

/**
 *
 */
class MY_Library
{

    /**
     * @var CI_Controller
     */
    public $ci;

    /**
     * @var string
     */
    protected $prefix = '';

    /**
     * @var string
     */
    protected $suffix = '_Library';

    /**
     *
     */
    public function __construct()
    {
        $this->ci =& get_instance();
    }

    /**
     * @return CI_Controller
     */
    public function CI()
	{
        if(empty($this->ci))
        {
            $this->ci =& get_instance();
        }
        return $this->ci;
    }

    /**
     * @param string $library
     *
     * @return mixed
     */
    public function Library($library = 'codefight')
	{
        $ci = $this->CI();

		if(!strpos($library, '/'))
        {
            $library_name = $this->prefix.$library.strtolower($this->suffix);
            $library_class = $this->prefix.ucfirst($library).($this->suffix);
            $library_file = $library.'/'.$library_name;
        } else {
            $library = explode('/', $library);

            $library_name = $this->prefix.ucfirst($library[0]).'_'.ucfirst($library[1]).strtolower($this->suffix);
            $library_class = $this->prefix.ucfirst($library[0]).'_'.ucfirst($library[1]).$this->suffix;
            $library_file = "{$library[0]}/{$library_name}";
        }

		if(!isset($ci->$library_class) || !is_object($ci->$library_class)) {
            $ci->load->library($library_file, '', $library_class);
		}

		return $ci->$library_class;
	}
}
new MY_Library();
