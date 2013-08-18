<?php if (!defined('BASEPATH')) {
    exit(__('No direct script access allowed'));
} ?>
<div class="content">
    <ul class="allComments">
        <li><h2>Recent Comments</h2></li>
        <?php
        foreach ($comments as $v) {
            $url = parse_url($v['page_url'], PHP_URL_PATH);
            $v['page_url'] = site_url(trim($url, '/') . '#cmnt' . $v['page_comment_id']);

            echo'
            <li>
                <h4><a href="' . $v['page_url'] . '" target="_blank">' . $v['page_title'] . '</a></h4>' .
                '<blockquote>
                    <img class="gravatar" src="http://www.gravatar.com/avatar/'.md5($v['email']).'?s=40&amp;d=mm">
                    <a href="' . prep_url($v['url']) . '" target="_blank" rel="external nofollow">' . $v['name'] . '</a>
                    Says: <br /> <span>' . character_limiter($v['comment'], 150) . '</span>
                </blockquote>
            </li>';
        }


        /*
        * Array
               (
                   [page_comment_id] => 174
                   [name] => kriss
                   [comment] => did not work using 1.6.1
                   [time] => 2012-04-14 15:13:03
                   [page_id] => 114
                   [page_url] => http://www.learntipsandtricks.com/blog/magento/114/magento-index-management-Cannot-initialize-the-indexer-process
               )
        */
        ?>
    </ul>
</div>
