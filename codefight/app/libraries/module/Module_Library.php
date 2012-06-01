<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Module_Library extends MY_Library
{

    var $CI;
    var $cnf = array();
    var $nav = false;
    var $top = array();
    var $sort = array();
    var $parents = array();

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    function _getAdminNav()
    {
        $this->_getCnfs();

        $sort_array = (array)$this->cnf;
        foreach($sort_array as $k => $v)
        {
            if(isset($v['global']['status']))
            {
                if($v['global']['status'] == 1)
                {
                    if(!isset($v['global']['title']))
                    {
                        $this->cnf[$k]['global']['title'] = ucwords($k);
                    }
                    if(!isset($v['global']['parent']))
                    {
                        $this->cnf[$k]['global']['parent'] = 'top';
                    }
                    if(!isset($v['global']['is_menu']))
                    {
                        $this->cnf[$k]['global']['is_menu'] = 1;
                    }
                    if(!isset($v['global']['void']))
                    {
                        $this->cnf[$k]['global']['void'] = 0;
                    }
                    if($v['global']['parent'] == 'top')
                    {
                        $this->sort[$k] = (isset($v['global']['sort']) ? (int)$v['global']['sort'] : 10000);
                    } else {
						$this->parents[$v['global']['parent']][$k] = $k;
					}
                } else {
                    unset($this->cnf[$k]); //exclude disabled modules.
                }
            }
        }
        asort($this->sort);
        //print_r($this->sort);

        $nav = array();
        foreach($this->sort as $k => $v)
        {
            $nav[$k]['is_menu'] = $this->cnf[$k]['global']['is_menu'];
            $nav[$k]['void'] = $this->cnf[$k]['global']['void'];
            $nav[$k]['url'] = $k;
            $nav[$k]['title'] = $this->cnf[$k]['global']['title'];
            $nav[$k]['child'] = array();

            if(isset($this->parents[$k]))
            {
                foreach($this->parents[$k] as $pv)
                {
                    $nav[$k]['child'][$pv]['is_menu'] = $this->cnf[$pv]['global']['is_menu'];
                    $nav[$k]['child'][$pv]['void'] = $this->cnf[$pv]['global']['void'];
                    $nav[$k]['child'][$pv]['url'] = $pv;
                    $nav[$k]['child'][$pv]['title'] = $this->cnf[$pv]['global']['title'];
                    $nav[$k]['child'][$pv]['child'] = array();

                    if(isset($this->cnf["+{$k}"]["+{$pv}"]))
                    {
                        foreach($this->cnf["+{$k}"]["+{$pv}"] as $_ck => $_cv)
                        {
                            if(isset($_cv['child']))
                            {
                                foreach($_cv['child'] as $ck => $cv)
                                {
                                    if(!isset($cv['status']) || empty($cv['status']))
                                    {
                                        continue;
                                    }
                                    if(!isset($cv['void']))
									{
										$cv['void'] = 0;
									}
                                    if(!isset($cv['is_menu']))
									{
										$cv['is_menu'] = 1;
									}
                                    $nav[$k]['child'][$pv]['child'][$ck]['is_menu'] = $cv['is_menu'];
                                    $nav[$k]['child'][$pv]['child'][$ck]['void'] = $cv['void'];
                                    $nav[$k]['child'][$pv]['child'][$ck]['url'] = $ck;
                                    $nav[$k]['child'][$pv]['child'][$ck]['title'] = $cv['title'];
                                }
                                unset($this->cnf["+{$k}"]["+{$pv}"]);
                            }
                        }
                    }
                }
            }

            if(isset($this->cnf[$k]['admin']['child']))
            {
                foreach($this->cnf[$k]['admin']['child'] as $ck => $cv)
                {
                    if(!isset($cv['status']) || empty($cv['status']))
                    {
                        continue;
                    }
                    if(!isset($cv['is_menu']))
					{
						$cv['is_menu'] = 1;
					}
                    if(!isset($cv['void']))
					{
						$cv['void'] = 0;
					}
					$nav[$k]['child'][$ck]['is_menu'] = $cv['is_menu'];
					$nav[$k]['child'][$ck]['void'] = $cv['void'];
                    $nav[$k]['child'][$ck]['url'] = $ck;
                    $nav[$k]['child'][$ck]['title'] = $cv['title'];
                }
            }

            if(isset($this->cnf["+{$k}"]))
            {
                foreach($this->cnf["+{$k}"] as $_ck => $_cv)
                {
                    if(isset($_cv['admin']['child']))
                    {
                        foreach($_cv['admin']['child'] as $ck => $cv)
                        {
                            if(!isset($cv['status']) || empty($cv['status']))
                            {
                                continue;
                            }
							if(!isset($cv['is_menu']))
							{
								$cv['is_menu'] = 1;
							}
							if(!isset($cv['void']))
							{
								$cv['void'] = 0;
							}
                            $nav[$k]['child'][$ck]['is_menu'] = $cv['is_menu'];
                            $nav[$k]['child'][$ck]['void'] = $cv['void'];
                            $nav[$k]['child'][$ck]['url'] = $ck;
                            $nav[$k]['child'][$ck]['title'] = $cv['title'];
                        }
                    }
                }
            }
        }
        return $nav;
    }

    function _mergeCnfs($files = array())
    {
        if (!count($files)) return '';

        $nav = array();
        $sort = array();
        $xmlRaw = '<' . '?xml version="1.0"?' . '><cfmodules>';
        foreach ($files as $v)
        {
            $xmlRaw .= preg_replace('@<\?xml(.+)\?>@iU', '', file_get_contents($v));
        }
        $xmlRaw .= '</cfmodules>';
        $xmlData = Library('simplexml')->xml_parse($xmlRaw);

        if (!isset($xmlData['module'])) return array();

        foreach ($xmlData['module'] as $k => $v)
        {
            $position = 99999;
            if ((!isset($v['active'])) || (strtolower($v['active']) !== 'true')) continue; //die($data->active);//
            if (isset($v['sort'])) $position = (string)$v['sort'];

            if (isset($v['admin']['navigation'])) {
                $data = $v['admin']['navigation'];

                if (!isset($sort[key($data)]) || ($sort[key($data)] > $position)) $sort[key($data)] = $position;

                $nav = array_merge_recursive($nav, $data);
            }
        }
        asort($sort);

        foreach ($sort as $k => $v)
        {
            $sort[$k] = $nav[$k];
            unset($nav[$k]);
        }

        return array_merge_recursive($sort, $nav);
    }

    function _getCnfs()
    {
        $ret = array();
        $cnf = array();

        $dir = FCPATH . 'app/modules/';

        if ($handle = opendir($dir)) {
            while (false !== ($file = readdir($handle)))
            {
                //if ($file != "." && $file != ".." && $file != 'Thumbs.db' && $file != 'index.html' && is_file($dir . $file)) {
                if (substr($file, 0, 4) == "cnf." && substr($file, -4) == ".php" && is_file($dir . $file)) {
                    //$ret[$dir . $file] = $dir . $file;
                    include ($dir . $file);
                }
            }
            closedir($handle);
        }

        $this->cnf = array_merge($this->cnf, $cnf);

        return;
    }

	public function get_nav_from_db()
	{
        $group_id = $this->CI->user('group_id');

		return Model('module')->get($group_id);
	}
}
