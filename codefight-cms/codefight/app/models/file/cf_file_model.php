<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cf_file_model extends MY_Model
{
    var $i = 0;
    var $menu_string;
    var $menu;
    var $_menuLevel = 0;
    var $current_folder_id;
    var $loggedData = array();
    var $_folderBreadcrumb = array();

    function disk_free_space($folder)
    {
        //---
        return $this->convert_bytes(disk_free_space($folder));
    }

    function disk_total_space($folder)
    {
        //---
        return $this->convert_bytes(disk_total_space($folder));
    }

    function convert_bytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    function get_folder_menu()
    {
        //folder_id   folder_parent_id   folder_path   folder_name   folder_status
        if ($this->session->userdata('logged_in') === '1') $this->loggedData = $this->session->userdata('loggedData');
        if (empty($this->loggedData)) {
            $this->loggedData['group_id'] = $this->loggedData['user_id'] = 0;
        }

        $this->db->where("  folder_access IN ('all', 'public')
							OR (folder_access = 'group' AND folder_access_members LIKE '%," . $this->loggedData['group_id'] . ",%')
							OR (folder_access = 'user' AND folder_access_members LIKE '%," . $this->loggedData['user_id'] . ",%')"
            , NULL, FALSE);

        $folders = $this->get_active_folder();
        $this->current_folder_id = $this->uri->segment(3, 1);

        $this->menu = array();
        $this->menu_string = '';

        foreach ($folders as $v)
        {
            $this->menu['relation'][$v['folder_id']] = $v['folder_parent_id'];
            $this->menu['menu'][$v['folder_id']] = $v['folder_name'];
        }

        if (!count($this->menu) || !isset($this->menu['relation']) || !isset($this->menu['menu'])) return '';

        $parent = array_keys($this->menu['relation'], "0");

        $this->menu_string .= '<ul class="folder_menu">';

        foreach ($parent as $v)
        {

            $class = ($this->current_folder_id == $v) ? ' class="rootFolder active"' : ' class="rootFolder"';

            $this->menu_string .= '<li><a' . $class . ' href="' . site_url('file/folder/' . $v) . '">' . $this->menu['menu'][$v] . '</a>';
            $this->cf_file_model->get_child_folders($v);
            $this->menu_string .= '</li>';
        }

        $this->menu_string .= '</ul>';

        return $this->menu_string;
    }

    function get_child_folders($key = 0)
    {
        if (empty($key) || empty($this->menu)) return FALSE;

        $child[$this->i] = array_keys($this->menu['relation'], $key);

        if (!empty($child[$this->i])) {
            $this->_menuLevel++;
            $this->menu_string .= '<ul>';
            foreach ($child[$this->i] as $c[$this->i])
            {
                //---

                $class = ($this->current_folder_id == $c[$this->i]) ? ' class="active"' : '';

                $this->menu_string .= '<li><a' . $class . ' href="' . site_url('file/folder/' . $c[$this->i]) . '">' . $this->menu['menu'][$c[$this->i]] . '</a>'; //'.$this->menu['menu'][$c[$this->i]];

                if ($this->_menuLevel < 2) $this->get_child_folders($c[$this->i]);

                $this->menu_string .= '</li>';

                $this->i++;
            }
            $this->menu_string .= '</ul>';
            $this->_menuLevel--;
        }

        return;
    }

    function get_folder_breadcrumb()
    {
        $id = $this->uri->segment(3, 1);

        $bread = array_reverse($this->get_folder_breadcrumb_array($id));

        $string = '';
        $_breadCount = count($bread);

        if ($_breadCount) {
            $string = '<div class="breadcrumb">';
            $i = 1;
            foreach ($bread as $v)
            {
                //--------
                $string .= $v;
                if ($i++ != $_breadCount) $string .= '<span> &raquo; </span>';
            }
            $string .= '</div>';
        }

        echo $string;
    }

    function get_folder_breadcrumb_array($fid = 0)
    {
        if (!$fid) return '';

        $id[$this->i] = $fid;

        $this->db->where('folder_id', $id[$this->i]);
        $query = $this->db->get('folder');

        $result[$this->i] = $query->result_array();

        foreach ($result[$this->i] as $k[$this->i] => $v[$this->i])
        {

            $this->_folderBreadcrumb[] = '<a href="' . site_url('file/folder/' . $id[$this->i]) . '">' . $v[$this->i]['folder_name'] . '</a>';

            if ($v[$this->i]['folder_parent_id'] > 0) $this->get_folder_breadcrumb_array($v[$this->i]['folder_parent_id']);

            $this->i++;
        }

        return $this->_folderBreadcrumb;
    }

    function get_file($per_page = 5, $page = 0, $folder_id = FALSE)
    {
        $this->db->order_by('file_id');

        if ($per_page) $this->db->limit($per_page, $page);

        if ($folder_id) $this->db->where('folder_id', $folder_id);

        $query = $this->db->get('file');


        $result = $query->result_array();

        !is_array($result) ? $result = array() : '';

        return $result;
    }

    function get_searched_file($per_page = 5, $page = 0, $q = FALSE)
    {
        if ($q) {
            $this->db->like('file_title', $q);
            $this->db->or_like('file_description', $q);
            $this->db->or_like('file_name', $q);
            $this->db->or_like('file_path', $q);
        }

        return $this->get_file($per_page, $page);

    }

    function get_file_count($folder_id = 0)
    {
        if ($folder_id > 0) $this->db->where('folder_id', $folder_id);

        return $this->db->count_all_results('file');
    }

    function delete_file($id = 0)
    {
        $this->db->where('file_id', $id);
        $query = $this->db->get('file');
        $result = $query->result_array();

        foreach ($result as $v)
        {
            $file = FCPATH . 'media' . $v['file_path'] . $v['file_name'];

            //echo $file;

            if (is_file($file)) unlink($file);
        }

        $this->db->where('file_id', $id);
        $this->db->delete('file');

        if ($this->db->affected_rows())
            return TRUE;
        else
            return FALSE;
    }

    function add_new_file($data = array())
    {
        $sql = array();

        $upload_data = $data['upload_data'];

        $upload_data['file_path'] = str_replace(str_replace('\\', '/', FCPATH), '', $upload_data['file_path']);

        $sql['file_name'] = $upload_data['file_name'];
        $sql['file_type'] = $upload_data['file_type'];
        $sql['file_path'] = $upload_data['file_path'];
        $sql['file_ext'] = $upload_data['file_ext'];
        $sql['file_size'] = $upload_data['file_size'];

        $sql['is_image'] = $upload_data['is_image'];
        $sql['image_width'] = $upload_data['image_width'];
        $sql['image_height'] = $upload_data['image_height'];

        $sql['file_title'] = $data['name'];
        $sql['file_description'] = $data['description'];
        $sql['folder_id'] = $data['parent'];
        $sql['file_access'] = $data['access'];
        $sql['file_status'] = $data['active'];

        if (isset($data[$data['access']])) {
            $sql['file_access_members'] = ',' . implode(',', $data[$data['access']]) . ',';
        }

        $this->db->insert('file', $sql);

        return TRUE;
    }

    function update_file($data = array())
    {
        $sql = array();

        $sql['file_title'] = $data['name'];
        $sql['file_description'] = $data['description'];
        $sql['file_access'] = $data['access'];
        $sql['file_status'] = $data['active'];

        if (isset($data[$data['access']])) {
            $sql['file_access_members'] = ',' . implode(',', $data[$data['access']]) . ',';
        }

        $this->db->where('file_id', $data['id']);
        $this->db->update('file', $sql);
        if ($this->db->affected_rows()) {
            return TRUE;
        }
        return FALSE;
    }

    function get_folder($per_page = 5, $page = 0)
    {
        $this->db->order_by('folder_sort');
        if ($per_page) $this->db->limit($per_page, $page);
        $query = $this->db->get('folder');

        $result = $query->result_array();

        !is_array($result) ? $result = array() : '';

        //echo $this->db->last_query();

        return $result;
    }

    function get_active_folder()
    {
        $this->db->where('folder_status', '1');
        return $this->get_folder(false);
    }

    function get_upload_path($id = 0)
    {
        $this->db->where('folder_id', $id);
        $query = $this->db->get('folder');

        $result = $query->result_array();

        if (isset($result[0]['folder_path']))
            return FCPATH . 'media/' . ltrim($result[0]['folder_path'], '/');
        else
            return FALSE;
    }

    function get_folder_count()
    {
        return $this->db->count_all_results('folder');
    }

    function create_folder($folder)
    {
        /*
          $folder = array(
                          'active' => $active,
                          'parent' => $parent,
                          'name' => $name,
                          'thumb' => $upload_data, //file_name
                          );
          */
        $thumb = '';
        if (!empty($folder['thumb'])) $thumb = $folder['thumb']['file_name'];

        $this->db->where('folder_id', $folder['parent']);
        $query = $this->db->get('folder');
        $result = $query->result_array();

        if (empty($result)) return FALSE;

        //check to see if directory exists
        $parent_dir = trim($result[0]['folder_path'], '/') . '/';
        while (($parent_dir != '/') && (substr($parent_dir, 0, 1) == '/' || substr($parent_dir, -1) == '/')) $parent_dir = trim($parent_dir, '/');

        if ($parent_dir != '/')
            $parent_dir .= '/';
        else
            $parent_dir = '';

        if (!is_dir(FCPATH . 'media/' . $parent_dir)) return FALSE;

        $name = explode('/', trim($folder['name'], '/'));

        $folder_parent_id = $folder['parent'];

        $current_dir = $parent_dir;

        if (count($name)) {
            foreach ($name as $v)
            {
                //---------------
                $v = trim($v);

                $folder_name = $v;

                $current_dir = $parent_dir;
                $parent_dir .= $v . '/';

                if (is_dir(FCPATH . 'media/' . $parent_dir)) continue;

                if (mkdir(FCPATH . 'media/' . $parent_dir, 0777)) {
                    $sql = array(
                        'folder_parent_id' => $this->get_parent_folder_id('/' . $current_dir),
                        'folder_status' => $folder['active'],
                        'folder_name' => $folder_name,
                        'folder_path' => '/' . $parent_dir,
                        'folder_thumb' => $thumb);

                    $sql['folder_access'] = $folder['access'];

                    if (isset($folder[$folder['access']])) {
                        $sql['folder_access_members'] = ',' . implode(',', $folder[$folder['access']]) . ',';
                    }

                    $this->db->insert('folder', $sql);
                    if ($this->db->affected_rows()) {
                        $folder_parent_id = $this->db->insert_id();
                    }
                }
            }
        }

        return true;
    }

    function update_folder($folder)
    {

        /*
          $folder = array(
                          'active' => $active,
                          'parent' => $parent,
                          'name' => $name,
                          'thumb' => $upload_data, //file_name
                          );
          */
        $thumb = '';
        if (!empty($folder['thumb'])) $thumb = $folder['thumb']['file_name'];

        $this->db->where('folder_id', $folder['parent']);
        $query = $this->db->get('folder');
        $result = $query->result_array();

        if (empty($result)) return FALSE;

        $this->db->where('folder_id', $folder['id']);
        $query = $this->db->get('folder');
        $folder_prev = $query->result_array();

        if (empty($folder_prev)) return FALSE;


        //check to see if directory exists
        $parent_dir = trim($result[0]['folder_path'], '/') . '/';
        while (($parent_dir != '/') && (substr($parent_dir, 0, 1) == '/' || substr($parent_dir, -1) == '/')) $parent_dir = trim($parent_dir, '/');

        if ($parent_dir != '/')
            $parent_dir .= '/';
        else
            $parent_dir = '';

        if (!is_dir(FCPATH . 'media/' . $parent_dir)) return FALSE;

        $name = explode('/', trim($folder['name'], '/'));
        $name = array(0 => array_pop($name));

        $folder_parent_id = $folder['parent'];

        $current_dir = $parent_dir;

        $update_success = FALSE;
        if (count($name)) {
            foreach ($name as $v)
            {
                //---------------
                $v = trim($v);

                $folder_name = $v;

                $current_dir = $parent_dir;
                $parent_dir .= $v . '/';

                $folder_prev = ltrim($folder_prev[0]['folder_path'], '/');

                //print_r(FCPATH . $folder_prev);
                if (!is_dir(FCPATH . 'media/' . $folder_prev)) return FALSE;

                //if(mkdir(FCPATH . $parent_dir, 0777))
                //{
                $sql = array(
                    'folder_parent_id' => $folder_parent_id,
                    'folder_status' => $folder['active'],
                    'folder_name' => $folder_name,
                    'folder_path' => '/' . $parent_dir
                );

                if (!empty($thumb)) $sql['folder_thumb'] = $thumb;

                $sql['folder_access'] = $folder['access'];

                $sql['folder_access_members'] = '';
                if (isset($folder[$folder['access']])) {
                    $sql['folder_access_members'] = ',' . implode(',', $folder[$folder['access']]) . ',';
                }

                $this->db->where('folder_id', $folder['id']);
                $this->db->update('folder', $sql);
                if ($this->db->affected_rows()) {
                    rename(FCPATH . 'media/' . $folder_prev, FCPATH . $parent_dir);

                    $update_success = TRUE;
                }
                //}
            }
        }

        return $update_success;
    }

    function get_parent_folder_id($path = '')
    {
        //echo $path;
        $this->db->where('folder_path', $path);
        $query = $this->db->get('folder');
        $result = $query->result_array();
        //print_r($result);

        if (isset($result[0]['folder_id'])) return $result[0]['folder_id']; else return 0;
    }

    function insert($active, $email, $password, $firstname, $lastname, $group_id)
    {
        $this->db->where('email', $email);
        $count = $this->db->count_all_results('file');

        if ($count >= 1) {
            return false;
        } else {
            $sql = array('active' => $active,
                         'email' => $email,
                         'password' => $password,
                         'firstname' => $firstname,
                         'lastname' => $lastname,
                         'group_id' => $group_id);
            $this->db->insert('file', $sql);
            return true;
        }
    }

    function process($content = '')
    {
        if (empty($content)) return FALSE;
        $folder_id = $this->uri->segment(3, 1);

        $loggedData = array();
        if ($this->session->userdata('logged_in') === '1') $loggedData = $this->session->userdata('loggedData');

        //print_r($content['content']);
        foreach ($content as $k => $v)
        {
            $result = array();

            if (empty($loggedData)) {
                $query = $this->db->query("SELECT *
										  	FROM cf_file 
											WHERE 
											file_access = 'public' 
											AND
											folder_id = '{$folder_id}'
											AND
											file_status = '1' 
											ORDER BY file_id DESC"
                );

                $result = $query->result_array();

                $query = $this->db->query("SELECT *
										  	FROM cf_folder 
											WHERE 
											folder_access = 'public' 
											AND
											folder_parent_id = '{$folder_id}'
											AND
											folder_status = '1' 
											ORDER BY folder_sort ASC"
                );

                $result_folder = $query->result_array();

                //$content[$k]['content'] = preg_replace('/\[\[FILES\]\]/i', '<p><strong>Please login to access files.</strong></p>', $v['content']);
            }
            else
            {
                $query = $this->db->query("SELECT *
										   FROM 
										   	cf_file 
										   WHERE 
										   	(
											 	file_access IN ('all', 'public')
												OR (file_access = 'group' AND file_access_members LIKE '%," . $loggedData['group_id'] . ",%')
												OR (file_access = 'group' AND file_access_members LIKE '%," . $loggedData['user_id'] . ",%')
										   	) 
										   AND
										   	folder_id = '{$folder_id}'
										   AND 
										   	file_status = '1' 
										   ORDER BY 
										   	file_id DESC");

                $result = $query->result_array();

                $query = $this->db->query("SELECT *
										   FROM 
										   	cf_folder 
										   WHERE 
										   	(
											 	folder_access IN ('all', 'public')
												OR (folder_access = 'group' AND folder_access_members LIKE '%," . $loggedData['group_id'] . ",%')
												OR (folder_access = 'user' AND folder_access_members LIKE '%," . $loggedData['user_id'] . ",%')
										   	) 
										   AND
										   	folder_parent_id = '{$folder_id}'
										   AND 
										   	folder_status = '1' 
										   ORDER BY 
										   	folder_sort ASC"
                );

                $result_folder = $query->result_array();
                /*
                    [file_id] =&gt; 9
                    [file_title] =&gt; xyz
                    [file_description] =&gt; xzczx
                    [folder_id] =&gt; 1
                    [file_name] =&gt; codefight-1.2_.0_.png
                    [file_path] =&gt; media/
                    [file_type] =&gt; image/png
                    [file_ext] =&gt; .png
                    [file_size] =&gt; 13.76
                    [is_image] =&gt; 1
                    [image_width] =&gt; 720
                    [image_height] =&gt; 285
                    */
            }

            $fi = 0;
            $_columnCount = 4;
            $_folderCount = count($result_folder);
            $file_list = '';

            if ($_folderCount > 0) {
                foreach ($result_folder as $r)
                {
                    if (($fi++ % $_columnCount) == 0) {
                        $file_list .= '<ol class="user_folders">';
                    }

                    $_last_class = '';
                    if (($fi % $_columnCount) == 0) $_last_class = ' class="last"';

                    $file_list .= '<li' . $_last_class . '><div class="folder_name">';

                    //$folder_thumb = '<span>'.$r['folder_name'].'</span>';

                    //if(!empty($r['folder_thumb']) && file_exists(FCPATH . 'media/folder-thumbs/'.$r['folder_thumb']))
                    //{
                    $folder_thumb = '<img src="' . $this->config->item('skin_url') . 'media/resize.php?src=folder-thumbs/' . $r['folder_thumb'] . '&w=142&h=142" alt="' . $r['folder_name'] . '" border="0" />';
                    //} resize.php?src='.$r['folder_thumb'] .'&w=142&h=142

                    $file_list .= '<a href="' . base_url() . 'file/folder/' . $r['folder_id'] . '">' . $folder_thumb . '</a>';

                    $file_list .= '</div><span class="folder_name_block">' . ucwords(strtolower($r['folder_name'])) . '</span></li>';

                    if (($fi % $_columnCount) == 0 || $fi == $_folderCount) {
                        $file_list .= '</ol>';
                        $file_list .= '<p class="clear">&nbsp;</p>';
                    }
                }
            }

            if (empty($loggedData)) {
                //$file_list .= '<p><strong>Please login above to access secure files.</strong></p>';
            }

            if (empty($file_list)) {
                //$file_list .= '<p><strong>No Sub-folders found in this folder. Please try another folder from left menu.</strong></p>';
            }
            //print_r($file_list);
            $v['content'] = preg_replace('/\[\[FOLDERS\]\]/i', $file_list, $v['content']);
            $file_list = '';

            if (!empty($result)) {
                $file_list = '<ol class="user_files">';
                foreach ($result as $r)
                {
                    $file_list .= '<li><div class="file_title">' . $r['file_title'] . ' (<a href="' . $this->config->item('skin_url') . ltrim($r['file_path'], '/') . $r['file_name'] . '" target="_blank">' . $r['file_name'] . '</a> - <strong>' . $r['file_size'] . 'KB)</strong></div><p>' . $r['file_description'] . '</p></li>';
                }
                $file_list .= '</ol>';
            }

            if (empty($loggedData)) {
                $file_list .= '<p><strong>Please login above to access secure files.</strong></p>';
            }

            if (empty($file_list)) {
                $file_list .= '<p><strong>No files found in this folder. Please try another folder from left menu.</strong></p>';
            }

            $content[$k]['content'] = preg_replace('/\[\[FILES\]\]/i', $file_list, $v['content']);

        }

        return $content;
    }


    /*
     function edit() {
         $file_id = $this->input->post('file_id');

         !is_array($file_id) ? $file_id = array() : '';

         foreach($file_id as $k => $v) {
             $rules["file_title_$k"]       = "trim|required|xss_clean";
             $rules["file_description_$k"] = "trim|required|xss_clean";

             $fields["file_title_$k"]       = "Title of ID " . $k;
             $fields["file_description_$k"] = "Description of ID " . $k;

         }

         $this->validation->set_rules($rules);
         $this->validation->set_fields($fields);

         if ($this->validation->run() == FALSE)
         {
             return FALSE;
         }
         else
         {
             foreach($file_title as $k => $v) {
                 $file_title = $this->validation->file_title_$k;
                 $file_description = $this->validation->file_description_$k;

                 echo $file_title;
                 echo $file_description;
             }

             return TRUE;
         }
     }
     */

}

?>