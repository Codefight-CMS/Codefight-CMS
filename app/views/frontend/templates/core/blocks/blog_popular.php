<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php
//Get Most Popular Posts
$popular = Model('blog')->getMostPopular(10);
if (!empty($popular)): ?>
<ul class="most_popular">

    <?php foreach ($popular->result_array() as $v) { ?>

    <li><a href="<?php echo site_url(get_page_url($v));?>"><?php echo $v['page_title'];?></a></li>

    <?php } ?>

</ul>
<?php endif; ?>
