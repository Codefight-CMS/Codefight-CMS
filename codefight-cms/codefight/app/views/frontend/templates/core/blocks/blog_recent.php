<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php $recent = $this->cf_blog_model->getRecentPosts(10); ?>

<ul class="recent_posts">

    <?php foreach ($recent->result_array() as $v) { ?>

    <li><a href="<?php echo site_url(get_page_url($v));?>"><?php echo $v['page_title'];?></a></li>

    <?php } ?>

</ul>