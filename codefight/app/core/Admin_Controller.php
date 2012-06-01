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
			setMessages($msg, 'error');
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
        Library('login')->check_login($group_id);

        $page = trim($this->CI->cfAdminController . '/' . $this->CI->cfAdminMethod, '/');

        $defaultToAll = array('sortdata/menu','form/ajax','file/file-search-form'); /*These pages can be accessed by all admins. @todo: better management*/

        if(in_array($page, $defaultToAll)) return TRUE;

        $can_access = Model('module')->can_access($group_id, $page);

        if($can_access) return TRUE;

        $default_landing = Model('module')->default_landing($group_id);

        if(!$default_landing)
        {
            return FALSE;
        }

		$msg = array('error' => '<p>You need access to perform action on page <strong>'.$page.'</strong>. </p>');
		setMessages($msg, 'error');


        redirect('admin/'.$default_landing);

		return TRUE;
	}

}
