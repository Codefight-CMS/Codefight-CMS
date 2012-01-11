<?php defined('BASEPATH') OR exit('No direct script access allowed');

//Core admin controller.
class Admin_Controller {
    var $CI;
    var $redirect = 'registration/login';

	public function __construct($params='')
	{
        $this->CI = get_instance();
		if ( ! self::_check_access())
		{
			//display access error and exit
			$msg = array('error' => '<p>You are not allowed to access this page.</p>');
			set_global_messages($msg, 'error');
            redirect($this->redirect);
			exit;
		}

	}

	private function _check_access()
	{
        $is_admin = $this->CI->user('is_admin');
        if(!$is_admin)
        {
            return FALSE;
        }
        $group_id = $this->CI->user('group_id');

		//@todo::check if the user can access
        //Check access rights
        $this->CI->cf_login_lib->check_login($group_id);

        $page = trim($this->CI->cfAdminController . '/' . $this->CI->cfAdminMethod, '/');

        $can_access = $this->CI->cf_module_model->can_access($group_id, $page);

        if($can_access) return TRUE;

        $default_landing = $this->CI->cf_module_model->default_landing($group_id);

        if(!$default_landing)
        {
            return FALSE;
        }

        redirect('admin/'.$default_landing);

		return TRUE;
	}

}