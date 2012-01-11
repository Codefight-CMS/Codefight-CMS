<?php if (!defined('BASEPATH')) exit(__('No direct script access allowed')); ?>
<?php echo '<' . '?xml version="1.0" encoding="utf-8"?' . '>' . "\n"; ?>
<rss version="2.0"
     xmlns:dc="http://purl.org/dc/elements/1.1/"
     xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
     xmlns:admin="http://webns.net/mvcb/"
     xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
     xmlns:content="http://purl.org/rss/1.0/modules/content/">

    <channel>

        <title><?php echo $feed_name; ?></title>

        <link><?php echo $feed_url; ?></link>
        <description><?php echo $page_description; ?></description>
        <dc:language><?php echo $page_language; ?></dc:language>
        <dc:creator><?php echo $creator_email; ?></dc:creator>

        <dc:rights>Copyright <?php echo gmdate("Y", time()); ?></dc:rights>
        <admin:generatorAgent rdf:resource="http://codefight.org/"/>

        <?php
        foreach ($posts->result_array() as $entry)
        {
            $link = site_url(get_page_url($entry));
            $description = nl2br(trim(str_replace('&nbsp;', ' ', strip_tags($entry['page_blurb'])))); //xml_convert
            ?>
            <item>

                <title><?php echo xml_convert($entry['page_title']); ?></title>
                <link><?php echo $link; ?></link>
                <guid><?php echo $link; ?></guid>

                <description><![CDATA[
                    <?php echo $description; ?>
                    ]]>
                </description>
                <pubDate><?php echo date(DATE_RSS, strtotime($entry['page_date']));?></pubDate>

            </item>
            <?php

        }
        ?>

    </channel>
</rss>