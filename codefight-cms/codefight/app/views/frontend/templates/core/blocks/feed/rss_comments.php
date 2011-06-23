<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php 
echo '<'.'?xml version="1.0" encoding="utf-8"?'.'>' . "\n";
?>
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
    <admin:generatorAgent rdf:resource="http://www.codefight.org/" />

    <?php foreach($posts->result() as $entry): 
		$link = $this->cf_data_model->link_clean($entry->page_title);

			$menu_id = explode(',',$entry->menu_id);
			$menu_id = array_filter($menu_id);
			$menu_id = array_shift($menu_id);

		$link = "{$entry->page_type}/$menu_id/{$entry->page_id}/$link";
		?>
    
        <item>

          <title><?php echo xml_convert($entry->name); ?></title>
          <link><?php echo site_url($link) ?>#cmnt<?php echo $entry->page_comment_id; ?></link>
          <guid><?php echo site_url($link) ?>#cmnt<?php echo $entry->page_comment_id; ?></guid>

          <description><![CDATA[
      <?php echo $entry->comment; ?>
      ]]></description>
      <pubDate><?php echo date ('r', strtotime($entry->time));?></pubDate>
        </item>

        
    <?php endforeach; ?>
    
    </channel></rss>  