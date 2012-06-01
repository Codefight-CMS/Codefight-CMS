<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Codefight CMS
 *
 * An open source cms for PHP 4.3.2 or newer
 *
 * @package        Codefight
 * @author        Codefight cms Team
 * @copyright    Copyright (c) 2008 - 2010, Codefight.org.
 * @license        pending
 * @link        http://codefight.org
 * @since        Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Codefight MY_Model Class
 *
 * @package        Codefight
 * @subpackage    Libraries
 * @category    Libraries
 * @author        Codefight CMS Team
 * @link        http://codefight.org
 */
class MY_Model extends CI_Model
{
    var
        $my_data,
        $my_table,
        $my_key,
        $my_action,
        $my_check_duplicate
    ;

    /**
     * @var string
     */
    protected $prefix = '';

    /**
     * @var string
     */
    protected $suffix = '_model';


    public function __construct()
    {
        parent::__construct();
    }

    public function set($key='', $val='')
    {
        $key = "my_{$key}";

        $this->$key = $val;

        return $this;
    }

    public function get($key='')
    {
        $key = "my_{$key}";

        if(isset($this->$key)) return $this->$key;

        return '';
    }

    public function reset()
    {
        $this->my_data =
        $this->my_table =
        $this->my_key =
        $this->my_action = false;

        return $this;
    }

    public function save($my_data=false, $my_table=false, $my_key=false, $my_action=false)
    {
        if($my_data)
        {
            $this->my_data = $my_data;
        }
        if($my_table)
        {
            $this->my_table = $my_table;
        }
        if($my_key)
        {
            $this->my_key = $my_key;
        }
        if($my_action)
        {
            $this->my_action = $my_action;
        }

        if(!empty($this->my_data))
        {
            $this->my_data = (array)$this->my_data;

            if(!$this->my_table)
            {
                $t = get_class($this);
                $this->my_table = substr($t, 3, -6);
            }

            if(!$this->my_key)
            {
                $this->my_key = "{$this->my_table}_id";
            }

            if(!$this->my_action)
            {
                $this->my_action = (isset($this->my_data[$this->my_key]) ? 'update' : 'insert');
            }

            foreach($this->my_data as $k => $v)
            {
                $escape = (is_array($v) ? 'TRUE' : 'FALSE');

                $this->db->set($k, $v, $escape);
            }

            switch($this->my_action)
            {
                case 'update':
                    $this->db
                            ->where($this->my_key, $this->my_data[$this->my_key])
                            ->update($this->my_table);
                    break;
                case 'insert':
                    $this->db
                            ->insert($this->my_table);
                    break;
                default:
            }

            return $this->db->affected_rows();
        }

        return 0;
    }


    /**
     * @param string $model
     *
     * @return mixed
     */
    public function Model($model = 'codefight', $config=FALSE)
    {
        if(!strpos($model, '/'))
        {
            $model_name = $this->prefix.$model.$this->suffix;
            $model_class = $this->prefix.ucfirst($model).($this->suffix);
            $model_file = $model.'/'.$model_name;
        } else {
            $model = explode('/', $model);

            $model_name = $this->prefix.ucfirst($model[0]).'_'.strtolower($model[1]).$this->suffix;
            $model_class = $this->prefix.ucfirst($model[0]).'_'.strtolower($model[1]).$this->suffix;
            $model_file = "{$model[0]}/{$model_name}";
        }

        if(!isset($this->$model_class) || !is_object($this->$model_class)) {
            $this->load->model($model_file, $model_class, $config);
        }

        return $this->$model_class;
    }
}
