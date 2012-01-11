<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php if (isset($content) && is_array($content) && count($content) > 0): ?>
<?php foreach ($content as $v): ?>

    <div class="content">

        <h2><?php echo $v['title']; //Show heading of the content ?></h2>

        <?php if (isset($v['author_date'])) echo $v['author_date']; //Show author and published date ?>

        <?php echo $v['content']; //Show content ?>

        <?php if (isset($v['addthis'])) echo $v['addthis']; //Display Addthis button ?>

        <?php echo $v['tag']; //Show tag of the post ?>

        <?php if (isset($v['comment'])) echo $v['comment']; //Show Comment ?>

    </div>

    <?php endforeach; ?>
<?php else: ?>

<h2>Content Couldn't be found.</h2>

<?php endif; ?>

<p class="clear">&nbsp;</p>

<?php if (isset($pagination)) echo $pagination; ?>