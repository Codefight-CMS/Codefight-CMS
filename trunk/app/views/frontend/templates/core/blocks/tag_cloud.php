<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php
//Get Tag Cloud
$cloud = Model('data')->get_tag_cloud();
if (!empty($cloud)): ?>
<h5 onclick="jQuery('#tag_cloud').slideToggle(500);">TAG CLOUD:</h5>

<div id="tag_cloud"><?php

    //Shuffle the Cloud
    shuffle($cloud);

    //Display Cloud Tags
    foreach ($cloud as $c) { ?>
        <span class="tag_cloud_item">
            <span class="glyphicon glyphicon-cloud"></span>
            <a
                class="<?php echo $c['class']; ?>"
                href="<?php echo site_url($c['type'] . '/' . 'tag/' . $c['tag']); ?>"
                title="Total posts for <?php echo trim($c['title']); ?> is <?php echo $c['count']; ?>">
                <?php echo trim($c['title']); ?>
            </a>
        </span>
        <?php } ?>
    <p class="clear">&nbsp;</p>
</div>
<?php endif; ?>