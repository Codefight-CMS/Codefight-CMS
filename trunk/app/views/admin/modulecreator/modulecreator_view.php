<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<div class="pageContainer">

    <div class="cp main">
        <h2><?php echo __('Create Module Config File') ?> | Coming soon.</h2>

        <p><?php echo __('Add required data below to generate config file') ?></p>

        <p class="clear">&nbsp;</p>

        <div class="pageContent cp_box_1">
            <div class="box_mid_left">
                <div class="box_mid_right">
                    <div class="box_bottom_mid">
                        <div class="box_top_mid">
                            <div class="box_bottom_left">
                                <div class="box_bottom_right">
                                    <div class="box_top_left">
                                        <div class="box_top_right">
                                            <div class="box_content">
                                                <h2><?php echo __('Generate') ?></h2>
                                                <p class="clear">&nbsp;</p>
												<form>
												<label>Module Name: [a-z0-9]i</label>
												<input id="name" name="name" type="text" value=""/>
												<br>
												<label>Status:[0 || 1]</label>
												<input id="status" name="status" type="text" value=""/>
												<br>
												<label>Sort:[int]</label>
												<input id="sort" name="sort" type="text" value=""/>
												<br>
												<label>Module Title:</label>
												<input id="title" name="title" type="text" value=""/>
												<br>
												<label>Parent Menu: </label>
												<input id="parent" name="parent" type="text" value="top"/>
												<br>
												<label>Void: [0 || 1]</label>
												<input id="void" name="void" type="text" value=""/>
												<br>
												<input type="button" class="btn btn-primary" value="generate" id="generateBtn">
												</form>
												<div id="spitCode">code:</div>
<script type="text/javascript">
jQuery(document).ready(function(){
	var $times = 1;
    var $this = this;
    function generateCode(){
        var $code = '<pre class="brush:php">' +
        '&lt;?php  if (!defined(\'BASEPATH\')) exit(\'No direct script access allowed\'); <br/>' +
        '/* <br/>' +
        ' * Package: Codefight CMS <br/>' +
        ' * Module: ' + jQuery('input#name').val() + ' <br/>' +
        ' * Author: Damodar Bashyal  <br/>' +
        ' * Date: 5/10/2011  <br/>' +
        ' */' +
        '$cnf[\'' + jQuery('input#name').val() + '\'][\'global\'] = array(  <br/>' +
        '			\'status\' => ' + jQuery('input#status').val() + ',  <br/>' +
        '			\'sort\' => ' + jQuery('input#sort').val() + ',  <br/>' +
        '			\'title\' => \'' + jQuery('input#title').val() + '\',  <br/>' +
        '			\'parent\' => \'' + jQuery('input#parent').val() + '\',  <br/>' +
        '			\'void\' => ' + jQuery('input#void').val() + ',  <br/>' +
        '		);  <br/> </pre>';

        return $code;
    }

	jQuery('#generateBtn').click(function(){
		jQuery('#spitCode').html(generateCode());
	});
});
</script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="clear">&nbsp;</p>
        </div>

    </div>

    <p class="clear">&nbsp;</p>
</div>

<?php $this->load->view('admin/inc/footer'); ?>
