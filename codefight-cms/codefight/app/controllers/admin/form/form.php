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
 * @package     cf_form
 * @copyright   Copyright (c) 2010 Codefight CMS Team (http://codefight.org)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Admin Form Form Controller
 */
class Form extends MY_Controller
{

    function __construct()
    {
        parent::MY_Controller();

        $this->load->helper(array('form', 'text'));
        $this->load->model(array('cf_menu_model', 'cf_form_model'));

    }

    function index()
    {
        redirect('admin/form/item');
    }

    function _submit_read()
    {
        if ($this->input->post('read')) {
            $selected = $this->input->post('select');
            if (is_array($selected)) foreach ($selected as $v)
            {
                $this->db->update('form_submitted', array('form_status' => '1'), array('form_submitted_id' => $v));
            }
        }

        unset($_POST);
        $this->submitted();
    }

    function _submit_unread()
    {
        if ($this->input->post('unread')) {
            $selected = $this->input->post('select');
            if (is_array($selected)) foreach ($selected as $v)
            {
                $this->db->update('form_submitted', array('form_status' => '0'), array('form_submitted_id' => $v));
            }
        }

        unset($_POST);
        $this->submitted();
    }

    function _submit_delete()
    {
        if ($this->input->post('delete')) {
            $selected = $this->input->post('select');
            if (is_array($selected)) foreach ($selected as $v)
            {
                $this->db->delete('form_submitted', array('form_submitted_id' => $v));
                $this->db->delete('form_data_int', array('form_submitted_id' => $v));
                $this->db->delete('form_data_varchar', array('form_submitted_id' => $v));
                $this->db->delete('form_data_text', array('form_submitted_id' => $v));
            }
        }

        unset($_POST);
        $this->submitted();
    }

    function submitted()
    {
        if (isset($_POST['read'])) {
            $this->_submit_read();
        }
        else if (isset($_POST['delete'])) {
            $this->_submit_delete();
        }
        else if (isset($_POST['unread'])) {
            $this->_submit_unread();
        }
        else
        {

            $id = $this->uri->segment(4);

            $read = '';
            if ($id) {
                $read = '_read';
                $this->db->set('form_status', '1');
                $this->db->where('form_submitted_id', $id);
                $this->db->update('form_submitted');
            }

            /*
                *TODO:: Not sure how to join tables, replace after finding solution.
                * For now doing dodgy way :|
                * Please let me know, if you know how...
                * Currently its the worst code.
                *
                * Also, need to display message reading item on sort order.
                */
            $submits = array();
            $gridTitle = array();

            $this->db->select('*');
            if ($id) $this->db->where('form_submitted.form_submitted_id', $id);
            $this->db->from('form_submitted');
            $this->db->join('form_data_int', 'form_submitted.form_submitted_id = form_data_int.form_submitted_id');

            $this->db->order_by('form_submitted.form_submitted_id', 'desc');
            $query = $this->db->get();
            $submitted = $query->result_array();
            $query->free_result();
            //$form_group_name = false;

            if (count($submitted)) foreach ($submitted as $v)
            {
                //---
                $submits[$v['form_submitted_id']]['status'] = $v['form_status'];
                $submits[$v['form_submitted_id']][$v['form_item_id']]['item_id'] = $v['form_item_id'];
                $submits[$v['form_submitted_id']][$v['form_item_id']]['data'] = $v['form_item_data'];
                $submits[$v['form_submitted_id']][$v['form_item_id']]['id'] = $v['form_submitted_id'];

                if (!isset($submits[$v['form_submitted_id']]['group_name'])) {
                    $this->db->select('form_group_name');
                    $this->db->where('form_group_id', $v['form_group_id']);
                    $this->db->from('form_group');
                    $query = $this->db->get();
                    $row = $query->result_array();
                    $query->free_result();

                    //this line is to avoid re-hitting db :|
                    $submits[$v['form_submitted_id']]['group_name'] = $row[0]['form_group_name'];
                }

                if (!isset($submits[$v['form_submitted_id']][$v['form_item_id']]['label'])) {
                    $this->db->select('form_item_label, form_item_grid');
                    $this->db->where('form_item_id', $v['form_item_id']);
                    $this->db->from('form_item');
                    $query = $this->db->get();
                    $row = $query->result_array();
                    $query->free_result();
                    if (isset($row[0]['form_item_label'])) $submits[$v['form_submitted_id']][$v['form_item_id']]['label'] = $row[0]['form_item_label'];

                    if ($row[0]['form_item_grid']) {
                        $submits[$v['form_submitted_id']]['list'][$row[0]['form_item_label']]['label'] = $row[0]['form_item_label'];
                        $submits[$v['form_submitted_id']]['list'][$row[0]['form_item_label']]['data'] = $submits[$v['form_submitted_id']][$v['form_item_id']]['data'];

                        if (!in_array($row[0]['form_item_label'], $gridTitle)) $gridTitle[$row[0]['form_item_label']] = $row[0]['form_item_label'];
                    }
                }
            }

            $this->db->select('*');
            if ($id) $this->db->where('form_submitted.form_submitted_id', $id);
            $this->db->from('form_submitted');
            $this->db->join('form_data_varchar', 'form_data_varchar.form_submitted_id = form_submitted.form_submitted_id');

            $this->db->order_by('form_submitted.form_submitted_id', 'desc');
            $query = $this->db->get();
            $submitted = $query->result_array();
            $query->free_result();

            if (count($submitted)) foreach ($submitted as $v)
            {
                //---
                $submits[$v['form_submitted_id']]['status'] = $v['form_status'];
                $submits[$v['form_submitted_id']][$v['form_item_id']]['item_id'] = $v['form_item_id'];
                $submits[$v['form_submitted_id']][$v['form_item_id']]['data'] = $v['form_item_data'];
                $submits[$v['form_submitted_id']][$v['form_item_id']]['id'] = $v['form_submitted_id'];

                if (!isset($submits[$v['form_submitted_id']]['group_name'])) {
                    $this->db->select('form_group_name');
                    $this->db->where('form_group_id', $v['form_group_id']);
                    $this->db->from('form_group');
                    $query = $this->db->get();
                    $row = $query->result_array();
                    $query->free_result();

                    //this line is to avoid re-hitting db :|
                    $submits[$v['form_submitted_id']]['group_name'] = $row[0]['form_group_name'];
                }

                if (!isset($submits[$v['form_submitted_id']][$v['form_item_id']]['label'])) {
                    $this->db->select('form_item_label, form_item_grid');
                    $this->db->where('form_item_id', $v['form_item_id']);
                    $this->db->from('form_item');
                    $query = $this->db->get();
                    $row = $query->result_array();
                    $query->free_result();
                    if (isset($row[0]['form_item_label'])) $submits[$v['form_submitted_id']][$v['form_item_id']]['label'] = $row[0]['form_item_label'];

                    if ($row[0]['form_item_grid']) {
                        $submits[$v['form_submitted_id']]['list'][$row[0]['form_item_label']]['label'] = $row[0]['form_item_label'];
                        $submits[$v['form_submitted_id']]['list'][$row[0]['form_item_label']]['data'] = $submits[$v['form_submitted_id']][$v['form_item_id']]['data'];

                        if (!in_array($row[0]['form_item_label'], $gridTitle)) $gridTitle[$row[0]['form_item_label']] = $row[0]['form_item_label'];
                    }
                }
            }

            $this->db->select('*');
            if ($id) $this->db->where('form_submitted.form_submitted_id', $id);
            $this->db->from('form_submitted');
            $this->db->join('form_data_text', 'form_data_text.form_submitted_id = form_submitted.form_submitted_id');

            $this->db->order_by('form_submitted.form_submitted_id', 'desc');
            $query = $this->db->get();
            $submitted = $query->result_array();
            $query->free_result();

            if (count($submitted)) foreach ($submitted as $v)
            {
                //---
                $submits[$v['form_submitted_id']]['status'] = $v['form_status'];
                $submits[$v['form_submitted_id']][$v['form_item_id']]['item_id'] = $v['form_item_id'];
                $submits[$v['form_submitted_id']][$v['form_item_id']]['data'] = $v['form_item_data'];
                $submits[$v['form_submitted_id']][$v['form_item_id']]['id'] = $v['form_submitted_id'];

                if (!isset($submits[$v['form_submitted_id']]['group_name'])) {
                    $this->db->select('form_group_name');
                    $this->db->where('form_group_id', $v['form_group_id']);
                    $this->db->from('form_group');
                    $query = $this->db->get();
                    $row = $query->result_array();
                    $query->free_result();

                    //this line is to avoid re-hitting db :|
                    $submits[$v['form_submitted_id']]['group_name'] = $row[0]['form_group_name'];
                }

                if (!isset($submits[$v['form_submitted_id']][$v['form_item_id']]['label'])) {
                    $this->db->select('form_item_label, form_item_grid');
                    $this->db->where('form_item_id', $v['form_item_id']);
                    $this->db->from('form_item');
                    $query = $this->db->get();
                    $row = $query->result_array();
                    $query->free_result();
                    if (isset($row[0]['form_item_label'])) $submits[$v['form_submitted_id']][$v['form_item_id']]['label'] = $row[0]['form_item_label'];

                    if ($row[0]['form_item_grid']) {
                        $submits[$v['form_submitted_id']]['list'][$row[0]['form_item_label']]['label'] = $row[0]['form_item_label'];
                        $submits[$v['form_submitted_id']]['list'][$row[0]['form_item_label']]['data'] = $submits[$v['form_submitted_id']][$v['form_item_id']]['data'];

                        if (!in_array($row[0]['form_item_label'], $gridTitle)) $gridTitle[$row[0]['form_item_label']] = $row[0]['form_item_label'];
                    }
                }
            }

            $data['submitted'] = $submits;
            $data['gridTitle'] = $gridTitle;


            //load all required css
            $assets['css'] = array(
                'all' => array('admin', 'group', 'box')
            );
            //load all required js
            $assets['js'] = array('jquery');

            $this->cf_asset_lib->load($assets);

            //---
            $html_string = $this->load->view("admin/form/form_submitted{$read}_view", $data, true); //Get view data in place of sending to browser.

            $this->cf_process_lib->view($html_string);
        }
    }

    function item()
    {
        if (isset($_POST['create'])) {
            $this->_item_create();
        }
        else if (isset($_POST['delete'])) {
            $this->_item_delete();
        }
        else if (isset($_POST['edit'])) {
            $this->_item_edit();
        }
        else
        {
            $data = '';

            //load all required css
            $assets['css'] = array(
                'all' => array('admin', 'group', 'box')
            );
            //load all required js
            $assets['js'] = array('jquery');

            $this->cf_asset_lib->load($assets);

            $data['keys'] = $this->cf_form_model->get_form_item();

            //---
            $html_string = $this->load->view('admin/form/form_item_view', $data, true); //Get view data in place of sending to browser.

            $this->cf_process_lib->view($html_string);
        }
    }

    function _item_create()
    {
        $data = '';

        $this->load->library('form_validation');

        $val = array(
            array(
                'field' => 'form_item_name',
                'label' => 'Form Item Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'form_item_label',
                'label' => 'Form Label',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'form_item_input_type',
                'label' => 'Form Input Type',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'form_item_validations',
                'label' => 'Form Validations',
                'rules' => 'trim'
            ),
            array(
                'field' => 'form_item_default_value',
                'label' => 'Form Default Value',
                'rules' => 'trim'
            ),
            array(
                'field' => 'form_item_parameters',
                'label' => 'Form Parameters',
                'rules' => 'trim'
            ),
            array(
                'field' => 'form_item_data_type',
                'label' => 'Data Type',
                'rules' => 'trim|required'
            )
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
            $form_item_label = set_value('form_item_label');
            $form_item_input_type = set_value('form_item_input_type');
            $form_item_name = set_value('form_item_name');
            $form_item_validations = set_value('form_item_validations');
            $form_item_default_value = set_value('form_item_default_value');
            $form_item_parameters = set_value('form_item_parameters');
            $form_item_data_type = set_value('form_item_data_type');

            $insert = $this->cf_form_model->insert_form_item(array(
                                                                  'form_item_label' => $form_item_label,
                                                                  'form_item_name' => $form_item_name,
                                                                  'form_item_input_type' => $form_item_input_type,
                                                                  'form_item_validations' => $form_item_validations,
                                                                  'form_item_default_value' => $form_item_default_value,
                                                                  'form_item_parameters' => $form_item_parameters,
                                                                  'form_item_data_type' => $form_item_data_type
                                                             ));

            if ($insert) {
                $msg = array('success' => '<p>New Form Item <strong>' . $form_item_label . '</strong> Successfully Added.</p>');
                set_global_messages($msg, 'success');
            }
            else
            {
                $msg = array('error' => '<p>Form Item <strong>' . $form_item_label . '</strong> already exists!</p>');
                set_global_messages($msg, 'error');
            }
        }

        //load all required css
        $assets['css'] = array(
            'all' => array('admin', 'group', 'box')
        );
        //load all required js
        $assets['js'] = array('jquery');

        $this->cf_asset_lib->load($assets);

        //---
        $html_string = $this->load->view('admin/form/form_item_create_view', $data, true); //Get view data in place of sending to browser.

        $this->cf_process_lib->view($html_string);
    }

    function _item_delete()
    {
        $data = '';

        if (isset($_POST['select'])) {
            $id_array = $_POST['select'];
        }
        else
        {
            $id_array = array();
            $msg = array('error' => '<p>You must select atleast one item to delete.</p>');
            set_global_messages($msg, 'error');
        }

        !is_array($id_array) ? $id_array = array() : '';

        $msg = false;
        foreach ($id_array as $id)
        {
            $id = preg_replace('/[^0-9]+/', '', $id);

            if ($this->db->delete('form_item', array('form_item_id' => $id))) {
                $msg = array('success' => '<p>Selected item(s) deleted successfully.</p>');
                $type = 'success';
            }
            else
            {
                $msg = array('error' => '<p>Error! couldn\'t delete.</p>');
                $type = 'error';
            }
        }

        if ($msg) set_global_messages($msg, $type);

        unset($_POST);

        $this->item();

    }

    function _item_edit()
    {
        $data = '';
        $id_array = array();

        if (!isset($_POST['item'])) { //i.e. if its not submitting edit page (form_item_edit_view.php)
            if (isset($_POST['select'])) {
                $id_array = $_POST['select'];
            }
            else
            {
                $msg = array('error' => '<p>You must select atleast one item to edit.</p>');
                set_global_messages($msg, 'error');

                unset($_POST);
                $this->item();
                exit();
            }
        }

        !is_array($id_array) ? $id_array = array() : '';

        //START: for the first page load, get data from database
        foreach ($id_array as $id) {

            $id = preg_replace('/[^0-9]+/', '', $id);

            $this->db->where('form_item_id', $id);
            $query = $this->db->get('form_item');

            foreach ($query->result() as $row)
            {
                $_POST['item'][$row->form_item_id]['form_item_id'] = $row->form_item_id;
                $_POST['item'][$row->form_item_id]['form_item_label'] = $row->form_item_label;
                $_POST['item'][$row->form_item_id]['form_item_name'] = $row->form_item_name;
                $_POST['item'][$row->form_item_id]['form_item_input_type'] = $row->form_item_input_type;
                $_POST['item'][$row->form_item_id]['form_item_validations'] = $row->form_item_validations;
                $_POST['item'][$row->form_item_id]['form_item_default_value'] = $row->form_item_default_value;
                $_POST['item'][$row->form_item_id]['form_item_parameters'] = $row->form_item_parameters;
                $_POST['item'][$row->form_item_id]['form_item_data_type'] = $row->form_item_data_type;
            }
        }
        //END: for the first page load, get data from database

        //START: clean data and update in database
        if ($this->input->post('edit') == 'Update' && isset($_POST['item']) && is_array($_POST['item'])) {
            foreach ($_POST['item'] as $v) {
                //cleaning
                $form_item_id = $v['form_item_id'];

                //clean the data to autofill in form
                $_POST['item'][$form_item_id]['form_item_id'] = $form_item_id;
                $_POST['item'][$form_item_id]['form_item_label'] = $v['form_item_label'];
                $_POST['item'][$form_item_id]['form_item_name'] = $v['form_item_name'];
                $_POST['item'][$form_item_id]['form_item_input_type'] = $v['form_item_input_type'];
                $_POST['item'][$form_item_id]['form_item_validations'] = $v['form_item_validations'];
                $_POST['item'][$form_item_id]['form_item_default_value'] = $v['form_item_default_value'];
                $_POST['item'][$form_item_id]['form_item_parameters'] = $v['form_item_parameters'];
                $_POST['item'][$form_item_id]['form_item_data_type'] = $v['form_item_data_type'];

                //update database if set
                if (!empty($v['form_item_name']) && !empty($v['form_item_label']) && !empty($v['form_item_id'])) {
                    $this->db->where('form_item_id', $v['form_item_id']);
                    $this->db->update('form_item', array(
                                                        'form_item_label' => $v['form_item_label'],
                                                        'form_item_name' => $v['form_item_name'],
                                                        'form_item_input_type' => $v['form_item_input_type'],
                                                        'form_item_parameters' => $v['form_item_parameters'],
                                                        'form_item_validations' => $v['form_item_validations'],
                                                        'form_item_default_value' => $v['form_item_default_value'],
                                                        'form_item_data_type' => $v['form_item_data_type']
                                                   )
                    );
                }

                $msg = array('success' => '<p>Updated successfully.</p>');
                set_global_messages($msg, 'success');

            }
        }
        //END: validate data and update in database

        $assets = array();

        //load all required css
        //if media type not defined, screen is default.
        //$assets['css'] = array('admin','swiff','box','upload');
        $assets['css'] = array(
            'all' => array('admin', 'group', 'box')
        );
        //load all required js
        $assets['js'] = array('jquery');

        $this->cf_asset_lib->load($assets);

        //---
        $html_string = $this->load->view('admin/form/form_item_edit_view', $data, true); //Get view data in place of sending to browser.

        $this->cf_process_lib->view($html_string);
    }


    function group()
    {
        if (isset($_POST['create'])) {
            $this->_group_create();
        }
        else if (isset($_POST['delete'])) {
            $this->_group_delete();
        }
        else if (isset($_POST['edit'])) {
            $this->_group_edit();
        }
        else if (isset($_POST['add_item'])) {
            $this->_manage_group_item();
        }
        else
        {
            $data = '';

            //load all required css
            $assets['css'] = array(
                'all' => array('admin', 'group', 'box')
            );
            //load all required js
            $assets['js'] = array('jquery');

            $this->cf_asset_lib->load($assets);

            $data['keys'] = $this->cf_form_model->get_form_group();

            //---
            $html_string = $this->load->view('admin/form/form_group_view', $data, true); //Get view data in place of sending to browser.

            $this->cf_process_lib->view($html_string);
        }
    }

    function _group_create()
    {
        $data = '';

        $this->load->library('form_validation');

        $val = array(
            array(
                'field' => 'form_group_name',
                'label' => 'Form Group Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'form_group_identifier',
                'label' => 'Form Group Indentifier',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'form_group_send_to',
                'label' => 'Form Group Send To',
                'rules' => 'trim|required|valid_emails'
            )
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
            $form_group_name = set_value('form_group_name');
            $form_group_identifier = set_value('form_group_identifier');
            $form_group_send_to = set_value('form_group_send_to');

            $insert = $this->cf_form_model->insert_form_group(array(
                                                                   'form_group_name' => $form_group_name,
                                                                   'form_group_identifier' => $form_group_identifier,
                                                                   'form_group_send_to' => $form_group_send_to
                                                              ));

            if ($insert) {
                $msg = array('success' => "<p>New Form Group <strong>$form_group_name</strong> Successfully Added.</p>");
                set_global_messages($msg, 'success');
            }
            else
            {
                $msg = array('error' => "<p>Form Group Indetifier <strong>$form_group_identifier</strong> already exists!</p>");
                set_global_messages($msg, 'error');
            }
        }

        //load all required css
        $assets['css'] = array(
            'all' => array('admin', 'group', 'box')
        );
        //load all required js
        $assets['js'] = array('jquery');

        $this->cf_asset_lib->load($assets);

        //---
        $html_string = $this->load->view('admin/form/form_group_create_view', $data, true); //Get view data in place of sending to browser.

        $this->cf_process_lib->view($html_string);
    }

    function _group_delete()
    {
        $data = '';

        if (isset($_POST['select'])) {
            $id_array = $_POST['select'];
        }
        else
        {
            $id_array = array();
            $msg = array('error' => '<p>You must select atleast one item to delete.</p>');
            set_global_messages($msg, 'error');
        }

        !is_array($id_array) ? $id_array = array() : '';

        foreach ($id_array as $id)
        {
            $id = preg_replace('/[^0-9]+/', '', $id);

            if ($this->db->delete('form_group', array('form_group_id' => $id))) {
                $this->db->delete('form_item_to_group', array('form_group_id' => $id));
                $msg = array('success' => '<p>Selected item(s) deleted successfully.</p>');
                set_global_messages($msg, 'success');
            }
            else
            {
                $msg = array('error' => '<p>Error! couldn\'t delete.</p>');
                set_global_messages($msg, 'error');
            }
        }

        unset($_POST);

        $this->group();

    }

    function _group_edit()
    {
        $data = '';
        $id_array = array();

        //if its not submitting edit page (form_item_edit_view.php)
        if (!isset($_POST['group'])) {
            if (isset($_POST['select'])) {
                $id_array = $_POST['select'];
            }
            else
            {
                $msg = array('error' => '<p>You must select atleast one item to edit.</p>');
                set_global_messages($msg, 'error');

                unset($_POST);
                $this->group();
                exit();

            }
        }

        !is_array($id_array) ? $id_array = array() : '';

        //START: for the first page load, get data from database
        foreach ($id_array as $id)
        {

            $id = preg_replace('/[^0-9]+/', '', $id);

            $this->db->where('form_group_id', $id);
            $query = $this->db->get('form_group');

            foreach ($query->result() as $row)
            {
                $_POST['group'][$row->form_group_id]['form_group_id'] = $row->form_group_id;
                $_POST['group'][$row->form_group_id]['form_group_name'] = $row->form_group_name;
                $_POST['group'][$row->form_group_id]['form_group_identifier'] = $row->form_group_identifier;
                $_POST['group'][$row->form_group_id]['form_group_send_to'] = $row->form_group_send_to;
            }
        }
        //END: for the first page load, get data from database

        //START: clean data and update in database
        if ($this->input->post('edit') == 'Update' && isset($_POST['group']) && is_array($_POST['group'])) {
            foreach ($_POST['group'] as $v)
            {
                //cleaning
                $form_group_id = $v['form_group_id'];

                //clean the data to autofill in form
                $_POST['group'][$form_group_id]['form_group_id'] = $form_group_id;
                $_POST['group'][$form_group_id]['form_group_name'] = $v['form_group_name'];
                $_POST['group'][$form_group_id]['form_group_identifier'] = $v['form_group_identifier'];
                $_POST['group'][$form_group_id]['form_group_send_to'] = $v['form_group_send_to'];

                //update database if set
                if (!empty($v['form_group_name']) && !empty($v['form_group_identifier']) && !empty($v['form_group_id'])) {
                    $this->db->where('form_group_id', $v['form_group_id']);
                    $this->db->update('form_group', array(
                                                         'form_group_name' => $v['form_group_name'],
                                                         'form_group_identifier' => $v['form_group_identifier'],
                                                         'form_group_send_to' => $v['form_group_send_to']
                                                    )
                    );
                }

                //['update']: to avoid repeated success_message
                $msg = array('success' => '<p>Updated successfully.</p>');
                set_global_messages($msg, 'success');

            }
        }
        //END: validate data and update in database

        $assets = array();

        //load all required css
        //if media type not defined, screen is default.
        //$assets['css'] = array('admin','swiff','box','upload');
        $assets['css'] = array(
            'all' => array('admin', 'group', 'box')
        );
        //load all required js
        $assets['js'] = array('jquery');

        $this->cf_asset_lib->load($assets);

        //---
        $html_string = $this->load->view('admin/form/form_group_edit_view', $data, true); //Get view data in place of sending to browser.

        $this->cf_process_lib->view($html_string);
    }

    function _manage_group_item()
    {
        $data = '';
        $id_array = array();

        //if its not submitting edit page (form_item_edit_view.php)
        if (!isset($_POST['group'])) {
            if (isset($_POST['select'])) {
                $id_array = $_POST['select'];
            }
            else
            {
                $msg = array('error' => '<p>You must select atleast one item to edit.</p>');
                set_global_messages($msg, 'error');

                unset($_POST);
                $this->group();
                exit();
            }
        }

        !is_array($id_array) ? $id_array = array() : '';

        //START: for the first page load, get data from database
        foreach ($id_array as $id)
        {
            $id = preg_replace('/[^0-9]+/', '', $id);

            $this->db->where('form_group_id', $id);
            $query = $this->db->get('form_group');

            foreach ($query->result() as $row)
            {
                $_POST['group'][$row->form_group_id]['form_group_id'] = $row->form_group_id;
                $_POST['group'][$row->form_group_id]['form_group_name'] = $row->form_group_name;
                $_POST['group'][$row->form_group_id]['form_group_identifier'] = $row->form_group_identifier;
                $_POST['group'][$row->form_group_id]['form_group_send_to'] = $row->form_group_send_to;
            }
        }
        //END: for the first page load, get data from database

        //START: clean data and update in database
        if ($this->input->post('edit') == 'Update' && isset($_POST['group']) && is_array($_POST['group'])) {
            foreach ($_POST['group'] as $v)
            {
                //cleaning
                $form_group_id = $v['form_group_id'];

                //clean the data to autofill in form
                $_POST['group'][$form_group_id]['form_group_id'] = $form_group_id;
                $_POST['group'][$form_group_id]['form_group_name'] = $v['form_group_name'];
                $_POST['group'][$form_group_id]['form_group_identifier'] = $v['form_group_identifier'];
                $_POST['group'][$form_group_id]['form_group_send_to'] = $v['form_group_send_to'];

                //update database if set
                if (!empty($v['form_group_name']) && !empty($v['form_group_identifier']) && !empty($v['form_group_id'])) {
                    $this->db->where('form_group_id', $v['form_group_id']);
                    $this->db->update('form_group', array(
                                                         'form_group_name' => $v['form_group_name'],
                                                         'form_group_identifier' => $v['form_group_identifier'],
                                                         'form_group_send_to' => $v['form_group_send_to']
                                                    )
                    );
                }

                //['update']: to avoid repeated success_message
                $msg = array('success' => '<p>Updated successfully.</p>');
                set_global_messages($msg, 'success');

            }
        }
        //END: validate data and update in database

        $assets = array();

        //load all required css
        //if media type not defined, screen is default.
        //$assets['css'] = array('admin','swiff','box','upload');
        $assets['css'] = array(
            'all' => array('admin', 'group', 'box')
        );
        //load all required js
        $assets['js'] = array('jquery');

        $this->cf_asset_lib->load($assets);

        //---
        $html_string = $this->load->view('admin/form/form_group_item_manage_view', $data, true); //Get view data in place of sending to browser.

        $this->cf_process_lib->view($html_string);
    }
}