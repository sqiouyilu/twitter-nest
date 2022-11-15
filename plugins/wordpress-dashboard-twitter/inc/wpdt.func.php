<?php
if ( !function_exists('is_admin') ) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
}

use Abraham\TwitterOAuth\TwitterOAuth;

/**
 * Retrieve twitter mentions
 *
 * SACK response function
 *
 * @since 		0.8
 * @param 		boolean $ajaxCall
 * @return 		string $replyoutput
 * @author 		scripts@schloebe.de
 */
function wpdt_load_replies( $ajaxCall ) {
	// security check
	check_ajax_referer( 'wpdt_woelfi_nonce' );
	
	require_once( dirname(__FILE__) . '/vendor/autoload.php');
	require_once( dirname(__FILE__) . '/config.php');
	
	$wpdt = new WPDashboardTwitter;
	$options = $wpdt->dashboard_widget_options();
	
	$twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $options['wpdt_oauth_token'], $options['wpdt_oauth_secret']);
	$replies_json = $twitter->get('statuses/mentions_timeline', array('count' => $options['items']));
	$ajaxCall = $_POST['ajaxCall'];
	
	$replyoutput = '';
	if( count($replies_json) == 0 ) {
		$replyoutput .= '<li>' . __('No mentions!', 'wp-dashboard-twitter') . '</li>';
	} else {
		foreach ($replies_json as $replies) {
			$replytext = WPDashboardTwitter::hyperlinkit( WPDashboardTwitter_Helper::esc_js( $replies->text ) );
			
			$replyurl = sprintf('http://twitter.com/home?status=@%s &in_reply_to_status_id=%s&in_reply_to=%s', $replies->user->name, $replies->id, $replies->user->name);
			
			$replyoutput .= '<li id="wpdtreply-' . $replies->id . '"><div class="comment-item wpdt-reply-item">';
			if( $options['show_avatars'] )
				$replyoutput .= '<div class="avatar"><img src="' . wpdt_get_twitter_profile_img_url( $replies->user ) . '" border="0" width="48" height="48" alt="" /></div>';
				
			$replyoutput .= '<h4 class="wpdt-sender comment-meta">' . __( 'From', 'wp-dashboard-twitter' ) . ' <a href="http://twitter.com/' . urldecode( $replies->user->screen_name ) . '" class="url">' . WPDashboardTwitter_Helper::esc_html( $replies->user->screen_name ) . '</a> | <a href="' . urldecode( $replyurl ) . '" replytoname="' . $replies->user->screen_name . '" onclick="WPDashboardTwitter.reply(this, 0, ' . $replies->id . '); return false;" class="meta-reply" title="' . WPDashboardTwitter_Helper::esc_attr( __('Reply to a user', 'wp-dashboard-twitter') ) . '"><img src="' . WPDashboardTwitter_Helper::plugins_url('img/reply.png', __FILE__) . '" border="0" alt="' . WPDashboardTwitter_Helper::esc_attr( __('Reply', 'wp-dashboard-twitter') ) . '" /></a> <a href="#" onclick="WPDashboardTwitter.reply(this, 2, ' . $replies->id . '); return false;" title="' . WPDashboardTwitter_Helper::esc_attr( __('Retweet this message', 'wp-dashboard-twitter') ) . '"><img src="' . WPDashboardTwitter_Helper::plugins_url('img/retweet.png', __FILE__) . '" border="0" alt="' . WPDashboardTwitter_Helper::esc_attr( __('Retweet this message', 'wp-dashboard-twitter') ) . '" /></a></h4>';
			$replyoutput .= '<blockquote class="wpdt-text"><p>' . $replytext . '</p></blockquote>';
			$replyoutput .= '<div class="wpdt-meta">';
			$replyoutput .= WPDashboardTwitter::human_diff_time_l10n( $replies->created_at );
			if( !empty( $replies->in_reply_to_screen_name ) ) {
				$replyoutput .= ' <a href="http://twitter.com/' . WPDashboardTwitter_Helper::esc_html( $replies->in_reply_to_screen_name ) . '/status/' . $replies->in_reply_to_status_id . '" target="_blank">' . __( 'in reply to', 'wp-dashboard-twitter' ) . ' ' . WPDashboardTwitter_Helper::esc_html( $replies->in_reply_to_screen_name ) . '</a>';
			}
			$replyoutput .= '</div>';
			$replyoutput .= '<div style="clear:both;"></div>';
			$replyoutput .= '</div></li>';
		}
	}
	if( $ajaxCall )
		die( "jQuery('#wpdt-replies-wrapper').html('" . $replyoutput . "').hide().fadeIn();" );
	else
		return $replyoutput;wp_die();
}

/**
 * Retrieve twitter friends timeline
 *
 * SACK response function
 *
 * @since 		1.0
 * @param 		boolean $ajaxCall
 * @return 		string $replyoutput
 * @author 		scripts@schloebe.de
 */
function wpdt_load_timeline( $ajaxCall ) {
	// security check
	check_ajax_referer( 'wpdt_woelfi_nonce' );
	
	require_once( dirname(__FILE__) . '/vendor/autoload.php');
	require_once( dirname(__FILE__) . '/config.php');
	
	$wpdt = new WPDashboardTwitter;
	$options = $wpdt->dashboard_widget_options();
	
	$twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $options['wpdt_oauth_token'], $options['wpdt_oauth_secret']);
	$timeline_json = $twitter->get('statuses/home_timeline', array('count' => $options['items'], 'include_entities' => 0));
	
	$ajaxCall = $_POST['ajaxCall'];
	
	$timelineoutput = '';
	if( count($timeline_json) == 0 ) {
		$timelineoutput .= '<li>' . __('No statuses!', 'wp-dashboard-twitter') . '</li>';
	} else {
		foreach ($timeline_json as $timeline) {
			$timelinetext = WPDashboardTwitter::hyperlinkit( WPDashboardTwitter_Helper::esc_js( $timeline->text ) );
			
			$timelineurl = sprintf('http://twitter.com/home?status=@%s &in_reply_to_status_id=%s&in_reply_to=%s', $timeline->user->name, $timeline->id, $timeline->user->name);
			
			$timelineoutput .= '<li id="wpdttimeline-' . $timeline->id . '"><div class="comment-item wpdt-reply-item">';
			if( $options['show_avatars'] )
				$timelineoutput .= '<div class="avatar"><img src="' . wpdt_get_twitter_profile_img_url( $timeline->user ) . '" border="0" width="48" height="48" alt="" /></div>';
				
			$timelineoutput .= '<h4 class="wpdt-sender comment-meta">' . __( 'From', 'wp-dashboard-twitter' ) . ' <a href="http://twitter.com/' . urldecode( $timeline->user->screen_name ) . '" class="url">' . WPDashboardTwitter_Helper::esc_html( $timeline->user->screen_name ) . '</a> | <a href="' . urldecode( $timelineurl ) . '" replytoname="' . $timeline->user->screen_name . '" onclick="WPDashboardTwitter.reply(this, 0, ' . $timeline->id . '); return false;" class="meta-reply" title="' . WPDashboardTwitter_Helper::esc_attr( __('Reply to a user', 'wp-dashboard-twitter') ) . '"><img src="' . WPDashboardTwitter_Helper::plugins_url('img/reply.png', __FILE__) . '" border="0" alt="' . WPDashboardTwitter_Helper::esc_attr( __('Reply', 'wp-dashboard-twitter') ) . '" /></a> <a href="#" onclick="WPDashboardTwitter.reply(this, 2, ' . $timeline->id . '); return false;" title="' . WPDashboardTwitter_Helper::esc_attr( __('Retweet this message', 'wp-dashboard-twitter') ) . '"><img src="' . WPDashboardTwitter_Helper::plugins_url('img/retweet.png', __FILE__) . '" border="0" alt="' . WPDashboardTwitter_Helper::esc_attr( __('Retweet this message', 'wp-dashboard-twitter') ) . '" /></a></h4>';
			$timelineoutput .= '<blockquote class="wpdt-text"><p>' . $timelinetext . '</p></blockquote>';
			$timelineoutput .= '<div class="wpdt-meta">';
			#$retweetsoutput.= print_r($retweet,true);
			if( !empty( $timeline->id_str ) ) {
				$timelineoutput .= ' <a href="http://twitter.com/' . WPDashboardTwitter_Helper::esc_html( $timeline->user->screen_name ) . '/status/' . $timeline->id_str . '" target="_blank">';
			}
			$timelineoutput .= WPDashboardTwitter::human_diff_time_l10n( $timeline->created_at );
			if( !empty( $timeline->id_str ) ) {
				$timelineoutput .= ' </a>';
			}
			if( !empty( $timeline->in_reply_to_screen_name ) ) {
				$timelineoutput .= ' ' . __( 'in reply to', 'wp-dashboard-twitter' ) . ' <a href="http://twitter.com/' . WPDashboardTwitter_Helper::esc_html( $timeline->in_reply_to_screen_name ) . '/status/' . $timeline->in_reply_to_status_id . '" target="_blank">' . WPDashboardTwitter_Helper::esc_html( $timeline->in_reply_to_screen_name ) . '</a>';
			}
			$timelineoutput .= '</div>';
			$timelineoutput .= '<div style="clear:both;"></div>';
			$timelineoutput .= '</div></li>';
		}
	}
	if( $ajaxCall )
		die( "jQuery('#wpdt-timeline-wrapper').html('" . $timelineoutput . "').hide().fadeIn();" );
	else
		return $timelineoutput;
}


/**
 * Retrieve twitter likes
 *
 * SACK response function
 *
 * @since 		0.8
 * @param 		boolean $ajaxCall
 * @return 		string $favoritesoutput
 * @author 		scripts@schloebe.de
 */
function wpdt_load_favorites( $ajaxCall ) {
	// security check
	check_ajax_referer( 'wpdt_woelfi_nonce' );
	
	require_once( dirname(__FILE__) . '/vendor/autoload.php');
	require_once( dirname(__FILE__) . '/config.php');
	
	$wpdt = new WPDashboardTwitter;
	$options = $wpdt->dashboard_widget_options();
	
	$twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $options['wpdt_oauth_token'], $options['wpdt_oauth_secret']);
	$favorites_json = $twitter->get('favorites/list', array('count' => $options['items']));
	$ajaxCall = $_POST['ajaxCall'];
	
	$favoritesoutput = ''; $i_fav = 1;
	if( count($favorites_json) == 0 ) {
		$favoritesoutput .= '<li>' . __('No favorites!', 'wp-dashboard-twitter') . '</li>';
	} else {
		$i_fav = 0;
		foreach ($favorites_json as $favorite) {
			if( $i_fav > $options['items'] ) {
				break;
			}
			$favoritestext = WPDashboardTwitter::hyperlinkit( WPDashboardTwitter_Helper::esc_js( $favorite->text ) );
			$favoritesoutput .= '<li>';
			if( $options['show_avatars'] )
				$favoritesoutput .= '<div class="avatar"><img src="' . wpdt_get_twitter_profile_img_url( $favorite->user ) . '" width="48" height="48" border="0" alt="" /></div>';
				
			$favoritesoutput .= '<h4 class="wpdt-sender">' . sprintf(__( 'By %s' ), '<a href="http://twitter.com/' . urlencode( $favorite->user->screen_name ) . '" class="url">' . WPDashboardTwitter_Helper::esc_html( $favorite->user->screen_name ) . '</a>') . ' | ' . sprintf( _n( 'Liked %d time', 'Liked %d times', $favorite->favorite_count, 'wp-dashboard-twitter'), $favorite->favorite_count ) . '</h4>';
			$favoritesoutput .= '<blockquote class="wpdt-text"><p>' . $favoritestext . '</p></blockquote>';
			$favoritesoutput .= '<div class="wpdt-meta">';
			if( !empty( $favorite->id_str ) ) {
				$favoritesoutput.= ' <a href="http://twitter.com/' . WPDashboardTwitter_Helper::esc_html( $favorite->user->screen_name ) . '/status/' . $favorite->id_str . '" target="_blank">';
			}
			$favoritesoutput .= WPDashboardTwitter::human_diff_time_l10n( $favorite->created_at );
			if( !empty( $favorite->id_str ) ) {
				$favoritesoutput.= ' </a>';
			}
			$favoritesoutput .= '</div>';
			$favoritesoutput .= '<div style="clear:both;"></div></li>';
			$i_fav++;
		}
	}
	if( $ajaxCall )
		die( "jQuery('#wpdt-fav-wrapper').html('" . $favoritesoutput . "').hide().fadeIn();" );
	else
		return $favoritesoutput;
}


/**
 * Retrieve user twitter messages that have been retweeted by others
 *
 * SACK response function
 *
 * @since 		1.0
 * @param 		boolean $ajaxCall
 * @return 		string $favoritesoutput
 * @author 		scripts@schloebe.de
 */
function wpdt_load_retweets( $ajaxCall ) {
	// security check
	check_ajax_referer( 'wpdt_woelfi_nonce' );
	
	require_once( dirname(__FILE__) . '/vendor/autoload.php');
	require_once( dirname(__FILE__) . '/config.php');
	
	$wpdt = new WPDashboardTwitter;
	$options = $wpdt->dashboard_widget_options();
	
	$twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $options['wpdt_oauth_token'], $options['wpdt_oauth_secret']);
	$retweets_json = $twitter->get('statuses/retweets_of_me', array('count' => $options['items']));
	
	$ajaxCall = $_POST['ajaxCall'];
	
	$retweetsoutput = '';
	if( count($retweets_json) == 0 ) {
		$retweetsoutput .= '<li>' . __('No retweets of your statuses yet!', 'wp-dashboard-twitter') . '</li>';
	} else {
		$i_retweets = 0;
		foreach ($retweets_json as $retweet) {
			$retweetstext = WPDashboardTwitter::hyperlinkit( WPDashboardTwitter_Helper::esc_js( $retweet->text ) );
			$retweetsoutput .= '<li>';
			if( $options['show_avatars'] )
				$retweetsoutput .= '<div class="avatar"><img src="' . wpdt_get_twitter_profile_img_url( $retweet->user ) . '" width="48" height="48" border="0" alt="" /></div>';
				
			$retweetsoutput .= '<h4 class="wpdt-sender">' . sprintf(__( 'By %s' ), '<a href="http://twitter.com/' . urlencode( $retweet->user->screen_name ) . '" class="url">' . WPDashboardTwitter_Helper::esc_html( $retweet->user->screen_name ) . '</a>') . ' | ' . sprintf( _n( 'Retweeted %d time', 'Retweeted %d times', $retweet->retweet_count, 'wp-dashboard-twitter'), $retweet->retweet_count ) . '</h4>';
			$retweetsoutput .= '<blockquote class="wpdt-text"><p>' . $retweetstext . '</p></blockquote>';
			$retweetsoutput .= '<div class="wpdt-meta">';
			if( !empty( $retweet->id_str ) ) {
				$retweetsoutput .= ' <a href="http://twitter.com/' . WPDashboardTwitter_Helper::esc_html( $retweet->user->screen_name ) . '/status/' . $retweet->id_str . '" target="_blank">';
			}
			$retweetsoutput .= WPDashboardTwitter::human_diff_time_l10n( $retweet->created_at );
			if( !empty( $retweet->id_str ) ) {
				$retweetsoutput .= ' </a>';
			}
			$retweetsoutput .= '</div>';
			$retweetsoutput .= '<div style="clear:both;"></div></li>';
			$i_retweets++;
		}
	}
	if( $ajaxCall )
		die( "jQuery('#wpdt-retweets-wrapper').html('" . $retweetsoutput . "').hide().fadeIn();" );
	else
		return $retweetsoutput;
}


/**
 * Send a status update
 *
 * SACK response function
 *
 * @since 		0.8
 * @param 		boolean $ajaxCall
 * @author 		scripts@schloebe.de
 */
function wpdt_send_update( $ajaxCall ) {
	// security check
	check_ajax_referer( 'wpdt_woelfi_nonce' );
	
	require_once( dirname(__FILE__) . '/vendor/autoload.php');
	require_once( dirname(__FILE__) . '/config.php');
	
	if( !isset($_POST['in_reply_to_statusid']) || $_POST['in_reply_to_statusid'] == '' )
		$in_reply_to = '';
	else
		$in_reply_to = $_POST['in_reply_to_statusid'];
		
	$wpdt = new WPDashboardTwitter;
	$options = $wpdt->dashboard_widget_options();
	
	$twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $options['wpdt_oauth_token'], $options['wpdt_oauth_secret']);
	$twitter->useragent = 'WordPress Dashboard Twitter';
	$twitter->post('statuses/update', array('status' => stripslashes($_POST['status_text']), 'in_reply_to_status_id' => $in_reply_to));
}


/**
 * Grabs Twitter profile image url from API user object
 *
 * @since 		1.1.20
 * @param 		object $usr
 * @return 		string $url
 * @author 		scripts@schloebe.de
 */
function wpdt_get_twitter_profile_img_url( $usr ) {
	$identifier = 'profile_image_url';
	if ( is_ssl() ) {
		$identifier .= '_https';
	}
	
	return urldecode( $usr->$identifier );
}
?>