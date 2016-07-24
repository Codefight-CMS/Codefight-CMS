<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Page_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function get_page_contents($menu_link = FALSE)
    {

        if ($menu_link == FALSE) return FALSE;

        $this->db->where('menu_type', 'page');
        $this->db->where('menu_link', $menu_link);
        $this->db->limit(1);
        $query = $this->db->get('menu');
        $row = $query->result_array();

        if (isset($row[0]['menu_id']))
            $menu_id = $row[0]['menu_id'];
        else
            $menu_id = 0;


        $this->db->join('page_access', 'page.page_id = page_access.page_id');

        $this->db->like('page.menu_id', ",$menu_id,");

        if (defined('CFWEBSITEID')) {
            $this->db->like('page.websites_id', ',' . CFWEBSITEID . ',');
        }

        $this->db->where('page_type', 'page');

        $this->db->where(array('page.page_active' => '1'));
        $this->db->group_by('page.page_id');
        $this->db->order_by('page.page_sort', 'asc');
        $this->db->order_by('page.page_id', 'desc');

        $query = $this->db->get('page');
        $data1 = $query->result_array();
        //echo $this->db->last_query();

        $data = array();
        if (is_array($data1) && count($data1) > 0) {

            $data['meta'] = Model('blog')->meta_fetch($data1[0]);
            $data['content'] = $data1;

        }
        else
        {
            $data['meta'] = Model('blog')->defaults();
            $data['content'] = array();
        }

        $data['meta']['index'] = true;
        if(!$menu_id){
            $data['meta']['index'] = false;
        }

        return $data;
    }

    function parseContent($content = array(), $show_blurb = TRUE)
    {

        $_content = array();

        if (isset($content) && is_array($content) && count($content) > 0) foreach ($content as $k => $v) {
            //check access
            $access = Model('data')->is_granted($v['group_id']);

            //Get Author + Date Block
            $author_date = Model('data')->author_date($v['page_author'], $v['page_date'], $v['show_author'], $v['show_date']);
            //Get Tags Block
            $page_tag = Model('data')->page_tag($v['page_tag']);
            //Get Tags Block
            $content_content = Library('parser/bbcode')->parse(Model('data')->page_content($v, $show_blurb));
            //$page_content = $this->phpcolor->color_code($content_content);
            $page_content = $content_content;

            //Get the Year | Month | Day the post was posted
            $_content[$k]['year'] = Model('data')->post_year($v['show_date'], $v['page_date']);
            $_content[$k]['month'] = Model('data')->post_month($v['show_date'], $v['page_date']);
            $_content[$k]['day'] = Model('data')->post_day($v['show_date'], $v['page_date']);

            //check to see if there is a form
            if (preg_match_all('#{{form (.+)}}#isU', $page_content, $identifier)) {
                $form = Library('form')->create($identifier, current_url());
                if (isset($_POST['identifier'])) {
                    $page_content .= '<script type="text/javascript">
					jQuery(document).ready(function(){check_form();});

					function check_form() {
						jQuery.post(
								\'form/ajax\',
								{
									';
                    foreach ($_POST as $pk => $pv) {
                        if (!is_array($_POST[$pk]))
                            $page_content .= "{$pk}:document.getElementById(\"{$pk}\").value, \n";
                        else {
                            //print_r($_POST);
                            foreach ($_POST[$pk] as $chk_k => $chk_v) {
                                $page_content .= "'" . $pk . '[' . $chk_k . ']' . "'" . ':document.getElementById("' . $pk . '[' . $chk_k . ']").value, ' . "\n";
                            }
                        }
                    }
                    $page_content .= ' },
								function(data){
									jQuery(\'#message_' . $_POST['identifier'] . '\').html(data);
								}
							);
					}
					</script>';
                }

                //replace identifiers with form.
                foreach ($form as $f) {
                    $page_content = preg_replace('#' . $f['block'] . '#isU', $f['form'], $page_content);
                }
            }

            //check to see if there is a form
            if (preg_match_all('#{{banner (.+)}}#isU', $page_content, $identifier)) {
                $page_content = Model('banner')->parse($page_content, $identifier);
            }

            $_content[$k]['categories'] = Model('data')->post_category($v['menu_id'], true);

            //$v['menu_id'] = explode(',',$v['menu_id']);
            //$v['menu_id'] = array_filter($v['menu_id']);
            //$v['menu_id'] = array_shift($v['menu_id']);

            $link = get_page_url($v); //Model('data')->link_create(array(0 => 'page', 1 => $v['menu_id'], 3 => $v['page_id'], 4 => Model('data')->link_clean($v['page_title'])));

            //If the user has right to view this content...
            if ($access) {
                //Show heading of the content, ...
                $_content[$k]['title'] = $v['page_title'];
                $_content[$k]['author_date'] = $author_date;
                $_content[$k]['content'] = $page_content;
                $_content[$k]['tag'] = $page_tag;

                if (isset($v['allow_comment']) && ($v['allow_comment'])) {
                    $data['page_id'] = $v['page_id'];
                    $data['link'] = $link;
                    //include($template_path . '/blocks/comment.php');
                    $this->lang->load('comment');
                    $_content[$k]['comment'] = Library('block')->load('comment', false, '.php', true);
                }

            } else {
                //Show heading of the content, ...
                $_content[$k]['title'] = $v['page_title'];
                $_content[$k]['author_date'] .= $author_date;

                //... but Display message to login
                $_content[$k]['content'] .= '<p class="error">You do not have access right to view this part of content, Please login.</p>';
                $_content[$k]['tag'] .= $page_tag;
            }

            //Count total comment
            $_content[$k]['comment_count'] = Model('data')->post_comment_count($v['page_id']);

        } //END: Foreach

        return $_content;
    }
}
