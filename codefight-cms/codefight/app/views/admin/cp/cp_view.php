<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>

<div class="pageContainer">

    <div class="cp main">
        <h2><?php echo __('Admin Control Panel Home') ?></h2>

        <p><?php echo __('Welcome to admin Control Panel Home.') ?></p>

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
                                                <h2><?php echo __('Top 10 Page') ?></h2>
                                                <?php
                                                if (isset($top_page)) {
                                                echo '<ul>';
                                                foreach ($top_page as $v)
                                                {
                                                    echo '<li>';
                                                    echo '<a href="' . get_page_url($v) . '" target="_blank">' . $v['page_title'] . '</a>';
                                                    echo '</li>';
                                                }
                                                echo '</ul>';
                                            }
                                                ?>
                                                <p class="clear">&nbsp;</p>
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
