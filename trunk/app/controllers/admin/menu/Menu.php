<?php
/**
 * Codefight CMS
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to info@codefight.org so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Codefight CMS to newer
 * versions in the future.
 *
 * @category    Codefight CMS
 * @package     cf_menu
 * @copyright   Copyright (c) 2010 Codefight CMS Team (http://codefight.org)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Admin Menu Controller
 */
class Menu extends MY_Controller
{

    function __construct()
    {
        parent::MY_Controller();

        $this->load->helper(array('form', 'text'));
    }


    function index()
    {
        if (isset($_POST['create'])) {
            $this->_create();
        }
        else if (isset($_POST['delete'])) {
            $this->_delete();
        }
        else if (isset($_POST['edit'])) {
            $this->_edit();
        }
        else
        {
            $data = '';

            $data['head_includes'] = array('sortable.php');
            $data['menu'] = Library('menu')->get(array('menu_type' => $this->uri->segment(3, 'page')), true);

            //---
            $html_string = $this->load->view('admin/menu/menu_view', $data, true); //Get view data in place of sending to browser.

            Library('process')->view($html_string);
        }
    }

    function _create()
    {
        $data = '';
        $this->load->library('form_validation');

        $val = array(
            array('field' => 'menu_active', 'label' => 'Status', 'rules' => 'trim|required'),
            array('field' => 'menu_parent_id', 'label' => 'Parent Menu', 'rules' => 'trim|required'),
            array('field' => 'menu_title', 'label' => 'Title', 'rules' => 'trim|required'),
            array('field' => 'menu_link', 'label' => 'Link', 'rules' => 'trim'),
            array('field' => 'menu_params', 'label' => 'Params', 'rules' => 'trim'),
            array('field' => 'websites_id[]', 'label' => 'Websites', 'rules' => 'trim|required'),
            array('field' => 'menu_sort', 'label' => 'Sort Order', 'rules' => 'trim|required')
        );

        $this->form_validation->set_rules($val);

        if ($this->form_validation->run() == FALSE) {
            if (!validation_errors() == '' && $this->input->post('create') == 'Create') {
                $msg = array('error' => validation_errors());
                setMessages($msg, 'error');
            }
        }
        else
        {
            $menu_active = set_value('menu_active');
            $menu_parent_id = set_value('menu_parent_id');
            $menu_title = set_value('menu_title');
            $menu_link = set_value('menu_link');
            $menu_params = set_value('menu_params');
            $menu_sort = set_value('menu_sort');
            $websites_id = set_value('websites_id[]');
            $menu_type = $this->uri->segment(3, 'page');

            //if menu's link is not defined, then create one from menu's title
            if (empty($menu_link)) {
                $menu_link = preg_replace('/[^a-z0-9]+/i', '-', strtolower($menu_title));
            }

            //remove last dashes if any
            while (substr($menu_link, -1) == '-')
            {
                $menu_link = substr($menu_link, 0, -1);
            }

            $_menu_data = array(
                'menu_id' => '',
                'menu_active' => $menu_active,
                'menu_parent_id' => $menu_parent_id,
                'menu_link' => $menu_link,
                'menu_params' => $menu_params,
                'menu_title' => $menu_title,
                'menu_type' => $menu_type,
                'menu_meta_title' => '',
                'menu_meta_keywords' => '',
                'menu_meta_description' => '',
                'websites_id' => ',' . implode(',', (array)$websites_id) . ',',
                'menu_sort' => $menu_sort
            );

            //insert new menu to database
            $insert = Model('menu')->insert($_menu_data);
            /*
               if($insert)
               {
                   //if menu insert successful
                   $msg = array('success' => '<p>New Menu <strong>' . $menu_title . '</strong> Successfully Added.</p>');
                   setMessages($msg, 'success');
               }
               else
               {
                   //if menu insert unsuccessful
                   $msg = array('error' => "<p>Menu <strong>$menu_title</strong> already exists!</p>");
                   setMessages($msg, 'error');
               }
               */
        }

        $data['menu_array'] = (array)Library('menu')->get(array('menu_type' => $this->uri->segment(3, 'page')), true);
        $data['websites'] = Model('websites')->get_websites();

        //---
        $html_string = $this->load->view('admin/menu/menu_create_view', $data, true); //Get view data in place of sending to browser.

        Library('process')->view($html_string);
    }

    function _delete()
    {
        $data = '';

        if (isset($_POST['select'])) {
            $id_array = $_POST['select'];
        }
        else
        {
            $id_array = array();
            $msg = array('error' => '<p>You must select atleast one menu to delete.</p>');
            setMessages($msg, 'error');
        }

        !is_array($id_array) ? $id_array = array() : '';

        $msg = false;
        foreach ($id_array as $id)
        {
            $id = preg_replace('/[^0-9]+/', '', $id);

            if ($this->db->delete('menu', array('menu_id' => $id))) {
                $msg = array('success' => '<p>Selected menu(s) deleted successfully.</p>');
                $type = 'success';
            }
            else
            {
                $msg = array('success' => '<p>Error! couldn\'t delete..</p>');
                $type = 'error';
            }

        }
        if ($msg) setMessages($msg, $type);

        unset($_POST);

        $this->index();

    }

    function _edit()
    {

        $data = '';
        $id_array = array();

        if (!isset($_POST['menu'])) {
            if (isset($_POST['select'])) {
                $id_array = $_POST['select'];
            }
            else
            {
                //$data['error_message']['select'] = "You must select atleast one menu to edit";
                $msg = array('error' => '<p>You must select atleast one menu to edit.</p>');
                setMessages($msg, 'error');

                unset($_POST);
                $this->index();
                exit();
            }
        }

        !is_array($id_array) ? $id_array = array() : '';

        $menu_type = $this->uri->segment(3, 'page');

        //START: for the first page load, get data from database
        foreach ($id_array as $id)
        {
            $id = preg_replace('/[^0-9]+/', '', $id);

            $this->db->where('menu_id', $id);
            $query = $this->db->get('menu');

            foreach ($query->result() as $row)
            {
                $_POST['menu'][$row->menu_id]['id'] = $row->menu_id;
                $_POST['menu'][$row->menu_id]['menu_active'] = $row->menu_active;
                $_POST['menu'][$row->menu_id]['menu_parent_id'] = $row->menu_parent_id;
                $_POST['menu'][$row->menu_id]['menu_title'] = $row->menu_title;
                $_POST['menu'][$row->menu_id]['menu_link'] = $row->menu_link;
                $_POST['menu'][$row->menu_id]['menu_params'] = $row->menu_params;
                $_POST['menu'][$row->menu_id]['websites_id'] = $row->websites_id;
                $_POST['menu'][$row->menu_id]['menu_sort'] = $row->menu_sort;
            }
        }
        //END: for the first page load, get data from database

        //START: clean data and update in database
        if ($this->input->post('edit') == 'Update' && isset($_POST['menu']) && is_array($_POST['menu'])) {
            foreach ($_POST['menu'] as $v)
            {
                //cleaning
                $id = xss_clean($v['id']);
                $menu_active = xss_clean($v['menu_active']);
                $menu_parent_id = xss_clean($v['menu_parent_id']);
                $menu_title = ($v['menu_title']);
                $menu_link = ($v['menu_link']);
                $menu_params = ($v['menu_params']);
                $menu_sort = xss_clean($v['menu_sort']);
                $menu_type = $this->uri->segment(3, 'page');
                if(!isset($v['websites_id']))
                {
                    $v['websites_id'] = 0;
                }
                $websites_id = xss_clean($v['websites_id']);

                //If menu link is not defined, create one.
                if (empty($menu_link)) {
                    $menu_link = preg_replace('/[^a-z0-9]+/i', '-', strtolower($menu_title));
                }

                //remove last dashes if any
                while (substr($menu_link, -1) == '-')
                {
                    $menu_link = substr($menu_link, 0, -1);
                }

                //clean the data to autofill in form
                $_POST['menu'][$id]['id'] = $id;
                $_POST['menu'][$id]['menu_active'] = $menu_active;
                $_POST['menu'][$id]['menu_parent_id'] = $menu_parent_id;
                $_POST['menu'][$id]['menu_title'] = $menu_title;
                $_POST['menu'][$id]['menu_link'] = $menu_link;
                $_POST['menu'][$id]['menu_params'] = $menu_params;
                $_POST['menu'][$id]['menu_sort'] = $menu_sort;
                $_POST['menu'][$id]['websites_id'] = $websites_id;

                //update database if set
                if (!empty($menu_title) && !empty($menu_link) && !empty($id)) {
                    /*
                         $this->db->where('menu_id', $id);
                         $this->db->update('menu', array(
                                         'menu_active' => $menu_active,
                                         'menu_parent_id' => $menu_parent_id,
                                         'menu_title' => $menu_title,
                                         'menu_link' => $menu_link,
                                         'menu_type' => $menu_type,
                                         'menu_sort' => $menu_sort));
                         */
                    $_menu_data = array(
                        'menu_id' => $id,
                        'menu_active' => $menu_active,
                        'menu_parent_id' => $menu_parent_id,
                        'menu_link' => $menu_link,
                        'menu_params' => $menu_params,
                        'menu_title' => $menu_title,
                        'menu_type' => $menu_type,
                        'menu_meta_title' => '',
                        'menu_meta_keywords' => '',
                        'menu_meta_description' => '',
                        'websites_id' => ',' . implode(',', (array)$websites_id) . ',',
                        'menu_sort' => $menu_sort
                    );

                    //insert new menu to database
                    $insert = Model('menu')->update($_menu_data);
                }

                //['update']: to avoid repeated success_message
                /*
                    $msg = array('success' => '<p>Updated successfully.</p>');
                    setMessages($msg, 'success');
                    */
            }
        }
        //END: validate data and update in database

        //---
        $data['websites'] = Model('websites')->get_websites();
        $html_string = $this->load->view('admin/menu/menu_edit_view', $data, true); //Get view data in place of sending to browser.

        Library('process')->view($html_string);
    }
}
