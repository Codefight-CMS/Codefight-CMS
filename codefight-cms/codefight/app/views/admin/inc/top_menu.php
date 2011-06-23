<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
/*
 * Check app/modules folder for adding/removing menu items.
 * Menu has been moved to xmls on that folder, 
 * so its easy to add remove modules menu items
 * Those XMLs are read every page visit in admin, 
 * which will be cached in later versions to improve more performance.
 * Plus, when time permits i am planning to add more controls on those XML files.
 */
$menu_item = $this->cf_module_lib->_getAdminNav();
/*
print_r($menu_item);
$menu_item = array(
		'cp' =>  array(
			'Admin' => array(
				'cp' => 'Admin',
				'cp/update' => 'Update'
				)
			),
		'group' => 'Group',
		'user' => 'User',
		'menu' => array(
			'Menu' => array(
				'menu/page' => 'Page Links', 
				'menu/blog' => 'Blog Categories', 
				'menu/sponsored-links' => 'Sponsored Links', 
				'menu/favourite-links' => 'Favourite Links', 
				'menu/blog-roll' => 'Blog Roll'
				)
			),
		'form' =>  array(
			'Form' => array(
				'form/item' => 'Items', 
				'form/group' => 'Group', 
				'form/submitted' => 'Submitted'
				)
			),
		'page' =>  array(
			'Page' => array(
				'page/page' => 'Static Page', 
				'page/blog' => 'Blog Page'
				)
			),
		'comment' =>  array(
			'Comment' => array(
				'comment/pending-comment' => 'Pending', 
				'comment/approved-comment' => 'Approved'
				)
			),
		'file' =>  array(
			'File Manager' => array(
				'file/manage-file' => 'Files',
				'file/upload-file' => 'New File',
				)
			),
		'folder' =>  array(
			'Folder Manager' => array(
				'folder/manage-folder' => 'Folders',
				'folder/create-folder' => 'New Folder',
				)
			),
		'swiff' => 'Swiff',
		'banner' =>  array(
			'Banner' => array(
				'banner/create' => 'Create New Banner'
				)
			),
		'website' => 'Website Manager',
		'setting' =>  array(
			'Setting' => array(
				'setting/site' => 'Website', 
				'setting/keys' => 'Keys', 
				'setting/cache' => 'Cache', 
				'setting/sitemap' => 'Sitemap'
				)
			)
		);
*/
 ?>

<style type="text/css">
#wrap {
	position: relative;
}
#main-nav {
	background:#212B36;
	clear:both;
	min-height:30px;
	padding-top:10px;
}
#main-handle {
	/*float: right;*/
	margin-top: -1px;
}
#main-nav li {
	background:#212B36;
	display:block;
	float:left;
	list-style:none outside none;
	min-height:30px;
}
#main-nav li a, .sub-links li a {
	margin-right: 5px;
	font-size: 12px;
	text-decoration: none;
	color: #f2f2f2;
	font-family: Arial, Helvetica, sans-serif;
	text-transform: uppercase;
	font-weight: bold;
	padding: 10px;
	outline: 0;
}
#main-nav li.current a, #main-nav li a:hover, #main-nav li a.active {
	background: #DEDEDE;
	color:#635644;
}
#main-nav li.current a {color:#5690C0;}
#sub-link-bar {
	background: #DEDEDE;
	min-height: 30px;
	border-bottom:1px solid #212B36;
}
.sub-links {
	display: none;
	width: 100%;
	text-align: left;
}
.sub-links li {
	display:block;
	float:left;
	list-style:none outside none;
	min-height:30px;
}
ul.sub-links li a{
	color:#635644;
	background:none;
	display:inline-block;
}
ul.sub-links li.current a, ul.sub-links li a:hover{
	background: #212B36;
	color:#5690C0;
}
#main-nav li a.close{
	display: none;	
	position: absolute;
}
#main-nav li a.close:hover{
	background: #900;
}
</style>
<div id="wrap">
  <div id="main-handle"> 
    <div class="roundfg"> 
      <ul id="main-nav">
        <?php
			$child_menu = '';
			foreach($menu_item as $mk => $mv)
			{
				$mk = preg_replace('/:(.+):/', '', $mk);
				$parent_class = ($this->uri->segment(2, 'cp') == $mk) ? ' class="current"' : '';
				echo '<li'. $parent_class .'>';
				if(!is_array($mv))
				{
					echo anchor('admin/' . $mk, $mv, ' class="main-link"');
				}
				else foreach($mv as $mkc => $mvc)
				{
					$mkc = preg_replace('/:(.+):/', '', $mkc);
					$is_first_child = true;
					
					if(!empty($mvc))
					{
						$parent_class = ($this->uri->segment(2, 'cp') == $mk) ? ' style="display:block;"' : '';
						foreach((array)$mvc as $mvck => $mvcv) 
						{
							$mvck = preg_replace('/:(.+):/', '', $mvck);
							if($is_first_child)
							{
								echo anchor("admin/{$mvck}", $mkc, ' class="main-link"');
								$child_menu .= '<ul class="sub-links"'. $parent_class .'>';
								$is_first_child = false;
							}
							$child_class = (uri_string() == '/admin/'.$mvck) ? ' class="current"' : '';
							$child_menu .= '<li'. $child_class .'>';
								if(!is_array($mvcv)) $child_menu .= anchor('admin/' . $mvck, $mvcv);
							$child_menu .= '</li>';
						}
						$child_menu .= '</ul>';
					} else {
						echo anchor('admin/' . $mk, $mkc, ' class="main-link"');
					}
				}
				echo '</li>';
			}
			?>
      </ul>
      <p class="clear">&nbsp;</p>
      <div id="sub-link-bar"><?php echo $child_menu; ?></div>
    </div>
    <!-- End roundfg -->
  </div>
  <!-- End main-handle-->
  <p class="clear">&nbsp;</p>
</div>
<!-- End wrap -->
