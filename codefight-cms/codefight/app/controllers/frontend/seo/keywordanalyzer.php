<?php 
/**
 * This class crawls google and find out on which page a website is lisited, based on the keyword searched.
 *
 * @author Rochak Chauhan <rochakchauhan@gmail.com>
 * @see This class does NOT calculated the Google Page Rank
 */
?>
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
 * @package     cf_Keywordanalyzer
 * @copyright   Copyright (c) 2010 Codefight CMS Team (http://codefight.org)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Keywordanalyzer Controller
 */

class Keywordanalyzer extends MY_Controller
{
    var $website = "";
    var $keyword = "";
    //var $enableVerbose="";
    var $url = "";
    var $start = 0;
    var $page = false;
    var $records = false;


    /**
     * Constructor method
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        /*
           | define an array $load with keys model,library etc
           | you can load multiple models etc separated by + sign
           | you can load the CI way as well though :)
           */
        $load = array(
            'model' => 'cf_menu_model',
            'library' => 'form_validation',
            'helper' => 'form'
        );

        parent::MY_Controller($load);
    }

    /**
     * Function to pre process and store the values of Keyword and Website
     *
     * @param string $keyword
     * @param string $website
     * @return resource
     */
    public function index()
    {
        $data = '';
        $data['result'] = '';

        $val = array(
            array(
                'field' => 'website',
                'label' => 'Website',
                'rules' => 'trim|required|xss_clean'
            ),
            array(
                'field' => 'keyword',
                'label' => 'Keyword',
                'rules' => 'trim|required|xss_clean'
            )
        );

        $this->form_validation->set_rules($val);

        if ($this->form_validation->run() == FALSE) {

            if (!validation_errors() == '')
                $data['error_message'][] = validation_errors();

        }
        else {

            $website = set_value('website');
            $keyword = set_value('keyword');

            $website = strtolower(trim($website));
            $website = preg_replace("/http(s)?:\/\/www\./", "", $website);
            $website = preg_replace("/http(s)?:\/\//", "", $website);
            $website = preg_replace("/www\./", "", $website);
            $website = preg_replace("/[^a-z0-9\.]+/", "", $website);

            $this->website = $website;
            $this->keyword = trim($keyword);

            $this->url = $this->_updateUrl($keyword, $this->start);

            $data['keywordanalyzer'] = $this->_initSpider();
        }

        //load all required css
        $assets['css'] = array(
            'all' => array('page')
        );
        //load all required js
        $assets['js'] = array();

        $this->cf_asset_lib->load($assets);

        //main content block [content view]
        $data['content_block'] = 'keywordanalyzer';

        //load vars
        $this->load->vars($data);

        /*
           | @process_view('data', 'master page')
           | @see app/core/MY_Controller.php
           */
        $this->process_view($data);
    }

    /**
     * This function starts the crawling process and it verbose the content as it goes to next page.
     *
     * @return string [buffer]
     */
    private function _initSpider()
    {
        $result = "<p>Searching: <b>" . $this->keyword . "</b> and Looking for: <b>" . $this->website . "</b></p>";
        //echo str_repeat(" ", 256);
        $i = 10;
        $c = 1;
        while ($c <= 10) {
            $result .= "<ul><li><b>Searching in Page: $c</b></li>";
            //flush();ob_flush();
            $records = $this->_getRecordsAsArray($this->url);
            $count = count($records);
            $result .= "<ul>";
            for ($k = 0; $k < $count; $k++) {
                $j = $k + 1;
                $link = $records[$k][2];
                $link = strip_tags($link);
                $link = str_replace("http://www.", "", $link);
                $link = str_replace("http://", "", $link);
                $link = str_replace("www.", "", $link);
                $pos = strpos($link, "/");
                $link = trim(substr($link, 0, $pos));

                if ($this->website == $link) {
                    $domain = $this->website;
                    $result .= "<li><h1>Result was found in Page: $c and Record: $j</h1></li>";
                    $result .= "<div>Congrats, We searched google's top 10 page for <b>\"" . $this->keyword . "</b>\", we found your domain <b>\"$domain\"</b> listed on page: $c at $j place </div>";
                    $result .= "</ul></ul>";

                    return $result;
                }
                else {
                    $result .= "<li>Result not found on Page: $c and Record: $j</li>";
                }
            }
            $result .= "</ul></ul>";
            $c++;
            $this->_updateUrl($this->keyword, $i);
        }
        $result .= "Crawled through all 10 page.";

        if ($this->page == false) {
            $domain = $this->website;
            $keyword = $this->keyword;
            $result .= "<div>Sorry, We searched google's top 10 page for <b>\"$keyword\"</b>, but was unable to find your domain <b>\"$domain\"</b> listed anywhere. </div>";
        }
        else {
            $page = $this->page;
            $records = $this->records;
            $domain = $this->website;
            $keyword = $this->keyword;
            $result .= "<div>Congrats, We searched google's top 10 page for <b>\"$keyword\"</b>, we found your domain <b>\"$domain\"</b> listed on page: $page at $record place </div>";
        }

        return $result;
    }

    /**
     * Function to get records as an array.
     *
     * @access private
     * @param string $url
     *
     * @return array
     */
    private function _getRecordsAsArray($url)
    {
        $matches = array();
        $pattern = '/<div class="s"(.*)\<cite\>(.*)\<\/cite\>/Uis';
        $html = $this->_getCodeViaFopen($url);
        preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
        return $matches;
    }

    /**
     * Function to update the google search query.
     *
     * @access private
     * @param string $keyword
     * @param string $start
     *
     * @return string
     */
    private function _updateUrl($keyword, $start)
    {
        $this->start = $this->start + $start;
        $keyword = trim($keyword);
        $keyword = urlencode($keyword);
        return "http://www.google.com/search?start=" . $this->start . "&q=$keyword";
    }

    /**
     * Function to get HTML code from remote url

     *
     * @access private
     * @param string $url
     *
     * @return string
     */
    private function _getCodeViaFopen($url)
    {
        $returnStr = "";
        $fp = fopen($url, "r") or die("ERROR: Invalid search URL");
        while (!feof($fp)) {
            $returnStr .= fgetc($fp);
        }
        fclose($fp);
        return $returnStr;
    }
}

/* End of file keywordanalyzer.php */
/* Location: ./app/frontend/controllers/seo/keywordanalyzer.php */