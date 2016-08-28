<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php
//Get Most Popular Posts
$popular = Model('blog')->getMostPopular(5);
if (!empty($popular)): ?>
<ul class="nav nav-pills nav-stacked most_popular">

    <?php foreach ($popular->result_array() as $v) { ?>

    <li><a href="<?php echo site_url(get_page_url($v));?>"><?php echo $v['page_title'];?></a></li>

    <?php } ?>

</ul>
<?php endif; ?>
