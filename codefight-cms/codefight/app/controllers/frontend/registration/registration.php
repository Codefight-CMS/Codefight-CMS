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
 * @package     cf_Registration
 * @copyright   Copyright (c) 2010 Codefight CMS Team (http://codefight.org)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Registration Controller
 */
class Registration extends MY_Controller
{

    /**
     * Constructor method
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        /*
           | define an array $load with keys model,library etc
           | you can load multiple models etc separated by + sign
           | you can load the CI way as well though :)
           */
        $load = array(
            'model' => 'cf_menu_model + blog/cf_blog_model',
            'library' => 'form_validation',
            'helper' => 'form'
        );

        parent::MY_Controller($load);

    }


    /**
     * Index | Default Method
     *
     * @access    public
     * @return    void
     */
    public function index()
    {

        $config = array(
            array(
                'field' => 'firstname',
                'label' => 'First Name',
                'rules' => 'trim|required|xss_clean'
            ),
            array(
                'field' => 'lastname',
                'label' => 'Last Name',
                'rules' => 'trim|required|xss_clean'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email|xss_clean'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required|matches[password_conf]|xss_clean|md5'
            ),
            array(
                'field' => 'password_conf',
                'label' => 'Password Confirmation',
                'rules' => 'trim|required|xss_clean'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run()) {

            $user_id = '';

            $group_id = '2'; //On first user creation, is added to group_id 2 which is public

            $active = 0;

            $email = set_value('email');

            $password = set_value('password');

            $firstname = set_value('firstname');

            $lastname = set_value('lastname');

            $this->db->where('email', $email);

            $this->db->from('user');

            if ($this->db->count_all_results() < 1) {

                $sql = array(
                    'user_id' => $user_id,
                    'active' => $active,
                    'email' => $email,
                    'password' => $password,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'group_id' => $group_id);

                $this->db->insert('user', $sql);

                //Set Success Message
                $msg = array('login' => '<p>Registration Successful. You will be notified once your account is activated.</p>');
                set_global_messages($msg, 'success');

            }
            else
            {

                //Set Error Message
                $msg = array('login' => '<p>User with such email is already registered.</p>');
                set_global_messages($msg, 'error');

            }

        }
        else
        {

            if (validation_errors()) {

                //Set Error Message
                $msg = array('login' => validation_errors());
                set_global_messages($msg, 'error');

            }

        }

        //load all required css
        $assets['css'] = array('page', 'login');

        //load all required js
        //$assets['js'] = array();

        $this->cf_asset_lib->load($assets);

        //main content block [content view]
        $data['content_block'] = 'registration/registration_view';

        /*
           | @process_view('data', 'master page')
           | @see app/core/MY_Controller.php
           */
        $this->process_view($data);

    }


    /**
     * Login
     *
     * @access    public
     * @return    void
     */
    public function login()
    {

        $data = '';

        $val = array(
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required|xss_clean|md5'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email|xss_clean'
            )
        );

        $this->form_validation->set_rules($val);

        if ($this->form_validation->run() == FALSE) {

            if (!validation_errors() == '') {
                $msg = array('login' => validation_errors());
                set_global_messages($msg, 'error');
            }

        }
        else
        {
            $email = set_value('email');
            $password = set_value('password');

            /* check login */
            $this->cf_login_lib->process_login($email, $password);
            /* ------ */

            if ($this->session->userdata('logged_in') == FALSE) {
                // display login error
                $msg = array('error' => '<p>Invalid Login Data, Please try again.</p>');
                set_global_messages($msg, 'error');
            }
            else
            {
                // display login success message
                $msg = array('success' => '<p>Login Successful.</p>');
                set_global_messages($msg, 'success');
            }

        }

        $assets = array();

        //load all required css
        $assets['css'] = array('page', 'login');

        //load all required js
        //$assets['js'] = array();

        $this->cf_asset_lib->load($assets);

        //main content block [content view]
        $data['content_block'] = 'registration/login_view';

        /*
           | @process_view('data', 'master page')
           | @see app/core/MY_Controller.php
           */
        $this->process_view($data);

    }


    /**
     * Logout
     *
     * @access    public
     * @return    void
     */
    public function logout()
    {

        //Destroy All Session Data | TODO:: improve
        $this->session->sess_destroy();

        //Set Logged In As False, In Case All Sessions Not Destroyed
        $this->session->set_userdata('logged_in', false);

        // display logout success message
        $msg = array('success' => '<p>Logout Successful.</p>');
        set_global_messages($msg, 'success');

        //Show login page again.
        $this->login();

    }


    /**
     * Forgotten Password
     *
     * @access    public
     * @return    void
     */
    public function forgotten_password()
    {

        $data = '';

        //Define Validation Rules
        $val = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email|xss_clean'
            )
        );

        $this->form_validation->set_rules($val);

        //Run Validation
        if ($this->form_validation->run()) {

            $email = set_value('email');

            $query = $this->db->get_where('user', array('email' => $email));

            $query = $query->result();

            //If User Found With Such Email, Reset Password And Notify
            if (count($query) >= 1) {

                $userData = $query[0];

                //Create A Random Password
                $newPass = $this->_createRandomPassword();

                $newPassMD5 = md5($newPass);

                //update database with new password
                $this->db->where('email', $email);

                $this->db->update('user', array('password' => $newPassMD5));

                //send new password
                $this->load->library('email');

                $this->email->initialize();

                $this->email->subject('| ' . $this->setting->site_name . ' | Password Reset');

                $this->email->from($this->setting->email_sender, $this->setting->site_name);

                $this->email->to($email);


                //Prepare Email Body
                $emailBody = "
				
Hi " . $userData->firstname . " " . $userData->lastname . ",

You or someone requested for a new password through forgotten password link at " . $this->setting->site_name . " and we have reset your password.

Your New Password is:

" . $newPass . "

";

                $this->email->message($emailBody);

                if ($this->email->send()) {

                    //Set Success Message
                    $msg = array('login' => '<p>New Password Sent Successfully.</p>');
                    set_global_messages($msg, 'success');

                    $_POST = array();

                }
                else
                {

                    //Set Error Message
                    //echo $this->email->print_debugger();
                    $msg = array('login' => '<p>System could not send password at this time, please try again later.</p>');
                    set_global_messages($msg, 'error');

                }

            }
            else
            {

                //Set Error Message
                $msg = array('login' => '<p>Invalid Email.</p>');
                set_global_messages($msg, 'error');

            }
        }

        if (validation_errors()) {

            //Set Error Message
            $msg = array('login' => validation_errors());
            set_global_messages($msg, 'error');

        }

        //load all required css
        $assets['css'] = array('page', 'login');
        //load all required js
        //$assets['js'] = array();

        $this->cf_asset_lib->load($assets);

        //main content block [content view]
        $data['content_block'] = 'registration/forgotten_password_view';

        /*
           | @process_view('data', 'master page')
           | @see app/core/MY_Controller.php
           */
        $this->process_view($data);

    }


    /**
     * Create Random Password
     *
     * @access    public
     * @return    string
     */
    public function _createRandomPassword()
    {

        $chars = "abdefghjmnpqrstuvwxyz23456789";

        srand((double)microtime() * 1000000);

        $i = 0;

        $pass = '';

        while ($i <= 7)
        {

            $num = rand() % 29;

            $tmp = substr($chars, $num, 1);

            $pass = $pass . $tmp;

            $i++;

        }

        return $pass;

    }

}

/* End of file registration.php */
/* Location: ./app/frontend/controllers/registration/registration.php */