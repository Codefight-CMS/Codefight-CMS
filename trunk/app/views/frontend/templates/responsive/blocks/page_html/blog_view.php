<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php
if (isset($content) && is_array($content) && ($count=count($content)) > 0)
{
    if(count($content) == 1){
        foreach ($content as $k => $v) { ?>
            <div class="page-header jumbotron jumbotron-fluid post-heading">
                <div class="container">
                    <!-- H1:Post Heading for - <?php echo $v['title']; ?> -->
                    <h1 class="title heading"><?php
                        //Show heading of the content, ...
                        echo $v['title']; ?></h1>

                    <?php
                    //Show author and published date
                    if (isset($v['author_date'])){
                        echo $v['author_date'];
                    }
                    ?>
                </div>

                <div class="adsnse" style="max-height: 100px;"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- wibiya -->
                    <ins class="adsbygoogle"
                         style="display:block"
                         data-ad-client="ca-pub-9567128729272204"
                         data-ad-slot="2220424816"
                         data-ad-format="auto"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>

            </div>

            <nav>
                <ul class="breadcrumb">
                    <li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb">
                        <a href="<?php echo base_url(); ?>" itemprop="url" rel="breadcrumb home" title="Goto Homepage" class="breadcrumb-item">
                            <span itemprop="title">Home</span>
                        </a>
                    </li>
                    <li class="" itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb" itemprop="child">
                        <a href="<?php echo site_url('blog'); ?>" itemprop="url" rel="breadcrumb blog" title="Goto Blog" class="breadcrumb-item">
                            <span itemprop="title">Blog</span>
                        </a>
                    </li>
                    <li>
                        <?php echo $v['categories']; ?>
                    </li>
                    <li class="active" itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb" itemprop="child">
                        <a href="<?php echo $v['title-url']; ?>" itemprop="url" rel="breadcrumb post page" title="You are now reading: <?php echo htmlspecialchars($v['title']); ?>" class="breadcrumb-item active">
                            <span itemprop="title"><?php echo $v['title']; ?></span>
                        </a>
                    </li>
                </ul>
            </nav>

            <article>
                <div class="container">
                    <div class="row">
                        <div class="col-md-9" role="main">
                            <?php

                            // Show content
                            echo $v['content'];
                            ?>
                        </div>
                    </div>
                </div>
            </article>

        <div class="content">

            <div class="adsnse"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- wibiya -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-9567128729272204"
                     data-ad-slot="2220424816"
                     data-ad-format="auto"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>

            <?php

            //Show Comment
            if (isset($v['comment'])){
                echo $v['comment'];
            }

            //Show tag of the post
            echo $v['tag']; ?>

            <?php //@todo:: get short url for Link ?>
            <h5>
                <?php
                $qrImage = '//chart.googleapis.com/chart?chs=500x500&cht=qr&chl='. urlencode(site_url($v['title-url'])) . '&choe=UTF-8';
                echo __('QR Code');
                ?>:
                <a href="<?php echo $qrImage;//site_url($v['title-url']); ?>" target="_blank" rel="external nofollow">
                    <img border="0" width="150" height="150" src="<?php echo $qrImage ?>" alt="<?php echo htmlspecialchars($v['title']); ?>" title="<?php echo htmlspecialchars($v['title']); ?>" />
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

<nav aria-label="Page navigation">
    <?php if (isset($pagination)) echo $pagination; ?>
</nav>
