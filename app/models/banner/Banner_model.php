<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Banner_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    //Parse any banner insert in the content
    function parse($page_content, $identifier)
    {
        //identifier contains full identifer block and code
        $identifier_blocks = array();
        $identifier_ids = array();
        if (is_array($identifier) && count($identifier) == 2) {
            if (isset($identifier[0]) && isset($identifier[1])) {
                $identifier_blocks = $identifier[0];
                $identifier_ids = $identifier[1];
            }
        }

        foreach ($identifier_ids as $id) {
            $this->db->where('banner_id', (int)$id);
            $this->db->where('status', '1');
            $banner = $this->db->get('banner');
            $banner = $banner->result_array();

            if (count($banner)) {
                $html = '<div class="banner banner_id_' . (int)$id . '">' . $banner[0]['banner_html_text'] . '</div>';
                $page_content = preg_replace('#{{banner ' . (int)$id . '}}#isU', $html, $page_content);
            } else {
                $page_content = preg_replace('#{{banner ' . (int)$id . '}}#isU', '', $page_content);
            }
        }

        return $page_content;
        //return $banner_string;
    }

    ////

    /*
      * Create Advertisement Block
      */
    function get_advertisement($banner = array())
    {
        $ret = false;
        if (isset($banner['provider']) && !preg_match('/localhost/', $_SERVER['HTTP_HOST'])) {
            switch ($banner['provider']) {
                default:
                    $ret = $this->banner_adbrite($banner);
                    break;
            }
        }
        return $ret;
    }

    function banner_adbrite($passed = array())
    {
        !is_array($passed) ? $passed = array($passed) : '';

        $default = array(
            'sid' => '1066153',
            'zs' => '3436385f3630',
            'opid' => '1066153',
            'afsid' => '1',
            'size' => '468x60',
            'provider' => 'adbrite',
            //'location' => 'header',
            'AdBrite_Title_Color' => 'dedede',
            'AdBrite_Text_Color' => 'f3f3f3',
            'AdBrite_Background_Color' => '218B03',
            'AdBrite_Border_Color' => '218B03',
            'AdBrite_URL_Color' => '218B03',
            'AdBrite_Background_Color' => '218B03',
            'show_your_add_here' => false
        );

        $array = array_merge($default, $passed);

        echo '<!-- Begin: AdBrite, Generated: 2009-03-03 22:47:20  --><scr';
        echo 'ipt type="text/javascript">';
        echo 'var AdBrite_Title_Color = \'' . $array['AdBrite_Title_Color'] . '\';';
        echo 'var AdBrite_Text_Color = \'' . $array['AdBrite_Text_Color'] . '\';';
        echo 'var AdBrite_Background_Color = \'' . $array['AdBrite_Background_Color'] . '\';';
        echo 'var AdBrite_Border_Color = \'' . $array['AdBrite_Border_Color'] . '\';';
        echo 'var AdBrite_URL_Color = \'' . $array['AdBrite_URL_Color'] . '\';';
        echo 'try{var AdBrite_Iframe=window.top!=window.self?2:1;var AdBrite_Referrer=';
        echo 'document.referrer==\'\'?document.location:document.referrer;AdBrite_Referrer=encodeURIComponent';
        echo '(AdBrite_Referrer);}catch(e){var AdBrite_Iframe=\'\';var AdBrite_Referrer=\'\';}</scr';
        echo 'ipt><span style="white-space:nowrap;"><scr' . 'ipt type="text/javascript">';
        echo 'document.write(String.fromCharCode(60,83,67,82,73,80,84));document.write(\' ';
        echo 'src="http://ads.adbrite.com/mb/text_group.php?sid=' . $array['sid'] . '&zs=' . $array['zs'] . '&';
        echo 'ifr=\'+AdBrite_Iframe+\'&ref=\'+AdBrite_Referrer+\'" type="text/javascript">\');';
        echo 'document.write(String.fromCharCode(60,47,83,67,82,73,80,84,62));</scr';
        echo 'ipt>';
        if ($array['show_your_add_here'] == true) {
            echo '<a style="font-weight:bold;font-family:Arial;font-size:13px;" rel="external nofollow" target="_blank"';
            echo ' href="http://www.adbrite.com/mb/commerce/purchase_form.php?opid=' . $array['opid'] . '&afsid=' . $array['afsid'] . '">';
            if ($array['size'] == '468x60') {
                echo '<img src="http://files.adbrite.com/mb/images/adbrite-your-ad-here-banner-w.gif" style="background-color:#' . $array['AdBrite_Background_Color'] . ';border:none;padding:0;margin:0;" alt="Your Ad Here" width="11" height="60" border="0" />';
            }
            if ($array['size'] == '160x600') {
                echo 'Your Ad Here';
            }
            if ($array['size'] == '728x90') {
                echo '<img src="http://files.adbrite.com/mb/images/adbrite-your-ad-here-leaderboard.gif"  style="background-color:#' . $array['AdBrite_Background_Color'] . ';border:none;padding:0;margin:0;" alt="Your Ad Here" width="14" height="90" border="0" />';
            }
            echo '</a>';
        }
        echo '</span><!-- End: AdBrite -->';

        return '';

    }

    /*
    // Sets the status of a banner
    function set_banner_status($banner_id, $status)
    {
        if ($status == '1') {
            $qry = "update banner set status = '1', date_status_change = now(), date_scheduled = NULL where banner_id = '" . (int)$banner_id . "'";
            return $this->db->query($qry);
        } elseif ($status == '0') {
            $qry = "update banner set status = '0', date_status_change = now() where banner_id = '" . (int)$banner_id . "'";
            return $this->db->query($qry);
        } else {
            return -1;
        }
    }

    ////

    // Auto activate banner
    function activate_banner()
    {
        $qry = "select banner_id, date_scheduled from banner where date_scheduled != ''";
        $query = $this->db->query($qry);
        $banner_query = $query->result_array();

        if (count($banner_query) > 0) {
            foreach ($banner_query as $banner) {
                if (date('Y-m-d H:i:s') >= $banner['date_scheduled']) {
                    $this->set_banner_status($banner['banner_id'], '1');
                }
            }
        }
    }

    ////

    // Auto expire banner, called at last from footer
    function expire_banner()
    {
        $qry = "select b.banner_id, b.expire_date, b.expire_impressions, b.expire_clicks, sum(bh.banner_shown) as banner_shown, sum(bh.banner_clicked) as banner_clicked from banner b, banner_history bh where b.status = '1' and b.banner_id = bh.banner_id group by b.banner_id";
        $query = $this->db->query($qry);
        $banner_query = $query->result_array();

        if (count($banner_query) > 0) {
            foreach ($banner_query as $banner) {
                if ($banner['expire_date'] != '' && $banner['expire_date'] != null) {
                    if (date('Y-m-d H:i:s') >= $banner['expire_date']) {
                        $this->set_banner_status($banner['banner_id'], '0');
                    }
                } elseif ($banner['expire_impressions'] != '' && $banner['expire_impressions'] != null) {
                    if (($banner['expire_impressions'] > 0) && ($banner['banner_shown'] >= $banner['expire_impressions'])) {
                        $this->set_banner_status($banner['banner_id'], '0');
                    }
                } elseif ($banner['expire_clicks'] != '' && $banner['expire_clicks'] != null && $banner['expire_clicks'] != 0) {
                    if (($banner['expire_clicks'] > 0) && ($banner['banner_clicked'] >= $banner['expire_clicks'])) {
                        $this->set_banner_status($banner['banner_id'], '0');
                    }
                }
            }
        }
    }

    ////

    // Display a banner from the specified group or banner id ($identifier)
    function display_banner($action, $identifier, $limit = '1', $location = '')
    {
        if ($action == 'dynamic') {
            $qry = "select count(*) as count from banner where status = '1' and banner_group = '" . $identifier . "'";
            $query = $this->db->query($qry);
            $banner = $query->result_array();

            if ($banner[0]['count'] > 0) {
                $query = $this->db->query("select banner_id, banner_title, banner_image, banner_html_text from banner where status = '1' and banner_group = '" . $identifier . "' ORDER BY RAND() LIMIT " . $limit);
                $banner1 = $query->result_array();
                $banner = $banner1; //[0] changed to get more than one banner;
            } else {
                return '<b>ERROR! (display_banner(' . $action . ', ' . $identifier . ') -> No banner with group \'' . $identifier . '\' found!</b>';
            }
        } elseif ($action == 'static') {
            if (is_array($identifier)) {
                $banner = $identifier;
            } else {
                $query = $this->db->query("select banner_id, banner_title, banner_image, banner_html_text from banner where status = '1' and banner_id = '" . (int)$identifier . "'");
                $banner_query = $query->result_array();
                if (count($banner_query) > 0) {
                    $banner = $banner_query; //[0];
                } else {
                    return '<b>ERROR! (display_banner(' . $action . ', ' . $identifier . ') -> Banner with ID \'' . $identifier . '\' not found, or status inactive</b>';
                }
            }
        } else {
            return '<b>ERROR! (display_banner(' . $action . ', ' . $identifier . ') -> Unknown $action parameter value - it must be either \'dynamic\' or \'static\'</b>';
        }

        return $this->format_banner($banner, $limit, $location);
        //return $banner_string;
    }

    ////

    //new -- modified by damu ---
    function format_banner($banner, $limit = 1, $location)
    {
        $banner_string = '';
        if ($limit == 1) {
            $banner = $banner[0];
            $this->update_banner_display_count($banner['banner_id']);

            if (!empty($banner['banner_html_text'])) {
                $banner_string = $banner['banner_html_text'];
            } else {
                $banner_string = anchor('redirect/banner/' . $banner['banner_id'], '<img border="0" src="images/' . $banner['banner_image'] . '" alt="' . $banner['banner_title'] . '" />');
            }
        }
        else
        {
            $banner[0]['limit'] = $limit;
            switch ($location) {
                case 'banner_146x52':
                    $banner_string = $this->banner_146x52($banner);
                    break;
                default:
                    $banner_string = '';
            }
        }

        return $banner_string;

    }

    function banner_146x52($banner)
    {
        is_array($banner) ? '' : $banner = array($banner);
        //$banner_string .= '<div class="banner_146x52"><h4>Advertise Here</h4><br />146 X 52 pixels</div>';
        $banner_string = '';
        foreach ($banner as $b) {
            if (!empty($b['banner_html_text'])) {
                $banner_string .= '<div class="banner_146x52">' . $b['banner_html_text'] . '</div>';
            } else {
                $banner_string .= '<div class="banner_146x52">' . anchor('redirect/banner/' . $b['banner_id'], '<img border="0" src="images/' . $b['banner_image'] . '" alt="' . $b['banner_title'] . '" />') . '</div>';
            }
            $this->update_banner_display_count($b['banner_id']);
        }

        $limit = $banner[0]['limit'];

        if (count($banner) < $limit) for ($i = count($banner); $i < $limit; $i++) {
            $banner_string .= '<div class="banner_146x52"><img border="0" alt="Advertise Here" src="img/banner_146x52.gif"/></div>';
        }

        return $banner_string;

    }

    // Check to see if a banner exists
    function banner_exists($action, $identifier)
    {
        if ($action == 'dynamic') {
            $query = $this->db->query("select banner_id, banner_title, banner_image, banner_html_text from banner where status = '1' and banner_group = '" . $identifier . "' ORDER BY RAND() LIMIT 1");
            $banner1 = $query->result_array();
            return $banner1[0];
        } elseif ($action == 'static') {
            $query = $this->db->query("select banner_id, banner_title, banner_image, banner_html_text from banner where status = '1' and banner_id = '" . (int)$identifier . "'");
            $banner1 = $query->result_array();
            return $banner1[0];
        } else {
            return false;
        }
    }

    ////

    // Update the banner display statistics
    function update_banner_display_count($banner_id)
    {
        $query = $this->db->query("select count(*) as count from banner_history where banner_id = '" . (int)$banner_id . "' and date_format(banner_history_date, '%Y%m%d') = date_format(now(), '%Y%m%d')");
        $banner_check_query = $query->result_array();
        $banner_check = $banner_check_query[0];

        if ($banner_check['count'] > 0) {
            $this->db->query("update banner_history set banner_shown = banner_shown + 1 where banner_id = '" . (int)$banner_id . "' and date_format(banner_history_date, '%Y%m%d') = date_format(now(), '%Y%m%d')");
        } else {
            $this->db->query("insert into banner_history (banner_id, banner_shown, banner_history_date) values ('" . (int)$banner_id . "', 1, now())");
        }
    }

    ////

// Update the banner click statistics
    function update_banner_click_count($banner_id)
    {
        $this->db->query("update banner_history set banner_clicked = banner_clicked + 1 where banner_id = '" . (int)$banner_id . "' and date_format(banner_history_date, '%Y%m%d') = date_format(now(), '%Y%m%d')");
    }
     */
}
