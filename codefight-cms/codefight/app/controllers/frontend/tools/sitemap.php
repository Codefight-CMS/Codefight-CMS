<?php
/**
 * Codefight CMS
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to info@codefight.org so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Codefight CMS to newer
 * versions in the future.
 *
 * @category    Codefight CMS
 * @package     cf_Sitemap
 * @copyright   Copyright (c) 2010 Codefight CMS Team (http://codefight.org)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Sitemap Controller
 */
class Sitemap extends MY_Controller
{
	/**
	 * Constructor method
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
    {
        parent::MY_Controller();
        $this->load->helper(array('text'));
        $this->load->library('cf_sitemap_lib');//Load Plugin
        $this->load->model('blog/cf_blog_model');
    }

	
    public function index()
    {

		//$sitemap = new google_sitemap; //Create a new Sitemap Object
		$posts = $this->cf_blog_model->getRecentPosts('50');
		
		$item = $this->cf_sitemap_lib->google_sitemap_item(site_url(), date("Y-m-d",time()), 'daily', '1.0' ); //Create a new Item
		$this->cf_sitemap_lib->add_item($item);
		
		foreach($posts->result_array() as $entry) {

			$link = get_page_url($entry);

			//Create a new Item
			$item = $this->cf_sitemap_lib->google_sitemap_item(site_url($link), date("Y-m-d",strtotime($entry['page_date'])), 'daily', '0.5' );
			
			//Append the item to the sitemap object
			$this->cf_sitemap_lib->add_item($item); 
		}
        $this->cf_sitemap_lib->build("sitemap.xml"); //Build it...
                
         //Let's compress it to gz
        $data = implode("", file("sitemap.xml"));
        $gzdata = gzencode($data, 9);
        $fp = fopen("sitemap.xml.gz", "w");
        fwrite($fp, $gzdata);
        fclose($fp);

        //Let's Ping google
        $this->_pingGoogleSitemaps(base_url()."/sitemap.xml.gz");
		
		echo site_url();
    }

    public function _pingGoogleSitemaps( $url_xml )
    {
       $status = 0;
       $google = 'www.google.com';
       if( $fp=@fsockopen($google, 80) )
       {
          $req =  'GET /webmasters/sitemaps/ping?sitemap=' .
                  urlencode( $url_xml ) . " HTTP/1.1\r\n" .
                  "Host: $google\r\n" .
                  "User-Agent: Mozilla/5.0 (compatible; " .
                  PHP_OS . ") PHP/" . PHP_VERSION . "\r\n" .
                  "Connection: Close\r\n\r\n";
          fwrite( $fp, $req );
          while( !feof($fp) )
          {
             if( @preg_match('~^HTTP/\d\.\d (\d+)~i', fgets($fp, 128), $m) )
             {
                $status = intval( $m[1] );
                break;
             }
          }
          fclose( $fp );
       }
       return( $status );
    }

} 