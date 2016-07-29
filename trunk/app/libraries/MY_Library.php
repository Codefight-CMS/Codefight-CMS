<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

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
        $this->ci =& get_instance();
        return $this->ci;
    }

    /**
     * @param string $library
     *
     * @return mixed
     */
    public function Library($library = 'codefight', $params = NULL)
	{
        $ci = $this->CI();

		if(!strpos($library, '/'))
        {
            $library_name = $this->prefix.$library.$this->suffix;
            $library_class = $this->prefix.ucfirst($library).($this->suffix);
            $library_file = $library.'/'.$library_name;
        } else {
            $library = explode('/', $library);

            $library_name = $this->prefix.ucfirst($library[0]).'_'.ucfirst($library[1]).$this->suffix;
            $library_class = $this->prefix.ucfirst($library[0]).'_'.ucfirst($library[1]).$this->suffix;
            $library_file = "{$library[0]}/{$library_name}";
        }

		if(!isset($ci->$library_class) || !is_object($ci->$library_class)) {
            $ci->load->library($library_file, $params, $library_class);
		}

		return $ci->$library_class;
	}
}
//new MY_Library();
