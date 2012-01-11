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
 * @package     cf_user
 * @copyright   Copyright (c) 2010 Codefight CMS Team (http://codefight.org)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Admin User Controller
 */
class User extends MY_Controller
{
    public function __construct()
    {
        parent::MY_Controller();

        $this->load->helper(array('form', 'text'));
        $this->load->model('user/cf_user_model', 'usermodel');
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

            $assets = array();

            //load all required css
            //if media type not defined, screen is default.
            //$assets['css'] = array('admin','swiff','box','upload');
            $assets['css'] = array(
                'all' => array('admin', 'user', 'box')
            );
            //load all required js
            $assets['js'] = array();

            $this->cf_asset_lib->load($assets);

            /*
                * START: Pagination config and initialization
                */
            $this->load->library('pagination');
            $config['base_url'] = trim(site_url(), '/') . "/admin/user/index/";
            $config['total_rows'] = $this->usermodel->get_user_count();
            $config['per_page'] = '30';
            $config['uri_segment'] = 4;
            $config['num_links'] = 3;

            $this->pagination->initialize($config);
            //END: Pagination

            $data['pagination'] = $this->pagination->create_links();
            $data['user'] = $this->usermodel->get_user($config['per_page'], $this->uri->segment($config['uri_segment'], 0));

            //---
            $html_string = $this->load->view('admin/user/user_view', $data, true); //Get view data in place of sending to browser.

            $this->cf_process_lib->view($html_string);
        }
    }

    function _create()
    {
        $data = '';
        $this->load->library('form_validation');

        $val = array(
            array('field' => 'active', 'label' => 'Status', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|xss_clean|valid_email|callback__email_check'),
            array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|xss_clean|md5'),
            array('field' => 'group_id', 'label' => 'Group', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'is_admin', 'label' => 'Is Admin', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'is_author', 'label' => 'Is Author', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'firstname', 'label' => 'First Name', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'lastname', 'label' => 'Last Name', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'profile_link', 'label' => 'Profile Link', 'rules' => 'trim|xss_clean')
        );

        $this->form_validation->set_rules($val);

        if ($this->form_validation->run() == FALSE) {
            if (!validation_errors() == '' && $this->input->post('create') == 'Create') {
                $msg = array('error' => validation_errors());
                set_global_messages($msg, 'error');
            }

        }
        else
        {
            $active = set_value('active');
            $email = set_value('email');
            $password = set_value('password');
            $firstname = set_value('firstname');
            $lastname = set_value('lastname');
            $profile_link = set_value('profile_link');
            $group_id = set_value('group_id');
            $is_admin = set_value('is_admin');
            $is_author = set_value('is_author');

            $user_exists = (array)$this->usermodel->user_exists($email);
            //$insert = $this->usermodel->insert($active, $email, $password, $firstname, $lastname, $group_id);

            if (!count($user_exists))
            {
                $my_data = array(
                    'active' => $active,
                    'email' => $email,
                    'password' => $password,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'profile_link' => $profile_link,
                    'group_id' => $group_id,
                    'is_admin' => $is_admin,
                    'is_author' => $is_author,
                );

                $save = $this
                            ->usermodel
                            ->reset()
                            ->set('table', 'user')
                            ->set('action', 'insert')
                            ->save($my_data);

                if($save)
                {
                    $msg = array('success' => '<p>New User <strong>' . $firstname . ' ' . $lastname . '</strong> Successfully Added.</p>');
                    set_global_messages($msg, 'success');
                }
            }
            else
            {
                $msg = array('error' => '<p>User with email <strong>$email</strong> already exists!.</p>');
                set_global_messages($msg, 'error');
            }
        }

        $assets = array();

        //load all required css
        //if media type not defined, screen is default.
        //$assets['css'] = array('admin','swiff','box','upload');
        $assets['css'] = array(
            'all' => array('admin', 'user', 'box')
        );
        //load all required js
        $assets['js'] = array();

        $this->cf_asset_lib->load($assets);

        //---
        $html_string = $this->load->view('admin/user/user_create_view', $data, true); //Get view data in place of sending to browser.

        $this->cf_process_lib->view($html_string);
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

            $msg = array('error' => '<p>You must select atleast one user to delete.</p>');
            set_global_messages($msg, 'error');
        }

        !is_array($id_array) ? $id_array = array() : '';

        foreach ($id_array as $id)
        {
            $id = preg_replace('/[^0-9]+/', '', $id);
            $this->db->delete('user', array('user_id' => $id));

            if ($this->db->affected_rows()) {
                $msg = array('success' => '<p>Selected user(s) deleted successfully.</p>');
                set_global_messages($msg, 'success');
            }
            else
            {
                $msg = array('error' => '<p>Error! couldn\'t delete.</p>');
                set_global_messages($msg, 'error');
            }
        }

        unset($_POST);

        $this->index();
    }

    function _edit()
    {
        $this->load->library('form_validation');

        $data = '';
        $success_count = 1;
        $id_array = array();

        if (!isset($_POST['user'])) {
            if (isset($_POST['select'])) {
                $id_array = $_POST['select'];
            }
            else
            {
                $msg = array('error' => '<p>You must select atleast one user to edit.</p>');
                set_global_messages($msg, 'error');

                unset($_POST);
                $this->index();
                exit();
            }
        }

        !is_array($id_array) ? $id_array = array() : '';

        //START: for the first page load, get data from database
        foreach ($id_array as $id)
        {

            $id = preg_replace('/[^0-9]+/', '', $id);

            $this->db->where('user_id', $id);
            $query = $this->db->get('user');

            foreach ($query->result() as $row)
            {
                $_POST['user'][$row->user_id]['id'] = $row->user_id;
                $_POST['user'][$row->user_id]['active'] = $row->active;
                $_POST['user'][$row->user_id]['email'] = $row->email;
                $_POST['user'][$row->user_id]['firstname'] = $row->firstname;
                $_POST['user'][$row->user_id]['lastname'] = $row->lastname;
                $_POST['user'][$row->user_id]['group_id'] = $row->group_id;
                $_POST['user'][$row->user_id]['is_admin'] = $row->is_admin;
                $_POST['user'][$row->user_id]['is_author'] = $row->is_author;
                $_POST['user'][$row->user_id]['profile_link'] = $row->profile_link;
                //$_POST['user'][$row->user_id]['password'] = $row->password;
            }
        }
        //END: for the first page load, get data from database

        //START: clean data and update in database
        if ($this->input->post('edit') == 'Update' && isset($_POST['user']) && is_array($_POST['user'])) {
            foreach ($_POST['user'] as $v)
            {
                //cleaning
                $id = (int)preg_replace('/[^0-9]+/', '', $v['id']); //only intergers
                $active = (int)preg_replace('/[^0-9]+/', '', $v['active']);
                $email = xss_clean($v['email']);
                $firstname = xss_clean($v['firstname']);
                $lastname = xss_clean($v['lastname']);
                $profile_link = xss_clean($v['profile_link']);
                $is_author = (int)preg_replace('/[^0-9]+/', '', $v['is_author']);
                $is_admin = (int)preg_replace('/[^0-9]+/', '', $v['is_admin']);
                $group_id = (int)preg_replace('/[^0-9]+/', '', $v['group_id']);
                $password = xss_clean($v['password']);

                //clean the data to autofill in form
                $_POST['user'][$id]['id'] = $id;
                $_POST['user'][$id]['active'] = $active;
                $_POST['user'][$id]['email'] = $email;
                $_POST['user'][$id]['firstname'] = $firstname;
                $_POST['user'][$id]['lastname'] = $lastname;
                $_POST['user'][$id]['is_admin'] = $is_admin;
                $_POST['user'][$id]['is_author'] = $is_author;
                $_POST['user'][$id]['group_id'] = $group_id;
                $_POST['user'][$id]['password'] = $password;
                $_POST['user'][$id]['profile_link'] = $profile_link;

                //update database if set
                if (!empty($email) && !empty($group_id) && !empty($id)) {
                    $_POST['email'] = $email;
                    $_POST['is_admin'] = $is_admin;
                    $_POST['is_author'] = $is_author;
                    $_POST['group_id'] = $group_id;
                    $_POST['firstname'] = $firstname;
                    $_POST['lastname'] = $lastname;
                    $_POST['password'] = $password;
                    $_POST['profile_link'] = $profile_link;

                    $val = array(
                        array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|xss_clean|valid_email'),
                        array('field' => 'is_admin', 'label' => 'Is Admin', 'rules' => 'trim|required|xss_clean'),
                        array('field' => 'is_author', 'label' => 'Is Author', 'rules' => 'trim|required|xss_clean'),
                        array('field' => 'group_id', 'label' => 'Group', 'rules' => 'trim|required|xss_clean'),
                        array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|xss_clean|md5'),
                        array('field' => 'firstname', 'label' => 'First Name', 'rules' => 'trim|required|xss_clean'),
                        array('field' => 'lastname', 'label' => 'Last Name', 'rules' => 'trim|required|xss_clean'),
                        array('field' => 'profile_link', 'label' => 'Profile Link', 'rules' => 'trim|xss_clean')
                    );

                    $this->form_validation->set_rules($val);

                    if ($this->form_validation->run() == FALSE) {
                        if (!validation_errors() == '' && $this->input->post('edit') == 'Update') {
                            $msg = array('error' => validation_errors());
                            set_global_messages($msg, 'error');
                        }
                    }
                    else
                    {
                        $my_data = array(
                            'active' => $active,
                            'email' => set_value('email'),
                            'user_id' => $id,
                            'firstname' => set_value('firstname'),
                            'lastname' => set_value('lastname'),
                            'profile_link' => set_value('profile_link'),
                            'is_author' => set_value('is_author'),
                            'is_admin' => set_value('is_admin'),
                            'group_id' => set_value('group_id'),
                        );

                        if (!empty($password)) $my_data['password'] = set_value('password');

                        $save = $this
                                    ->usermodel
                                    ->reset()
                                    ->set('table', 'user')
                                    ->set('action', 'update')
                                    ->save($my_data);

                        if($save)
                        {
                            $msg = array('success' => '<p>' . $success_count++ . ' Records Updated successfully.</p>');
                            set_global_messages($msg, 'success', false);
                        }
                    }
                }
                else
                {
                    $msg = array('error' => '<p>Required fields can not be empty!</p>');
                    set_global_messages($msg, 'error');
                }
            }
        }
        //END: validate data and update in database

        $assets = array();

        //load all required css
        //if media type not defined, screen is default.
        //$assets['css'] = array('admin','swiff','box','upload');
        $assets['css'] = array(
            'all' => array('admin', 'user', 'box')
        );
        //load all required js
        $assets['js'] = array();

        $this->cf_asset_lib->load($assets);

        //---
        $html_string = $this->load->view('admin/user/user_edit_view', $data, true); //Get view data in place of sending to browser.

        $this->cf_process_lib->view($html_string);
    }

    function _email_check($str)
    {
        $this->db->where('email', $str);
        $this->db->from('user');
        if ($this->db->count_all_results()) {
            $this->form_validation->set_message('_email_check', 'A User with such email is already registered');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

}