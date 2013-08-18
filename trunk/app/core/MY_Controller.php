<?php
/*
 | MY_Controller.php extension for CodeIgniter Controller
 | CodeFight cms since version 1.0
 | Author: Damodar Bashyal
 */

class MY_Controller extends CI_Controller
{

    private $_data          = array();
    public
        $menu_id            = 0,
        $page_id            = 0,
        $menu_link          = '',
        $current_page       = '',
        $page_links         = 0,
        $setting            = 0,
        $cfModule           = '',
        $cfRedirect         = FALSE,
        $cfQuery            = '',
        $cfSegments         = '',
        $current_language   = 'english',//@todo::search and remove references.
        $language           = 'english',
        $backUrl            = '';


    /**
     * Catch all requests and redirect to method, if exits, if not, use default method.
     *
     * @access public
     *
     * @param string $method, The method to call
     *
     * @return void
     */
    public function _remap($method)
    {

        //print_r(get_class_methods(get_class($this)));
        if ($this->uri->segment(1, 0) != 'admin') {
            $method = $this->uri->segment(2, 'index');
        }
        elseif ($this->uri->segment(1, 0) == 'admin')
        {
            $method = $this->uri->segment(3, 'index');
        }

        $method = str_replace('-', '_', $method);

        if (method_exists($this, $method)) {
            $this->$method();
        }
        else
        {
            $this->index();
        }
    }

    public function _init()
    {

        $this->cfModule          = $this->uri->segment(1, 'page');
        $this->cfAdminController = $this->uri->segment(2, '');
        $this->cfAdminMethod     = $this->uri->segment(3, '');
        if (!in_array($this->cfModule, array('registration', 'skin', 'media', 'favicon.ico'))) {
            $backUrl = uri_string();
            if(!empty($this->cfModule) && !empty($backUrl)){
                $this->session->set_userdata('backUrl', htmlspecialchars($backUrl));
            }
        }

        if (in_array($this->cfModule, array('registration'))) {
            $this->session->set_userdata('isLogin', 1);
        }

        if ($this->cfModule == 'admin') {

            require_once APPPATH . DS . 'core' . DS . 'Admin_Controller.php';
            $Admin_Controller = new Admin_Controller();
            //Check access rights
            //Library('login')->check_login(array('1'));
        } else {
            require_once APPPATH . DS . 'core' . DS . 'Front_Controller.php';
            $Front_Controller = new Front_Controller();
        }
    }

    public function MY_Controller($load = array())
    {

        parent::__construct();
        //print_r($this->uri->segments);

        $this->_init();

        $this->load_language_files();

        //load setting
        //Model('setting')->load_setting();

        //if $load is defined load them
        foreach ((array)$load as $k => $v)
        {
            //explode files separated with +
            $v_array = explode('+', $v);

            //now load each files
            foreach ($v_array as $w) {
                $this->load->$k(trim($w));
            }
        }

        //Overwrite Language If Set.
        Model('language')->load();

        //Load all setting defined at setting manager
        //Model('setting')->load_setting();
        $this->setting = Model('setting')->setting;

        //check if site is enabled
        if ($this->cfModule != 'admin') {
            Model('setting')->check_site_enabled();
        }

        //On clicking menu link, show all page contents linked to that link
        //if second uri segment not found return 1 as default menu id
        $this->menu_id = $this->uri->segment(2, 0);
        $this->menu_id = strtolower($this->menu_id);

        //There is some issue with last segment, which adds prefix.
        while (substr($this->menu_id, -5, 5) == '_html') {
            $this->menu_id = substr($this->menu_id, 0, -5);
        }

        //On clicking more link of the page blurb show full text
        $this->page_id = $this->uri->segment(3, 0);
        //There is some issue with last segment, which adds prefix.
        if (substr($this->page_id, -5, 5) == '_html') {
            $this->page_id = substr($this->page_id, 0, -5);
        }

        //pagination
        $this->current_page = $this->uri->segment(4, 0);
        //There is some issue with last segment, which adds prefix.
        if (substr($this->current_page, -5, 5) == '_html') {
            $this->current_page = substr($this->current_page, 0, -5);
        }

        if (!is_numeric($this->menu_id) && !in_array(strtolower($this->menu_id), array('c', 'tag', 'ajax'))) {
            $this->menu_id = Model('blog')->getMenuId($this->menu_id);
        } else if($this->menu_id > 0 && is_numeric($this->page_id) && $this->page_id > 0) {
            Model('blog')->redirect_blog($this->page_id);
        }

        //Start caching page
        //$this->output->cache(1440);

    }


    public function paginate($config = array())
    {

        $this->load->library('pagination');

        $config['per_page']  = $this->setting->pagination_per_page;
        $config['num_links'] = $this->setting->pagination_page_links;

        $this->pagination->initialize($config);

        //Create page
        $this->page_links = $this->pagination->create_links();
    }

    public function process_view($data = array(), $master_page = 'mainpage', $module = 'frontend')
    {
        //Get available templates, this should be called first
        //as this will get and set default template
        $data['templates'] = Model('setting')->get_templates();

        //Get template
        $template = Model('setting')->selected_template();

        //Get Body Id
        $data['bodyId'] = $this->getBodyId();

        //load vars | so it can be retrived at view as variable
        $this->load->vars($data);

        //Get data from view.
        $template    = $module.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.$template.DIRECTORY_SEPARATOR.$master_page;
        $html_string = $this->load->view($template, '', true);

        if (isset($this->setting->display_view_path) && $this->setting->display_view_path == true
        ) {
            echo '<p>'.$template.'</p>';
        }
        Library('process')->view($html_string);

    }

    public function load_language_files()
    {
        require_once(APPPATH . 'libraries'.DIRECTORY_SEPARATOR.'Pregfind.php');

        $language_path = realpath(APPPATH . 'language'.DIRECTORY_SEPARATOR.'' . $this->current_language) . DIRECTORY_SEPARATOR;

        $preg_find      = new preg_find();
        $language_files = $preg_find->find(
            '/^.*?\.php$/i', $language_path, PREG_FIND_RECURSIVE | PREG_FIND_SORTBASENAME
        );

        foreach ((array)$language_files as $v)
        {
            $filename = (preg_replace('/(' . preg_quote($language_path, '/') . '|_lang\.php)/i', '', realpath($v)));
            $this->lang->load($filename, $this->current_language);
        }
    }

    public function user($field = FALSE)
    {
        $data = $this->session->userdata('loggedData');

        if ($field) {
            if (isset($data[$field])) {
                return $data[$field];
            }
            else
            {
                return 0;
            }
        }

        return $data;
    }

    public function setBodyId(){
        $this->setData('body-id','codefight-body');
    }

    public function getBodyId(){
        $id = $this->getData('body-id');

        if(!empty($id)){
            return 'cf-'.preg_replace('/[^a-z0-9_\-\]/iSu', '', $id);
        }
        return 'codefight-body-id';
    }

    public function setData($key=false, $val=false, $merge=true){
        if(!empty($key)) {
            if(is_array($val) && $merge){
                $_val = (array)$this->getData($key);
                $val = array_merge($val, $_val);
            }
            $this->_data[$key] = $val;
        }
        return $this;
    }

    public function unsetData($key=false){
        if(!empty($key) && isset($this->_data[$key])){
            unset($this->_data[$key]);
        }
        return $this;
    }

    public function getData($key=false){
        if(empty($key)) {
            return $this->_data;
        }
        if(isset($this->_data[$key])){
            return $this->_data[$key];
        }
        return array();
    }
}

/* End of file MY_Controller.php */
/* Location: ./app/frontend/libraries/MY_Controller.php */
