<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cf_setting_model extends MY_Model
{

    var $setting;

    function __construct()
    {
        if (!isset($this->setting->site_enabled)) {
            $this->load_setting();
        }
    }

    public function load_setting()
    {
        $this->db->where('websites_id', CFWEBSITEID);
        $query = $this->db->get('setting');
        $query = $query->result_array();

        //for easy access change array key to setting key
        foreach ($query as $v)
        {
            $this->setting[$v['setting_key']] = $v['setting_value'];
        }

        $this->setting = (object)$this->setting;
    }

    //check to see if site is disabled or not
    function check_site_enabled()
    {
        $is_admin = false;
        if ($this->session->userdata('logged_in')) {
            $loggedData = $this->session->userdata('loggedData');
            if ($loggedData['group_id'] == '1') $is_admin = true;
        }

        //if the user is admin, don't disable site
        if ($this->setting->site_enabled === 1 && $is_admin == false) {
            die('<h1>Down For Maintenance.</h1><p>We are currently Upgrading the Site. Please visit after few minutes.</p><p>We are sorry for the inconvenience caused.</p>');
        }
    }

    /*
     function selected_template()
     {
         //Get default template from setting
         $template = $this->cf_setting_model->setting['default_template'];

         //Get template from session if user selected any
         if($this->session->userdata('template'))
             $template = $this->session->userdata('template');

         $this->session->set_userdata('template', $template);

         return $template;
     }
     */

    //get selected template
    function selected_template()
    {
        //Get default template from setting
        $template = $this->setting->default_template;

        //Get template from session if user selected any['.CFWEBSITEID.']
        /*
          $userdata['template'] = $this->session->userdata('template');
          if(isset($userdata['template'][CFWEBSITEID]))
          {
              $template = $userdata['template'][CFWEBSITEID];
          }
          */
        //print_r($this->session->userdata);
        //die();
        $this->session->set_userdata('template', array(CFWEBSITEID => $template));


        return $template;
    }

    function get_setting()
    {
        $websites_id = $this->session->userdata('websites_id');

        if ($websites_id > 0) {
            $this->db->where('websites_id', $websites_id);
        }

        $this->db->order_by('setting_id', 'asc');
        $query = $this->db->get('setting');
        $result1 = $query->result_array();

        foreach ($result1 as $k => $v)
        {
            $result1[$v['setting_key']] = $v;
            unset($result1[$k]);
        }

        $this->db->order_by('setting_id', 'asc');
        //$this->db->distinct();
        $query = $this->db->get('setting_keys');
        $result2 = $query->result_array();

        foreach ($result2 as $k => $v)
        {
            $result2[$v['setting_key']] = $v;
            unset($result2[$k]);
        }

        $result1 = array_merge($result2, $result1);

        $result1['websites_id']['websites_id'] = $websites_id;

        return $result1;
    }

    function set_setting($val)
    {
        if (isset($val['submit'])) {
            unset($val['submit']);
        }

        $websites_id = $val['websites_id'];
        $this->db->where('websites_id', $websites_id);
        //$this->db->select('setting_id,setting_key');
        $query = $this->db->get('setting');

        $website_setting = $query->result_array();
        foreach ($website_setting as $k => $v)
        {
            $website_setting[$v['setting_key']] = $v; //['setting_id'];
            unset($website_setting[$k]);
        }

        //$this->db->distinct();
        $query = $this->db->get('setting_keys');
        $result2 = $query->result_array();

        foreach ($result2 as $k => $v)
        {
            $result2[$v['setting_key']] = $v;
            unset($result2[$k]);
        }

        foreach ($val as $k => $v)
        {
            if (isset($website_setting[$k])) {
                $this->db->where('setting_id', $website_setting[$k]['setting_id']);
                $this->db->update('setting', array('setting_value' => $v));
            } else {
                unset($result2[$k]['setting_id']);
                $result2[$k]['setting_value'] = $v;
                $result2[$k]['websites_id'] = $websites_id;

                $this->db->insert('setting', $result2[$k]);
            }
        }

        $msg = array('success' => "<p>Setting Updated Successfully.</p>");
        set_global_messages($msg, 'success');
    }

    function set_setting_keys($val)
    {
        if (isset($val['submit'])) {
            unset($val['submit']);
        }

        foreach ($val as $k => $v)
        {
            $this->db->where('setting_key', $k);
            $this->db->update('setting', array('setting_info' => $v));
        }

        $msg = array('success' => "<p>Setting Updated Successfully.</p>");
        set_global_messages($msg, 'success');
    }

    function get_setting_keys()
    {
        $query = $this->db->get('setting_keys');
        return $query->result_array();
    }

    function insert_keys($val = array())
    {
        $this->db->where('setting_key', $val['setting_key']);
        $count = $this->db->count_all_results('setting_keys');

        if ($count >= 1) {
            return false;
        }
        else
        {
            $this->db->insert('setting_keys', $val);
            return true;
        }
    }

    //generate security question
    function security_question()
    {
        $one = rand(0, 9);
        $two = rand(0, 9);
        $answer = $one + $two;
        $this->session->set_userdata('captcha', $answer);
        return sprintf(lang('spam_question'), "$one + $two");
    }

    function get_templates()
    {
        //SET DEFAULT TEMPLATE VALUE
        $template = 'default';
        //If template is selected by user, then use that
        $userdata['template'] = $this->session->userdata('template');
        if (isset($userdata['template'][CFWEBSITEID])) {
            $template = $userdata['template'][CFWEBSITEID];
        }
        else {
            //If the user has not selected template,
            //Get default template from admin setting
            $query = $this->db->get_where('setting', array('setting_key' => 'default_template'));
            $row = $query->result_array();

            if (isset($row[0]) && isset($row[0]['setting_value']) && !empty($row[0]['setting_value']))
                $template = $row[0]['setting_value'];
        }

        $this->session->set_userdata('template', array(CFWEBSITEID => $template)); //[CFWEBSITEID]

        $ret = array();
        $dir = APPPATH . 'views/frontend/templates/';
        if ($handle = opendir($dir)) {
            while (false !== ($file = readdir($handle)))
            {
                if ($file != "." && $file != ".." && is_dir($dir . $file)) {
                    if (in_array($file, array('core', '.svn', '_svn', '.git', '.idea'))) {
                        continue;
                    }

                    if ($file == $template)
                        $ret['selected'] = $file;
                    else
                        $ret[$file] = $file;
                }
            }
            closedir($handle);
        }
        return $ret;
    }
}

?>