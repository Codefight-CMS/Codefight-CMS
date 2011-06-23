	<?php
/**
 * CodeIgniter Twitter API Library (http://www.haughin.com/code/twitter)
 * 
 * Author: Elliot Haughin (http://www.haughin.com), elliot@haughin.com
 *
 * ========================================================
 * REQUIRES: curl, json_decode, Connection Library (included)
 * ========================================================
 * 
 * VERSION: 2.2 (2009-03-07)
 * LICENSE: GNU GENERAL PUBLIC LICENSE - Version 2, June 1991
 * 
 **/

	class Twitter {
		
		var $_api_url			= 'http://twitter.com/';
		var $_api_search_url	= 'http://search.twitter.com/';
		
		var $_api_type	= '.json';
		
		var $_obj;
		
		var $_username = '';
		var $_password = '';
		
		function Twitter($params = array())
		{
			$this->_obj =& get_instance();
			$this->_obj->load->library('twitter_connection');
			
			if ( !empty($params['username']) ) $this->_username = $params['username'];
			if ( !empty($params['password']) ) $this->_username = $params['password'];
		}
		
		function auth($username, $password)
		{
			$this->_username = $username;
			$this->_password = $password;
		}
		
		function call($method_type, $method, $options = NULL)
		{
			$method = $method_type.'_'.$method;
			
			if ( $options === NULL )
			{
				return $this->$method();
			}
			else
			{
				return $this->$method($options);
			}
		}
		
		function _authenticate()
		{
			$this->_obj->twitter_connection->basic_auth($this->_username, $this->_password);
		}

		function _error($problem, $entity = '', $info = '')
		{
			log_message('error', 'Twitter: problem: '.$problem.', entity:'.$entity.', info: '.$info);
		}

		function _strip_unavailable_options($options_available, $options)
		{
			$options_stripped = array();

			foreach ( $options as $key => $value )
			{
				if ( in_array($key, $options_available) )
				{
					$options_stripped[$key] = $value;
				}
				
				if ( $key == 'since' )
				{
					$options_stripped[$key] = date('r', $value);
				}
			}

			return $options_stripped;
		}
	
		function _format_response($response)
		{
			return json_decode($response);
		}
		
		function _simple_get($method, $authenticate = FALSE)
		{
			if ( $authenticate === TRUE )
			{
				$this->_authenticate();
			}
			
			$url = $this->_api_url;
			
			if ( $method == 'search' || $method == 'trends' )
			{
				$url = $this->_api_search_url;
			}
			
			$url .= $method.$this->_api_type;
			
			return $this->_format_response($this->_obj->twitter_connection->get($url));
		}
		
		function _complex_get($method, $options_available, $options, $authenticate = FALSE)
		{
			if ( $authenticate === TRUE )
			{
				$this->_authenticate();
			}
			
			if ( is_array($options) && !empty($options) )
			{
				$options = $this->_strip_unavailable_options($options_available, $options);
				$this->_obj->twitter_connection->data($options);
			}
			
			$url = $this->_api_url;
			
			if ( $method == 'search' || $method == 'trends' )
			{
				$url = $this->_api_search_url;
			}
			
			$url .= $method.$this->_api_type;

			return $this->_format_response($this->_obj->twitter_connection->get($url));
		}
		
		function _complex_post($method, $options_available, $options, $authenticate = FALSE, $encode_options = FALSE)
		{
			if ( $authenticate === TRUE )
			{
				$this->_authenticate();
			}
			
			if ( is_array($options) && !empty($options) )
			{
				$options = $this->_strip_unavailable_options($options_available, $options);
				$this->_obj->twitter_connection->data($options, $encode_options);
			}
			
			$url = $this->_api_url;
			
			if ( $method == 'search' || $method == 'trends' )
			{
				$url = $this->_api_search_url;
			}
			
			$url .= $method.$this->_api_type;
			
			return $this->_format_response($this->_obj->twitter_connection->post($url));
		}
		
		function statuses_public_timeline()
		{
			$method = 'statuses/public_timeline';
			
			$url = $this->_api_url.$method.$this->_api_type;
						
			return $this->_simple_get($url);
		}
		
		function statuses_friends_timeline($options = array())
		{
			$method = 'statuses/friends_timeline';
			$options_available = array('since', 'since_id', 'count', 'page');
			
			return $this->_complex_get($method, $options_available, $options, TRUE);
		}
		
		function statuses_user_timeline($options = array())
		{
			$method = 'statuses/user_timeline';			
			$options_available = array('id', 'count', 'since', 'since_id', 'page');
			
			return $this->_complex_get($method, $options_available, $options, TRUE);
		}
		
		function statuses_show($options = array())
		{
			if ( !isset($options['id']) )
			{
				$this->_error('required_option', 'status');
				return FALSE;
			}
			
			$options_available = array('id');
			
			$method = 'statuses/show';
			
			return $this->_complex_get($method, $options_available, $options);
		}
		
		function statuses_update($options = array())
		{
			if ( !isset($options['status']) )
			{
				$this->_error('required_option', 'status');
				return FALSE;
			}
			
			$method = 'statuses/update';
			$options_available = array('status', 'in_reply_to_status_id');
			
			return $this->_complex_post($method, $options_available, $options, TRUE);
		}
		
		function statuses_destroy($options = array())
		{
			if ( !isset($options['id']) )
			{
				$this->_error('required_option', 'id');
				return FALSE;
			}
			
			$method = 'statuses/destroy';
			$options_available = array('id');
			
			return $this->_complex_post($method, $options_available, $options, TRUE);
		}
		
		function user_friends($options = array())
		{
			$method = 'statuses/friends';
			$options_available = array('id', 'page');
			
			return $this->_complex_get($method, $options_available, $options, TRUE);
		}
		
		function user_followers($options = array())
		{
			$method = 'statuses/followers';
			$options_available = array('id', 'page');
			
			return $this->_complex_get($method, $options_available, $options, TRUE);
		}
		
		function user_show($options = array())
		{
			$method = 'user/show';
			$options_available = array('id', 'email', 'user_id', 'screen_name');
			
			return $this->_complex_get($method, $options_available, $options, TRUE);
		}
		
		function direct_messages_list($options = array())
		{
			$method = 'direct_messages';
			$options_available = array('since', 'since_id', 'page');
			
			return $this->_complex_get($method, $options_available, $options, TRUE);
		}
		
		function direct_messages_sent($options = array())
		{
			$method = 'direct_messages/sent';
			$options_available = array('since', 'since_id', 'page');
			
			return $this->_complex_get($method, $options_available, $options, TRUE);
		}
		
		function direct_messages_new($options = array())
		{
			if ( !isset($options['user']) )
			{
				$this->_error('required_option', 'user');
				return FALSE;
			}
			
			if ( !isset($options['text']) )
			{
				$this->_error('required_option', 'text');
				return FALSE;
			}
			
			$method = 'direct_messages/new';
			$options_available = array('user', 'text');
			
			return $this->_complex_post($method, $options_available, $options, TRUE);
		}
		
		function direct_messages_destroy($options = array())
		{
			if ( !isset($options['id']) )
			{
				$this->_error('required_option', 'id');
				return FALSE;
			}
			
			$method = 'direct_messages/destroy';
			$options_available = array('id');
			
			return $this->_complex_post($method, $options_available, $options, TRUE);
		}
		
		function friendships_create($options = array())
		{
			if ( !isset($options['id']) )
			{
				$this->_error('required_option', 'id');
				return FALSE;
			}
			
			$method = 'friendships/create';
			$options_available = array('id', 'follow');
			
			return $this->_complex_post($method, $options_available, $options, TRUE);
		}
		
		function friendships_destroy($options = array())
		{
			if ( !isset($options['id']) )
			{
				$this->_error('required_option', 'id');
				return FALSE;
			}
			
			$method = 'friendships/destroy';
			$options_available = array('id');
			
			return $this->_complex_post($method, $options_available, $options, TRUE);
		}
		
		function friendships_exists($options = array())
		{
			if ( !isset($options['user_a']) )
			{
				$this->_error('required_option', 'user_a');
				return FALSE;
			}
			
			if ( !isset($options['user_b']) )
			{
				$this->_error('required_option', 'user_b');
				return FALSE;
			}
			
			$method = 'friendships/exists';
			$options_available = array('user_a', 'user_b');
			
			return $this->_complex_get($method, $options_available, $options);
		}
		
		function friends_ids($options = array())
		{
			$method = 'friends/ids';
			$options_available = array('id');
			
			return $this->_complex_get($method, $options_available, $options, TRUE);
		}
		
		function followers_ids($options = array())
		{
			$method = 'followers/ids';
			$options_available = array('id');
			
			return $this->_complex_get($method, $options_available, $options, TRUE);
		}
		
		function account_verify_credentials()
		{
			$method = 'account/verify_credentials';
			
			return $this->_simple_get($method, TRUE);
		}
		
		function account_end_session()
		{
			// TODO handle cookies right throughout.
			return NULL;
		}
		
		function account_update_delivery_device($options = array())
		{
			$options_acceptable = array('device' => array('none', 'sms', 'im'));
			
			if ( !isset($options['device']) )
			{
				$this->_error('required_option', 'device');
				return FALSE;
			}
			
			if ( !in_array($options['device'], $options_acceptable['device']) )
			{
				$this->_error('unacceptable_option', 'device', 'must be one of: '.implode(',', $options_acceptable['device']));
				return FALSE;
			}
			
			$method = 'account/update_delivery_device';
			$options_available = array('device');
			
			return $this->_complex_post($method, $options_available, $options, TRUE);
		}
		
		function account_update_profile_colors($options = array())
		{
			$method = 'account/update_profile_colors';
			
			$options_available = 	array(
										'profile_background_color',
										'profile_text_color',
										'profile_link_color',
										'profile_sidebar_fill_color',
										'profile_sidebar_border_color'
									);
			
			return $this->_complex_post($method, $options_available, $options, TRUE);
		}
		
		function account_update_profile_image($options = array())
		{
			// TODO: Had some real problems with this one :(
				
			return NULL;
		}
		
		function account_update_profile_background_image($options = array())
		{
			// TODO: Had some real problems with this one :(
				
			return NULL;
		}
	
		function account_rate_limit_status()
		{
			$method = 'account/rate_limit_status';
			
			$url = $this->_api_url.$method.$this->_api_type;
						
			return $this->_simple_get($url, TRUE);
		}
		
		function account_update_profile($options = array())
		{
			$maximum_lengths = 	array(
										'name' 		=> 20,
										'email' 	=> 40,
										'url' 		=> 100,
										'location' 	=> 30,
										'description' => 60
									);
			
			foreach ( $maximum_lengths as $key => $length )
			{
				if ( isset($options[$key]) && strlen($options[$key]) > $length )
				{
					$this->_error('unacceptable_option', $key, 'must be '.$length.' or less characters');
					return FALSE;
				}
			}
			
			if ( isset($options['email']) && !valid_email($options['email']) )
			{
				$this->_error('unacceptable_option', 'device', 'must be valid email address');
				return FALSE;
			}

			$method = 'account/update_profile';
			$options_available = array('name', 'email', 'url', 'location', 'description');
			
			return $this->_complex_post($method, $options_available, $options, TRUE);
		}

		function favorites_get($options = array())
		{
			$method = 'favorites/get';
			$options_available = array('id', 'page');
			
			return $this->_complex_get($method, $options_available, $options, TRUE);
		}

		function favorites_create($options = array())
		{
			if ( !isset($options['id']) )
			{
				$this->_error('required_option', 'id');
				return FALSE;
			}
			
			$method = 'favorites/create';
			$options_available = array('id');
			
			return $this->_complex_post($method, $options_available, $options, TRUE);
		}
		
		function favorites_destroy($options = array())
		{
			if ( !isset($options['id']) )
			{
				$this->_error('required_option', 'id');
				return FALSE;
			}
			
			$method = 'favorites/destroy';
			$options_available = array('id');
			
			return $this->_complex_post($method, $options_available, $options, TRUE);
		}
		
		function notifications_follow($options = array())
		{
			if ( !isset($options['id']) )
			{
				$this->_error('required_option', 'id');
				return FALSE;
			}
			
			$method = 'notifications/follow';
			$options_available = array('id');
			
			return $this->_complex_post($method, $options_available, $options, TRUE);
		}

		function notifications_leave($options = array())
		{
			if ( !isset($options['id']) )
			{
				$this->_error('required_option', 'id');
				return FALSE;
			}
			
			$method = 'notifications/leave';
			$options_available = array('id');
			
			return $this->_complex_post($method, $options_available, $options, TRUE);
		}
		
		function block_create($options = array())
		{
			if ( !isset($options['id']) )
			{
				$this->_error('required_option', 'id');
				return FALSE;
			}
			
			$method = 'block/create';
			$options_available = array('id');
			
			return $this->_complex_post($method, $options_available, $options, TRUE);
		}

		function block_destroy($options = array())
		{
			if ( !isset($options['id']) )
			{
				$this->_error('required_option', 'id');
				return FALSE;
			}
			
			$method = 'block/destroy';
			$options_available = array('id');
			
			return $this->_complex_post($method, $options_available, $options, TRUE);
		}

		function search_search($options = array())
		{
			if ( !isset($options['q']) )
			{
				$this->_error('required_option', 'q');
				return FALSE;
			}
			
			$method = 'search';
			
			$options_available = array('q', 'lang', 'rpp', 'page', 'since_id', 'geocode', 'show_user');
			return $this->_complex_get($method, $options_available, $options);
		}
		
		function search_trends()
		{
			$method = 'trends';
			
			return $this->_simple_get($method);
		}
	}