<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php
if (isset($content) && is_array($content) && ($count=count($content)) > 0)
{
    if(count($content) == 1){
        foreach ($content as $k => $v) { ?>
        <div class="content">
            <ul class="breadcrumb">
                <li><span class="hide">You are here: </span></li>
                <li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb">
                    <a href="<?php echo base_url(); ?>" itemprop="url" rel="breadcrumb home" title="Goto Homepage">
                        <span itemprop="title">Home</span>
                    </a>
                    <span class="divider">/</span>
                </li>
                <li class="" itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb" itemprop="child">
                    <a href="<?php echo site_url('blog'); ?>" itemprop="url" rel="breadcrumb blog" title="Goto Blog">
                        <span itemprop="title">Blog</span>
                    </a>
                    <span class="divider">/</span>
                </li>
                <li>
                    <?php echo $v['categories']; ?>
                    <span class="divider">/</span>
                </li>
                <li class="active" itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb" itemprop="child">
                    <a href="<?php echo $v['title-url']; ?>" itemprop="url" rel="breadcrumb post page" title="You are now reading: <?php echo htmlspecialchars($v['title']); ?>">
                        <span itemprop="title"><?php echo $v['title']; ?></span>
                    </a>
                </li>
            </ul>

            <!-- H1:Post Heading for - <?php echo $v['title']; ?> -->
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

            if(($k+1) == $count) { ?>
                <div class="after-article-ads">
                    <ul>
                        <li style="background: #f60;">
                        <!-- Place this tag where you want the su badge to render -->
                        <su:badge layout="5"></su:badge>

                        <!-- Place this snippet wherever appropriate -->
                        <script type="text/javascript">
                            (function() {
                                var li = document.createElement('script'); li.type = 'text/javascript'; li.async = true;
                                li.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//platform.stumbleupon.com/1/widgets.js';
                                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(li, s);
                            })();
                        </script>
                        </li>
                        <li>
                            <!-- LearnTips-728x90-AP -->
                            <div id='div-gpt-ad-1336656460674-1' style='width:728px; height:90px;'>
                                <script type='text/javascript'>
                                    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1336656460674-1'); });
                                </script>
                            </div>
                        </li>
                        <li>
                            &nbsp;
                            <br/>
                            &nbsp;
                            <small><strong>Tips</strong>: touching links in iPhone for few seconds gives the options to open a link in new window.</small>
                            <br/>
                            &nbsp;

                        </li>
                        <li>
                            <script type="text/javascript"><!--
                            google_ad_client = "ca-pub-9567128729272204";
                            /* ltat */
                            google_ad_slot = "8761210017";
                            google_ad_width = 728;
                            google_ad_height = 15;
                            //-->
                            </script>
                            <script type="text/javascript"
                                    src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
                            </script>
                        </li>
                    </ul>
                </div>
                <p class="clear">&nbsp;</p>

                <?php
            }

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

            <?php //@todo:: get short url for Link ?>
            <h5>
                <?php echo __('QR Code'); ?>:
                <a href="<?php echo ($v['title-url']); ?>" target="_blank">
                    <img border="0" width="50" height="50" src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo urlencode($v['title-url']); ?>&choe=UTF-8" alt="<?php echo htmlspecialchars($v['title']); ?>" title="<?php echo htmlspecialchars($v['title']); ?>" />
                </a>
            </h5>

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
