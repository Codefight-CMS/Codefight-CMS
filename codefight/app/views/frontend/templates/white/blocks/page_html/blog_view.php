<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php
if (isset($content) && is_array($content) && count($content) > 0){
    if(count($content) == 1){
        foreach ($content as $v) { ?>
        <div class="content">
            <span class="breadcrumbs">
                <a href="<?php echo base_url(); ?>" rel="breadcrumb home tag" title="Goto Homepage">Home</a>
                &raquo;
                <a href="<?php echo site_url('blog'); ?>" rel="breadcrumb blog tag" title="Goto Blog">Blog</a>
                &raquo;
                <?php echo $v['categories']; ?>
            </span>

            <h1 class="title heading"><?php
                //Show heading of the content, ...
                echo $v['title']; ?></h1>

            <?php
            //Show author and published date
            if (isset($v['author_date'])){
                echo $v['author_date'];
            }

            //Show content
            echo $v['content'];

            //Display Addthis button
            if (isset($v['addthis'])){
                echo $v['addthis'];
            }

            //Show Comment
            if (isset($v['comment'])){
                echo $v['comment'];
            }

            //Show tag of the post
            echo $v['tag']; ?>

            <h5><?php echo __('Link'); ?>: <?php echo $v['title-link']; ?></h5>

        </div><?php

        }
    } else {
        foreach ($content as $v) {
            ?>
            <div class="content"><?php

                //Show heading of the content, ...
                echo '<h2>' . $v['title-link'] . '</h2>';

                //Show author and published date
                if (isset($v['author_date'])) echo $v['author_date'];

                //Show content
                echo $v['content'];

                //Display Addthis button
                if (isset($v['addthis'])) echo $v['addthis'];

                //Show Comment
                if (isset($v['comment'])) echo $v['comment'];

                //Show tag of the post
                echo $v['tag']; ?>

            </div><?php
        }
    }
}
else
{
    ?>
<h2>Content Couldn't be found.</h2><?php

} ?>

<p class="clear">&nbsp;</p>

<?php if (isset($pagination)) echo $pagination; ?>
