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

    public function MY_Model()
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
}