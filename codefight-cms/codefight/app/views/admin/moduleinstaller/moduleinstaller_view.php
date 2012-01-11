<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<div class="pageContainer">

    <div class="cp main">
        <h2><?php echo __('Install Modules') ?></h2>

        <p><?php echo __('Old module resources are automatically deleted.') ?></p>

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
                                                <h2><?php echo __('Installation Successful') ?></h2>
                                                <p class="clear">&nbsp;</p>
												<p>All available modules are installed and refreshed successfully. Now you can assign proper rights to the user groups.</p>
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
