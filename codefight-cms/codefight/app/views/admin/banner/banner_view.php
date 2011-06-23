<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php $this->load->view('admin/inc/template_top'); ?>


 <div class="cp">
   <h2>Banner Manager</h2>
	<div id="spiffycalendar" class="text"></div>

<!-- body //-->
<table border="0" width="100%" cellspacing="0" cellpadding="2">

<?php
if (isset($action) && $action == 'new')
{
	?>
      <tr>
        <td>
		<form name="new_banner" id="new_banner" action="<?php echo site_url('admin/banner/create');?>" method="post" enctype="multipart/form-data">
		<?php if($form_action == 'update') echo '<input type="hidden" name="banner_id" id="banner_id" value="' . $bID . '" />'; ?>
		<table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main">Banner Title</td>
            <td class="main"><input type="text" name="banner_title" id="banner_title" value="<?php echo $banner['banner_title'];?>" /></td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td class="main">Banner URL</td>
            <td class="main"><input type="text" name="banner_url" id="banner_url" value="<?php echo $banner['banner_url'];?>" /></td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td class="main" valign="top">Banner Image</td>
            <td class="main"><input type="file" name="banner_image" id="banner_image" value="<?php echo $banner['banner_title'];?>" /> , or enter local file below<br>media/upload/<input type="text" name="banner_image_local" id="banner_image_local" value="" /></td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td class="main">Image Target (Save To):</td>
            <td class="main">media/upload/<input type="text" name="banner_image_target" id="banner_image_target" value="" /></td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td valign="top" class="main">HTML Text:</td>
            <td class="main"><textarea name="banner_html_text" id="banner_html_text"><?php echo $banner['banner_html_text'];?></textarea></td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td class="main">Scheduled At:<br><small><!-- (dd/mm/yyyy) -->(dd/mm/yyyy)</small></td>
            <td valign="top" class="main"><input type="text" name="date_scheduled" id="date_scheduled" value="" />calendar</td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td valign="top" class="main">Expires On:<br><small><!-- (dd/mm/yyyy) -->(dd/mm/yyyy)</small></td>
            <td class="main"><input type="text" name="expire_date" id="expire_date" value="" />calendar <br>, or at<br><input type="text" name="expire_impressions" id="expire_impressions" value="<?php echo $banner['expire_impressions'];?>" maxlength="7" size="7" /> impressions/views <br>, or at<br><input type="text" name="expire_clicks" id="expire_clicks" value="<?php echo $banner['expire_clicks'];?>" maxlength="7" size="7" /> clicks.
		   </td>
          </tr>
		  <tr>
			<td colspan="2">&nbsp;</td>
		  </tr>
		  <tr>
			<td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
			  <tr>
				<td class="main"><?php echo '<b>Banner Notes:</b><ul><li>Use an image or HTML text for the banner - not both.</li><li>HTML Text has priority over an image</li></ul><br><b>Image Notes:</b><ul><li>Uploading directories must have proper user (write) permissions setup!</li><li>Do not fill out the \'Save To\' field if you are not uploading an image to the webserver (ie, you are using a local (serverside) image).</li><li>The \'Save To\' field must be an existing directory with an ending slash (eg, banner/).</li></ul><br><b>Expiry Notes:</b><ul><li>Only one of the two fields should be submitted</li><li>If the banner is not to expire automatically, then leave these fields blank</li></ul><br><b>Schedule Notes:</b><ul><li>If a schedule is set, the banner will be activated on that date.</li><li>All scheduled banner are marked as deactive until their date has arrived, to which they will then be marked active.</li></ul>'; ?></td>
				<td class="main" valign="top" nowrap>
				<input name="submit" id="submit" type="submit" value="submit" /><a href="<?php echo site_url('admin/banner');?>">cancel</a><?php
				 //echo (($form_action == 'insert') ? tep_image_submit('button_insert.gif', IMAGE_INSERT) : tep_image_submit('button_update.gif', IMAGE_UPDATE)). '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_BANNER_MANAGER, (isset($HTTP_GET_VARS['page']) ? 'page=' . $HTTP_GET_VARS['page'] . '&' : '') . (isset($HTTP_GET_VARS['bID']) ? 'bID=' . $HTTP_GET_VARS['bID'] : '')) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>'; 
				 ?></td>
			  </tr>
			</table></td>
		  </tr>
        </table></form>
		</td>
      </tr>
<?php

} else {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="1" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <th class="dataTableHeadingContent">Banner</th>
                <th class="dataTableHeadingContent">INSERT TAG</th>
                <th class="dataTableHeadingContent">Displays / Clicks</th>
                <th class="dataTableHeadingContent">Status</th>
                <th class="dataTableHeadingContent">Action</th>
              </tr>
<?php
foreach ($banner as $k => $v) {
	
	$info = isset($v['info'][0]) ? $v['info'][0] : array('banner_shown'=>0,'banner_clicked'=>0);
	
      $banner_shown = $info['banner_shown'];
      $banner_clicked = $info['banner_clicked'];
?>
			<tr class="dataTableRow">
                <td class="dataTableContent"><?php echo $v['banner_title']; ?></td>
                <td class="dataTableContent" align="center">{{banner <?php echo $v['banner_id']; ?>}}</td>
                <td class="dataTableContent" align="center"><?php echo $banner_shown . ' / ' . $banner_clicked; ?></td>
                <td class="dataTableContent">
					<?php if ($v['status'] == '1') { ?>
					<a href="<?php echo site_url('admin/banner/status/'.$v['banner_id'].'/0');?>">Active</a>
					<?php } else { ?>
					<a href="<?php echo site_url('admin/banner/status/'.$v['banner_id'].'/1');?>">InActive</a>
					<?php }?>
				</td>
                <td class="dataTableContent"><a href="<?php echo site_url('admin/banner/create/'.$v['banner_id']);?>">Edit</a> | <a href="<?php echo site_url('admin/banner/delete/'.$v['banner_id']);?>">Delete</a></td>
              </tr>
<?php
    }
?>

            </table></td>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
    </table>
<!-- body_eof //-->

   <p class="clear">&nbsp;</p>
 </div>
 
 <p class="clear">&nbsp;</p>
 
<?php $this->load->view('admin/inc/template_bottom'); ?>
