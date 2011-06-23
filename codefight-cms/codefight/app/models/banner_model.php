<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Banner_model extends MY_Model {

	function Banner_model()
    {
        // Call the Model constructor
        parent::MY_Model();
    }
	
	// Sets the status of a banner
	function tep_set_banner_status($banner_id, $status) {
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
	function tep_activate_banner() {
		$qry = "select banner_id, date_scheduled from banner where date_scheduled != ''";
		$query = $this->db->query($qry);
		$banner_query = $query->result_array();
		
		if (count($banner_query)>0) {
			foreach($banner_query as $banner) {
				if (date('Y-m-d H:i:s') >= $banner['date_scheduled']) {
					$this->tep_set_banner_status($banner['banner_id'], '1');
				}
			}
		}
	}
	
	////

	// Auto expire banner, called at last from footer
	function tep_expire_banner() {
		$qry = "select b.banner_id, b.expire_date, b.expire_impressions, b.expire_clicks, sum(bh.banner_shown) as banner_shown, sum(bh.banner_clicked) as banner_clicked from banner b, banner_history bh where b.status = '1' and b.banner_id = bh.banner_id group by b.banner_id";
		$query = $this->db->query($qry);
		$banner_query = $query->result_array();
	
		if (count($banner_query)>0) {
			foreach($banner_query as $banner) {
				if ($banner['expire_date'] != '' && $banner['expire_date'] != null) {
					if (date('Y-m-d H:i:s') >= $banner['expire_date']) {
						$this->tep_set_banner_status($banner['banner_id'], '0');
					}
				} elseif ($banner['expire_impressions'] != '' && $banner['expire_impressions'] != null) {
					if ( ($banner['expire_impressions'] > 0) && ($banner['banner_shown'] >= $banner['expire_impressions']) ) {
						$this->tep_set_banner_status($banner['banner_id'], '0');
					}
				} elseif ($banner['expire_clicks'] != '' && $banner['expire_clicks'] != null && $banner['expire_clicks'] != 0) {
					if ( ($banner['expire_clicks'] > 0) && ($banner['banner_clicked'] >= $banner['expire_clicks']) ) {
						$this->tep_set_banner_status($banner['banner_id'], '0');
					}
				}
			}
		}
	}
	////

	// Display a banner from the specified group or banner id ($identifier)
	function tep_display_banner($action, $identifier, $limit = '1', $location = '') {
		if ($action == 'dynamic') {
			$qry = "select count(*) as count from banner where status = '1' and banner_group = '" . $identifier . "'";
			$query = $this->db->query($qry);
			$banner = $query->result_array();
			
			if ($banner[0]['count'] > 0) {
				$query = $this->db->query("select banner_id, banner_title, banner_image, banner_html_text from banner where status = '1' and banner_group = '" . $identifier . "' ORDER BY RAND() LIMIT " . $limit);
				$banner1 = $query->result_array();
				$banner = $banner1;//[0] changed to get more than one banner;
			} else {
				return '<b>ERROR! (tep_display_banner(' . $action . ', ' . $identifier . ') -> No banner with group \'' . $identifier . '\' found!</b>';
			}
		} elseif ($action == 'static') {
			if (is_array($identifier)) {
				$banner = $identifier;
			} else {
				$query = $this->db->query("select banner_id, banner_title, banner_image, banner_html_text from banner where status = '1' and banner_id = '" . (int)$identifier . "'");
				$banner_query = $query->result_array();
				if (count($banner_query)>0) {
					$banner = $banner_query;//[0];
				} else {
					return '<b>ERROR! (tep_display_banner(' . $action . ', ' . $identifier . ') -> Banner with ID \'' . $identifier . '\' not found, or status inactive</b>';
				}
			}
		} else {
			return '<b>ERROR! (tep_display_banner(' . $action . ', ' . $identifier . ') -> Unknown $action parameter value - it must be either \'dynamic\' or \'static\'</b>';
		}

		return $this->format_banner($banner, $limit, $location);
		//return $banner_string;
	}
	////
	
	//new -- modified by damu ---
	function format_banner($banner, $limit = 1, $location) {
		$banner_string = '';
		if($limit == 1){
			$banner = $banner[0];
			$this->tep_update_banner_display_count($banner['banner_id']);
			
			if (!empty($banner['banner_html_text'])) {
				$banner_string = $banner['banner_html_text'];
			} else {
				$banner_string = anchor('redirect/banner/' . $banner['banner_id'],'<img border="0" src="images/' . $banner['banner_image'] . '" alt="' . $banner['banner_title'] . '" />');
			}
		}
		else
		{
			$banner[0]['limit'] = $limit;
			switch($location){
				case 'banner_146x52':
					$banner_string = $this->banner_146x52($banner);
					break;
				default:
					$banner_string = '';
			}
		}
		
		return $banner_string;
		
	}

	function banner_146x52($banner) {
		is_array($banner)? '': $banner = array($banner);
		//$banner_string .= '<div class="banner_146x52"><h4>Advertise Here</h4><br />146 X 52 pixels</div>';
		$banner_string = '';
		foreach($banner as $b) {
			if (!empty($b['banner_html_text'])) {
				$banner_string .= '<div class="banner_146x52">' . $b['banner_html_text'] . '</div>';
			} else {
				$banner_string .= '<div class="banner_146x52">' . anchor('redirect/banner/'.$b['banner_id'] ,'<img border="0" src="images/' . $b['banner_image'] . '" alt="' . $b['banner_title'] . '" />') . '</div>';
			}
			$this->tep_update_banner_display_count($b['banner_id']);
		}
		
		$limit = $banner[0]['limit'];
		
		if(count($banner) < $limit) for ($i = count($banner); $i < $limit; $i++){
			$banner_string .= '<div class="banner_146x52"><img border="0" alt="Advertise Here" src="img/banner_146x52.gif"/></div>';
		}
		
		return $banner_string;
		
	}

	// Check to see if a banner exists
	function tep_banner_exists($action, $identifier) {
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
	function tep_update_banner_display_count($banner_id) {
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
  function tep_update_banner_click_count($banner_id) {
		$this->db->query("update banner_history set banner_clicked = banner_clicked + 1 where banner_id = '" . (int)$banner_id . "' and date_format(banner_history_date, '%Y%m%d') = date_format(now(), '%Y%m%d')");
  }

}
?>