<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $this->load->view('admin/inc/header'); ?>


<div class="cp">
<h2><?php ___('Banner Manager') ?></h2>

<div id="spiffycalendar" class="text"></div>

<!-- body //-->
<table border="0" width="100%" cellspacing="0" cellpadding="2">

<?php
        if (isset($action) && $action == 'new') {
    ?>
<tr>
    <td>
        <form name="new_banner" id="new_banner" action="<?php echo site_url('admin/banner/create');?>"
              method="post" enctype="multipart/form-data">
            <?php if ($form_action == 'update') echo '<input type="hidden" name="banner_id" id="banner_id" value="' . $bID . '" />'; ?>
            <table border="0" cellspacing="0" cellpadding="2">
                <tr>
                    <td class="main"><?php ___('Banner Title') ?></td>
                    <td class="main"><input type="text" name="banner_title" id="banner_title"
                                            value="<?php echo $banner['banner_title'];?>"/></td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td class="main"><?php ___('Banner URL') ?></td>
                    <td class="main"><input type="text" name="banner_url" id="banner_url"
                                            value="<?php echo $banner['banner_url'];?>"/></td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td class="main" valign="top"><?php ___('Banner Image') ?></td>
                    <td class="main">
                        <input type="file" name="banner_image" id="banner_image"
                               value="<?php echo $banner['banner_title'];?>"/>
                        , <?php ___('or enter local file below'); ?>
                        <br>
                        <?php ___('media/upload/'); ?>
                        <input type="text" name="banner_image_local" id="banner_image_local" value=""/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td class="main"><?php ___('Image Target (Save To)'); ?>:</td>
                    <td class="main">
                        <?php ___('media/upload/'); ?>
                        <input type="text" name="banner_image_target" id="banner_image_target" value=""/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td valign="top" class="main"><?php ___('HTML Text'); ?>:</td>
                    <td class="main">
                        <textarea name="banner_html_text"
                                  id="banner_html_text"><?php echo $banner['banner_html_text'];?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td class="main">
                        <?php ___('Scheduled At'); ?>:
                        <br>
                        <small><!-- (dd/mm/yyyy) -->(<?php ___('dd/mm/yyyy'); ?>)</small>
                    </td>
                    <td valign="top" class="main">
                        <input type="text" name="date_scheduled" id="date_scheduled" value=""/>
                        <?php ___('calendar'); ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td valign="top" class="main">
                        <?php ___('Expires On'); ?>:
                        <br>
                        <small><!-- (dd/mm/yyyy) -->(<?php ___('dd/mm/yyyy'); ?>)</small>
                    </td>
                    <td class="main">
                        <input type="text" name="expire_date" id="expire_date" value=""/>
                        <?php ___('calendar'); ?>
                        <br>
                        , <?php ___('or at'); ?>
                        <br>
                        <input type="text" name="expire_impressions" id="expire_impressions"
                               value="<?php echo $banner['expire_impressions'];?>" maxlength="7" size="7"/>
                        <?php ___('impressions/views'); ?>
                        <br>
                        , <?php ___('or at'); ?>
                        <br>
                        <input type="text" name="expire_clicks" id="expire_clicks"
                               value="<?php echo $banner['expire_clicks'];?>" maxlength="7" size="7"/>
                        <?php ___('clicks'); ?>.
                    </td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table border="0" width="100%" cellspacing="0" cellpadding="2">
                            <tr>
                                <td class="main">
                                    <b><?php ___('Banner Notes'); ?>:</b>
                                    <ul>
                                        <li><?php ___('Use an image or HTML text for the banner - not both.'); ?></li>
                                        <li><?php ___('HTML Text has priority over an image.'); ?></li>
                                    </ul>
                                    <br>
                                    <b><?php ___('Image Notes'); ?>:</b>
                                    <ul>
                                        <li><?php ___('Uploading directories must have proper user (write) permissions setup!'); ?></li>
                                        <li><?php ___('Do not fill out the [Save To] field if you are not uploading an image to the webserver (ie, you are using a local (serverside) image).'); ?></li>
                                        <li><?php ___('The [Save To] field must be an existing directory with an ending slash (eg, banner/).'); ?></li>
                                    </ul>
                                    <br>
                                    <b><?php ___('Expiry Notes'); ?>:</b>
                                    <ul>
                                        <li><?php ___('Only one of the two fields should be submitted'); ?></li>
                                        <li><?php ___('If the banner is not to expire automatically, then leave these fields blank'); ?></li>
                                    </ul>
                                    <br>
                                    <b><?php ___('Schedule Notes'); ?>:</b>
                                    <ul>
                                        <li><?php ___('If a schedule is set, the banner will be activated on that date.'); ?></li>
                                        <li><?php ___('All scheduled banner are marked as deactive until their date has arrived, to which they will then be marked active.'); ?></li>
                                    </ul>
                                </td>
                                <td class="main" valign="top" nowrap>
                                    <input class="btn btn-primary" name="submit" id="submit" type="submit"
                                           value="submit"/>
                                    <a href="<?php echo site_url('admin/banner');?>"><?php ___('cancel'); ?></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </form>
    </td>
</tr>
    <?php

} else {
    ?>
<tr>
    <td>
        <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
                <td valign="top">
                    <table border="1" width="100%" cellspacing="0" cellpadding="2">
                        <tr class="dataTableHeadingRow">
                            <th class="dataTableHeadingContent"><?php ___('Banner'); ?></th>
                            <th class="dataTableHeadingContent"><?php ___('INSERT TAG'); ?></th>
                            <th class="dataTableHeadingContent"><?php ___('Displays / Clicks'); ?></th>
                            <th class="dataTableHeadingContent"><?php ___('Status'); ?></th>
                            <th class="dataTableHeadingContent"><?php ___('Action'); ?></th>
                        </tr>
                        <?php
                        foreach ($banner as $k => $v) {

                        $info = isset($v['info'][0]) ? $v['info'][0] : array('banner_shown' => 0,
                                                                             'banner_clicked' => 0);

                        $banner_shown = $info['banner_shown'];
                        $banner_clicked = $info['banner_clicked'];
                        ?>
                        <tr class="dataTableRow">
                            <td class="dataTableContent"><?php echo $v['banner_title']; ?></td>
                            <td class="dataTableContent" align="center">{{banner <?php echo $v['banner_id']; ?>}}
                            </td>
                            <td class="dataTableContent"
                                align="center"><?php echo $banner_shown . ' / ' . $banner_clicked; ?></td>
                            <td class="dataTableContent">
                                <?php if ($v['status'] == '1') { ?>
                                <a href="<?php echo site_url('admin/banner/status/' . $v['banner_id'] . '/0');?>"><?php ___('Active'); ?></a>
                                <?php } else { ?>
                                <a href="<?php echo site_url('admin/banner/status/' . $v['banner_id'] . '/1');?>"><?php ___('InActive'); ?></a>
                                <?php }?>
                            </td>
                            <td class="dataTableContent">
                                <a href="<?php echo site_url('admin/banner/create/' . $v['banner_id']);?>"><?php ___('Edit'); ?></a>
                                |
                                <a href="<?php echo site_url('admin/banner/delete/' . $v['banner_id']);?>"><?php ___('Delete'); ?></a>
                            </td>
                        </tr>
                        <?php

                    }
                        ?>

                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr>
                        <?php

}
?>
</table>
<!-- body_eof //-->

<p class="clear">&nbsp;</p>
</div>

<p class="clear">&nbsp;</p>

<?php $this->load->view('admin/inc/footer'); ?>
