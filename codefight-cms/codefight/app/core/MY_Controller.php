<?php
/*
 | MY_Controller.php extension for CodeIgniter Controller
 | CodeFight cms since version 1.0
 | Author: Damodar Bashyal
 */

class MY_Controller extends CI_Controller
{

	public $menu_id;
	public $page_id;
	public $menu_link;
	public $current_page;
	public $page_links;
	public $setting;
	public $cfModule;
	public $cfRedirect = false;
	public $cfQuery;
	public $cfSegments;


	/**
	 * Catch all requests and redirect to method, if exits, if not, use default method.
	 * @access public
	 * @param string $method, The method to call
	 * @return void
	 */
	public function _remap($method)
	{
			
		//print_r($this->uri->segments);
		if($this->uri->segment(1, 0) != 'admin')
			$method = $this->uri->segment(2, 'index');
		elseif($this->uri->segment(1, 0) == 'admin')
			$method = $this->uri->segment(3, 'index');
		
		$method = str_replace('-', '_', $method);
		
		if (method_exists($this,$method))
		{
			$this->$method();
		}
		else
		{
			$this->index();
		}
	}

	public function _init()
	{
		
		$this->cfModule = $this->uri->segment(1, 'page');
		$this->cfAdminController = $this->uri->segment(2, '0');
		if(!in_array($this->cfModule, array('registration', 'skin', 'media')))
		{
			$this->session->set_userdata('history', uri_string());
		}
		
		if($this->cfModule == 'admin' && $this->cfAdminController != 'cf')
		{
			//Check access rights
			$this->cf_login_lib->check_login(array('1'));
		}
	}

	public function MY_Controller($load=array())
	{

		parent::__construct();
		//print_r($this->uri->segments);
		
		$this->_init();
		
		//load setting
		//$this->cf_setting_model->load_setting();
		
		//if $load is defined load them
		foreach((array)$load as $k => $v)
		{
			//explode files separated with +
			$v_array = explode('+', $v);

			//now load each files
			foreach($v_array as $w) $this->load->$k(trim($w));
		}

		//Overwrite Language If Set.
		$this->language_model->load();
		
		//Load all setting defined at setting manager
		//$this->cf_setting_model->load_setting();
		$this->setting = $this->cf_setting_model->setting;
		
		//check if site is enabled
		if($this->cfModule != 'admin')
		{
			$this->cf_setting_model->check_site_enabled();
		}

		//On clicking menu link, show all page contents linked to that link
		//if second uri segment not found return 1 as default menu id
		$this->menu_id = $this->uri->segment(2, 0);
		//There is some issue with last segment, which adds prefix.
		if(substr($this->menu_id, -5, 5) == '_html') $this->menu_id = substr($this->menu_id, 0, -5);
		
		//On clicking more link of the page blurb show full text
		$this->page_id = $this->uri->segment(3, 0);
		//There is some issue with last segment, which adds prefix.
		if(substr($this->page_id, -5, 5) == '_html') $this->page_id = substr($this->page_id, 0, -5);
		
		//pagination
		$this->current_page = $this->uri->segment(4, 0);
		//There is some issue with last segment, which adds prefix.
		if(substr($this->current_page, -5, 5) == '_html') $this->current_page = substr($this->current_page, 0, -5);
		
		//Start caching page
		//$this->output->cache(1440);
		
	}
	
	
	public function paginate($config = array())
	{		
		
		$this->load->library('pagination');
		
		$config['per_page'] = $this->setting->pagination_per_page;
		$config['num_links'] = $this->setting->pagination_page_links;
		
		$this->pagination->initialize($config);
		
		//Create page 
		$this->page_links = $this->pagination->create_links();
	}
	
	public function process_view($data = array(), $master_page = 'mainpage', $module='frontend')
	{

		//Get available templates, this should be called first
		//as this will get and set default template
		$data['templates'] = $this->cf_setting_model->get_templates();
		
		//Get template
		$template = $this->cf_setting_model->selected_template();

		//load vars | so it can be retrived at view as variable
		$this->load->vars($data);
		
		//Get data from view.
		$template = "{$module}/templates/{$template}/{$master_page}";
		$html_string = $this->load->view($template, '', true);
		
		if(isset($this->setting->display_view_path) && $this->setting->display_view_path == true) echo "<p>{$template}</p>";
		$this->cf_process_lib->view($html_string);
		
	}

}

/* End of file MY_Controller.php */
/* Location: ./app/frontend/libraries/MY_Controller.php */
?>