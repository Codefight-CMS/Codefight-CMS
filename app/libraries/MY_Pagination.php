<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Pagination extends CI_Pagination {

	public function __construct($params = array())
	{
		parent::__construct($params);
	}

	public function getCurPage()
	{
		return $this->cur_page;
	}
}

/* End of file MY_Pagination.php */
/* Location: ./app/libraries/MY_Pagination.php */
