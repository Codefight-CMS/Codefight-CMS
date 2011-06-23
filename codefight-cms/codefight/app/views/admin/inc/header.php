<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
//Meta | TODO:: clean in future version
if(!isset($meta) || !is_array($meta)) {$meta['title'] = 'CodeFight CMS';$meta['description'] = 'CodeFight CMS is meant to be very simple for everyone to use it for free';$meta['keywords'] = 'ci, cms, codeigniter cms, free php cms, easy to manage, website manager, content management system';}

//Include files | TODO:: Find better method
if(!isset($head_includes) || !is_array($head_includes)) {$head_includes = array();}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo $meta['title'];?></title>
	
	<base href="<?php echo base_url();?>" />
	
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="description" content="<?php echo $meta['description'];?>" />
	<meta name="keywords" content="<?php echo $meta['keywords'];?>" />
	
	<?php $this->cf_asset_lib->get(); //Load Assets (js|css) ?>
	
	<?php 
	//Tiny MCE for wysiwyg editor | TODO:: Move to separate file
	if(isset($_POST['create']) || isset($_POST['edit'])) { ?>
<!-- TinyMCE -->
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "ibrowser,safari,pagebreak,style,layer,table,save,advhr,advimage,codefightmedia,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "ibrowser,save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		
		convert_urls : false,
		relative_urls : false,
		remove_script_host : false,


		// Example content CSS (should be your site CSS)../../../../
		content_css : "../../assets/default/css/helper.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "../../assets/default/js/tiny_mce/lists/template_list.js",
		external_link_list_url : "../../assets/default/js/tiny_mce/lists/link_list.js",
		external_image_list_url : "../../assets/default/js/tiny_mce/lists/image_list.js",
		media_external_list_url : "../../assets/default/js/tiny_mce/lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->
	<?php } ?>
	
	<?php foreach($head_includes as $v) { include ($v); }	?>
	
</head>
<body>

<noscript><div id="js_disabled" class="error center"><strong>This site works better with javascript enabled</strong>.</div></noscript>

<div class="siteContainer">
	<div class="header">
		<div class="logo"><?php echo anchor('admin/', 'Codefight CMS');?></div>
		<div class="userLogged">
			<span class="userInfo"><?php
				
				//Login or Logout Link | TODO:: Probably move to general helper
				if($this->session->userdata('logged_in') === '1')
				{
					
					$loggedData = $this->session->userdata('loggedData');
					
					echo $loggedData['firstname'] . ' ' . $loggedData['lastname'] . " ( '" . $loggedData['group_title'] . "' ) | " . anchor('registration/logout', 'Logout');
					
				}
				else
				{
					
					echo anchor('registration/login', 'Login');
					
				}
				?> | 
				
			</span>
			
			<span class="siteInfo"><?php 
				
				echo '<a href="'.base_url().'">view site</a>'; ?> | <?php $format = 'DATE_RFC822'; $time = time(); echo standard_date($format, $time); ?>
			</span>
			
		</div>
    </div>

<div class="pageContainer">
	
	<!-- START:: Global Messages | General Helper -->
	<?php echo get_global_messages(); ?>
	<!-- END:: Global Messages -->
	<!-- START:: Top Menu | General Helper -->
	<?php echo get_top_menu(); ?>
	<!-- END:: Top Menu -->
	<?php //die('1233'); ?>
