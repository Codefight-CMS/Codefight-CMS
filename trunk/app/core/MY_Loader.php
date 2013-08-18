<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Loader extends CI_Loader {

    function __construct() {
        parent::__construct();

        $CI =& get_instance();
        $CI->load = $this;
    }

    public function model($model, $name = '', $db_conn = FALSE)
    {
        if (is_array($model))
        {
            foreach ($model as $babe)
            {
                $this->model($babe);
            }
            return;
        }

        if ($model == '')
        {
            return;
        }

        $path = '';

        // Is the model in a sub-folder? If so, parse out the filename and path.
        if (($last_slash = strrpos($model, '/')) !== FALSE)
        {
            // The path is in front of the last slash
            $path = substr($model, 0, ++$last_slash);

            // And the model name behind it
            $model = substr($model, $last_slash);
        }

        if ($name == '')
        {
            $name = $model;
        }

        if (in_array($name, $this->_ci_models, TRUE))
        {
            return;
        }

        $CI =& get_instance();
        if (isset($CI->$name))
        {
            show_error('The model name you are loading is the name of a resource that is already being used: '.$name);
        }

        $model = strtolower($model);

        foreach ($this->_ci_model_paths as $mod_path)
        {
            /*
             * Changed $model to ucfirst($model) by codefight
             * */
            if (
                ! file_exists($mod_path.'models/'.$path.strtolower($model).'.php')
                &&
                ! file_exists($mod_path.'models/'.$path.ucfirst($model).'.php')
            )
            {
                continue;
            }

            if ($db_conn !== FALSE AND ! class_exists('CI_DB'))
            {
                if ($db_conn === TRUE)
                {
                    $db_conn = '';
                }

                $CI->load->database($db_conn, FALSE, TRUE);
            }

            if ( ! class_exists('CI_Model'))
            {
                load_class('Model', 'core');
            }

            /*
             * updated by codefight
             * */
            if(file_exists($mod_path.'models/'.$path.strtolower($model).'.php'))
            {
                require_once($mod_path.'models/'.$path.strtolower($model).'.php');
            } else {
                require_once($mod_path.'models/'.$path.ucfirst($model).'.php');
            }

            $model = ucfirst($model);
            $CI->$name = new $model();
            $this->_ci_models[] = $name;
            return;
        }

        // couldn't find the model
        show_error('Unable to locate the model you have specified: '.$model);
    }
}
// END MY_Loader Class

/* End of file MY_Loader.php */
/* Location: ./app/core/MY_Loader.php */
