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
 * @package     cf_ajax
 * @copyright   Copyright (c) 2010 Codefight CMS Team (http://codefight.org)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Admin Form Ajax Controller
 */
class Ajax extends MY_Controller
{


    function __construct()
    {
        parent::MY_Controller();
    }

    function index()
    {
        echo '<ul id="sortme">';

        $action = $_POST['action'];
        $group_id = preg_replace('/[^0-9]+/', '', $_POST['group_id']);
        $item_id = preg_replace('/[^0-9]+/', '', $_POST['item_id']);
        $item_sort = preg_replace('/[^0-9]+/', '', $_POST['item_sort']);
        $next_item_id = preg_replace('/[^0-9]+/', '', $_POST['next_item_id']);
        $next_item_sort = preg_replace('/[^0-9]+/', '', $_POST['next_item_sort']);
        $form_item_grid = preg_replace('/[^0-9]+/', '', $_POST['form_item_grid']);

        switch ($action)
        {
            case 'add':
                $this->_add_item($group_id, $item_id);
                break;

            case 'delete':
                $this->_delete_item($group_id, $item_id);
                break;

            case 'sort':
                $this->_sort_item($group_id, $item_id, $item_sort, $next_item_id, $next_item_sort);
                break;

            case 'grid':
                $this->_grid_item($group_id, $item_id, $form_item_grid);
                break;

            default:
                break;
        }

        //Get all item for the selected group
        $this->db->select('*');
        $this->db->where('form_item_to_group.form_group_id', $group_id);
        $this->db->order_by('form_item_to_group.form_item_sort', 'asc');
        $this->db->from('form_item');
        $this->db->join('form_item_to_group', 'form_item_to_group.form_item_id = form_item.form_item_id');
        $query = $this->db->get();
        $row = $query->result_array();

        //this will be used to get remaining item that are not added in this group.
        $not_in_array[0] = 0;
        $i = 1;
        foreach ($row as $v)
        {
            echo '
			<li class="' . (($i % 2 == 0) ? 'even' : 'odd') . '">';


            echo '<label>' . $v['form_item_label'] . '</label><label>' . $v['form_item_name'] . '</label><label>' . $v['form_item_input_type'] . '</label><img src="skin/admin/default/icons/cross.png" alt="Delete" width="16" height="16" border="0" onclick="get_group_item(\'delete\', \'' . $group_id . '\', \'' . $v['form_item_id'] . '\')" class="floatLeft pointer" />';

            if ($i != count($row)) echo '<img src="skin/admin/default/icons/arrow_down.png" alt="sort down" width="16" height="16" border="0" onclick="get_group_item(\'sort\', \'' . $group_id . '\', \'' . $v['form_item_id'] . '\',  \'' . $v['form_item_sort'] . '\', \'' . $row[$i]['form_item_id'] . '\', \'' . $row[$i]['form_item_sort'] . '\')" class="floatLeft pointer" />';

            if ($i == 1) echo '<span style="width:16px;float:left;display:block;">&nbsp;</span>';

            if ($i != 1) echo '<img src="skin/admin/default/icons/arrow_up.png" alt="sort up" width="16" height="16" border="0" onclick="get_group_item(\'sort\', \'' . $group_id . '\', \'' . $v['form_item_id'] . '\',  \'' . $v['form_item_sort'] . '\', \'' . $row[$i - 2]['form_item_id'] . '\', \'' . $row[$i - 2]['form_item_sort'] . '\')" class="floatLeft pointer" />';

            if ($i == count($row)) echo '<span style="width:16px;float:left;display:block;">&nbsp;</span>';

            echo '<span class="isGridItem"> | <a ';

            if ($v['form_item_grid'])
                echo 'onclick="get_group_item(\'grid\', \'' . $group_id . '\', \'' . $v['form_item_id'] . '\', \'0\')"  href="javascript:void(0);"><strong>Showing in Grid</strong>';
            else
                echo 'onclick="get_group_item(\'grid\', \'' . $group_id . '\', \'' . $v['form_item_id'] . '\', \'1\')"  href="javascript:void(0);"><del>showing in Grid</del>';


            echo '</a></span>';

            echo '<p class="clear">&nbsp;</p>
			
			
			</li>
			';

            $not_in_array[$v['form_item_id']] = $v['form_item_id'];
            $i++;
        }
        echo '</ul>';

        //Get all item for the selected group
        $this->db->select('*');
        $this->db->order_by('form_item_name', 'asc');
        $this->db->where_not_in('form_item_id', $not_in_array);
        $this->db->from('form_item');
        $query = $this->db->get();
        $remaining_item = $query->result_array();

        if (count($remaining_item) > 0) {
            echo '<select class="txtFld" name="selectItem' . $group_id . '" id="selectItem' . $group_id . '">';

            foreach ($remaining_item as $v)
            {
                echo '<option value="' . $v['form_item_id'] . '">' . $v['form_item_name'] . '</option>';
            }

            echo '</select><img src="skin/admin/default/icons/add.png" alt="Delete" width="16" height="16" border="0" onclick="get_group_item(\'add\', \'' . $group_id . '\', document.getElementById(\'selectItem' . $group_id . '\').value)" class="pointer" />';
        }
    }

    function _add_item($group_id, $item_id)
    {
        $this->db->order_by('form_item_sort', 'desc');
        $query = $this->db->get_where('form_item_to_group', array('form_group_id' => $group_id));
        $row = $query->result_array();

        if (isset($row[0]['form_item_sort']))
            $sort = ($row[0]['form_item_sort']) + 1;
        else
            $sort = 1;

        $this->db->insert('form_item_to_group', array('form_group_id' => $group_id, 'form_item_id' => $item_id, 'form_item_sort' => $sort));

        return '';
    }

    function _delete_item($group_id, $item_id)
    {
        $this->db->delete('form_item_to_group', array('form_group_id' => $group_id, 'form_item_id' => $item_id));

        return '';
    }

    function _grid_item($group_id, $item_id, $form_item_grid)
    {
        $this->db->update('form_item_to_group', array('form_item_grid' => $form_item_grid), array('form_group_id' => $group_id, 'form_item_id' => $item_id));
        $this->db->update('form_item', array('form_item_grid' => $form_item_grid), array('form_item_id' => $item_id));

        return '';
    }

    function _sort_item($group_id, $item_id, $item_sort, $next_item_id, $next_item_sort)
    {
        $this->db->update('form_item_to_group', array('form_item_sort' => $next_item_sort), array('form_item_id' => $item_id, 'form_group_id' => $group_id));
        $this->db->update('form_item_to_group', array('form_item_sort' => $item_sort), array('form_item_id' => $next_item_id, 'form_group_id' => $group_id));
    }
}