<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php if (isset($content) && is_array($content) && count($content) > 0): ?>

<?php foreach ($content as $v): ?>

    <div class="content">

        <h2><?php echo $v['title']; //Show heading of the content ?></h2>

        <?php echo $v['content']; //Show content ?>

    </div>

    <?php endforeach; ?>

<?php else: ?>

<h2>Content Couldn't be found.</h2>

<?php endif; ?>

<p class="clear">&nbsp;</p>

<?php if (isset($pagination)) echo $pagination; ?>