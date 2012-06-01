<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php
//Get Tag Cloud
$cloud = Model('data')->get_tag_cloud();
if (!empty($cloud)): ?>
<div class="title-h2">TAG CLOUD:</div>

<div id="tag_cloud"><?php

    //Shuffle the Cloud
    shuffle($cloud);

    //Display Cloud Tags
    foreach ($cloud as $c) {
        ?>
        <a class="<?php echo $c['class']; ?>" href="<?php echo site_url($c['type'] . '/' . 'tag/' . $c['tag']); ?>"
           title="Total posts for <?php echo trim($c['title']); ?> is <?php echo $c['count']; ?>"><strong><?php echo trim($c['title']); ?></strong></a><?php

    }?>

    <p class="clear">&nbsp;</p>

</div>
<?php endif; ?>
