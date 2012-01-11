<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php 
if (isset($content) && is_array($content) && count($content) > 0) foreach ($content as $v) {
    ?>

<div class="content"><?php

    //Show heading of the content, ...
    echo '<h2>' . $v['title'] . '</h2>';

    //Display sharethis button
    if (isset($v['sharethis'])) echo $v['sharethis'];

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
else
{
    ?>
<h2>Content Couldn't be found.</h2><?php

} ?>

<p class="clear">&nbsp;</p>

<?php if (isset($pagination)) echo $pagination; ?>