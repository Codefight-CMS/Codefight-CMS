<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php
//Meta | TODO:: clean in future version
if (!isset($meta) || !is_array($meta)) {
    $meta['title'] = 'CodeFight CMS';
    $meta['description'] = 'CodeFight CMS is meant to be very simple for everyone to use it for free';
    $meta['keywords'] = 'ci, cms, codeigniter cms, free php cms, easy to manage, website manager, content management system';
}

//Include files | TODO:: Find better method
if (!isset($head_includes) || !is_array($head_includes)) {
    $head_includes = array();
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://ogp.me/ns/fb#" xml:lang="en" lang="en">
<head>
    <title><?php echo $meta['title'];?></title>

    <base href="<?php echo base_url();?>"/>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="description" content="<?php echo $meta['description'];?>"/>
    <meta name="keywords" content="<?php echo $meta['keywords'];?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php Library('asset')->get(); //Load Assets (js|css) ?>

<?php
    //Tiny MCE for wysiwyg editor | TODO:: Move to separate file
    if (isset($_POST['create']) || isset($_POST['edit'])) {
        ?>
        <script>
            tinymce.init({
                selector: 'textarea',
                height: 300,
                theme: 'modern',
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            // Prevent Bootstrap dialog from blocking focusin
            $(document).on('focusin', function(e) {
                if ($(e.target).closest(".mce-window").length) {
                    e.stopImmediatePropagation();
                }
            });
        </script>
        <?php } ?>

    <?php foreach ($head_includes as $v) {
    include ($v);
}    ?>

</head>
<body>
<!-- START:: Top Menu | General Helper -->
<?php echo get_top_menu(); ?>
<!-- END:: Top Menu -->

<noscript>
    <div id="js_disabled" class="error center"><strong><?php echo __('This site works better with javascript
    enabled') ?></strong>.</div>
</noscript>

<div class="siteContainer">
    <div class="pageContainer">

        <!-- START:: Global Messages | General Helper -->
        <?php echo getMessages(); ?>
        <!-- END:: Global Messages -->
        <?php //die('1233'); ?>
		<div class="controls-wrapper" style="border:1px solid #dedede;padding:5px;display:none;">
			<div class="search-controls">
				<form action="<?php echo current_url();?>">
				placeholder for search controls
				<input type="reset" value="Reset" id="reset" name="reset">
				</form>
			</div>
		</div>
