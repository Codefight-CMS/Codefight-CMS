<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 *
 */
class Login_Library extends MY_Library
{
    function redirect(){
        $isLogin = $this->CI()->session->userdata('isLogin');
        $backUrl = $this->CI()->session->userdata('backUrl');

        if(!empty($isLogin)){
            empty($backUrl) ? $backUrl = 'home' : '';
            $this->CI()->session->unset_userdata('isLogin');
            redirect($backUrl);
        }
        return TRUE;
    }

    function check_login($access = array())
    {
        $access = (array)$access;

        if ($this->CI()->session->userdata('logged_in') === '1') {

            $data = $this->CI()->session->userdata('loggedData');

            if (in_array($data['group_id'], $access)) {
                $this->CI()->db->where(array('email' => $data['email'], 'password' => $data['password'], 'group_id' => $data['group_id']));
                $this->CI()->db->where('active', '1');
                $this->CI()->db->from('user');
                $query = $this->CI()->db->count_all_results();

                if ($query < 1) {
                    $this->CI()->session->set_userdata('login_error', '1');

                    $msg = array('login' => '<p>Some problem caused accessing this page. Please contact us regarding this issue.</p>');

                    setMessages($msg, 'error');

                    redirect('registration/login');
                }
            }
            else
            {
                $this->CI()->session->set_userdata('login_error', '1');
                $msg = array('login' => '<p>You must have appropriate rights to access secure page.</p>');
                setMessages($msg, 'error');

                redirect('registration/login');
            }

        } else {

            $this->CI()->session->set_userdata('login_error', '1');
            $msg = array('login' => '<p>You must be logged in to access secure area.</p>');
            setMessages($msg, 'error');

            redirect('registration/login');
        }
        //just in case
        $this->CI()->session->set_userdata('redirect', '1');

        return $this->redirect();
    }

    function process_login($email, $password)
    {
        //set where options
        $this->CI()->db->where('email', $email);
        $this->CI()->db->where('password', $password);
        $this->CI()->db->where('active', '1');

        //query table for the user
        $query = $this->CI()->db->get('user');

        //count number of rows
        $numrows = $query->num_rows();

        //if count of row == 1
        if ($numrows == 1) {

            $data = $query->result_array();
            $this->CI()->session->set_userdata('logged_in', '1');

            //set where options to get group title
            $this->CI()->db->where('group_id', $data[0]['group_id']);

            //query table for the group title
            $query = $this->CI()->db->get('group');

            $g = $query->result_array();

            $data[0]['group_title'] = $g[0]['group_title'];

            $this->CI()->session->set_userdata('loggedData', $data[0]);

            //print_r((($this->CI())));

            //redirect($this->CI()->session->userdata('history'));

            return $this->redirect();

        } else {

            $this->CI()->session->set_userdata('logged_in', '0');

            return FALSE;

        }

    }
}
