<?php

if ( function_exists('register_sidebar') )
    register_sidebar();

add_action( 'wp_enqueue_scripts', function(){ wp_enqueue_script( 'jquery' ); } );

function otat_get_tweet_style() {
    $title    = strlen( get_the_title() );
    $is_reply = ozh_ta_is_reply_or_not( false );
    if( $title > 100 ) {
        $style = 'long';
    } elseif ( $title > 50 ) {
        $style = 'medium';
    } else {
        $style = 'short';
    }
    return "$style $is_reply";
}

function otat_month_archives() {
    global $wpdb;
    $where = "WHERE post_type = 'post' AND post_status = 'publish'";
    $query = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM $wpdb->posts $where GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY YEAR DESC, MONTH ASC";
    $_archive = $wpdb->get_results( $query );

    $last_year  = (int) $_archive[0]->year;
    $first_year = (int) $_archive[ count( $_archive ) - 1 ]->year;

    $archive    = array();
    $max        = 0;
    $year_total = array();
    
    foreach( $_archive as $data ) {
        if( !isset( $year_total[ $data->year ] ) ) {
            $year_total[ $data->year ] = 0;
        }
        $archive[ $data->year ][ $data->month ] = $data->posts;
        $year_total[ $data->year ] += $data->posts;
        $max = max( $max, $data->posts );
    }
    unset( $_archive );

    for ( $year = $last_year; $year >= $first_year; $year-- ) {
        echo '<section class="archive-year">';
        echo '<h3 class="archive-year-title"><span class="archive-year-label">' . $year . '</span>';
        if( isset( $year_total[$year] ) ) {
            echo '<span class="archive-year-count">' . $year_total[$year] . ' Tweets</span>';
        }
        echo '</h3>';
        echo '<ol class="archive-visualizer">';
        for ( $month = 1; $month <= 12; $month++ ) {
            $num = isset( $archive[ $year ][ $month ] ) ? $archive[ $year ][ $month ] : 0;
            $empty = $num ? 'not-empty' : 'empty';
            echo "<li class='$empty'>";
            $height = 100 - max( floor( $num / $max * 100 ), 20 );
            if( $num ) {
                $url = get_month_link( $year, $month );
                $m = str_pad( $month, 2, "0", STR_PAD_LEFT);
                echo "<a href='$url' title='$m/$year : $num tweets'><span class='archive-bar-wrap'><span class='archive-bar' style='height:$height%'></span></span>";
                echo "<span class='archive-bar-label'>" . $m . "</span>";
                echo "</a>";
            }
            echo '</li>';
        }
        echo '</ol>';
        echo "</section>";
    }
}

// Begin additions by S. Qiouyi Lu
// Add custom menus

// Add Custom Navigation Menus
function nest_navigation_menus() {
	$menus = array( 
		'global' => __( 'Site-wide navigation', 'text_domain' ),
		'desktop' => __( 'Desktop navigation', 'text_domain' ),
		'mobile' => __( 'Mobile navigation', 'text_domain' ),
		'links-out' => __( 'Links out', 'text_domain' ),
		);
	register_nav_menus( $menus );
}
add_action( 'init', 'nest_navigation_menus' );

/**
 * Provides a default menu of links out including a Twitter account if not other menu has been provided.
*/
function nest_default_links() {

	$html = '<ul id="user-contact">';
		$html .= '<li class="user-handle">';
			$html .= '<i class="fa-brands fa-twitter"></i>';
			$html .= '@<a href="https://twitter.com/' . get_theme_mod('twitter_username') . '" target="_new" rel="noopener">' . get_theme_mod('twitter_username') . '</a>';
		$html .= '</li>';			
	$html .= '</ul>';
	echo $html;

} // end nest_default_links

// Add Font Awesome menu icon support
function menu_fontawesome_icon( $item_id, $item ) {
	$menu_fontawesome_icon = get_post_meta( $item_id, '_menu_fontawesome_icon', true );
	?>
	<div style="clear: both;">
	    <span class="font-awesome"><?php _e( "Font Awesome icon identifier", 'font-awesome-identifier' ); ?></span><br />
		<a href="https://fontawesome.com/search" target="_new" rel="noopener">Search for icons</a><br />
	    <input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />
	    <div class="logged-input-holder">
	        <input style="width: 100%;" type="text" name="menu_fontawesome_icon[<?php echo $item_id ;?>]" id="fontawesome-menu-<?php echo $item_id ;?>" value="<?php echo esc_attr( $menu_fontawesome_icon ); ?>" />
	    </div>
	</div>
	<?php
}
add_action( 'wp_nav_menu_item_custom_fields', 'menu_fontawesome_icon', 10, 2 );

function save_menu_fontawesome_icon( $menu_id, $menu_item_db_id ) {
	if ( isset( $_POST['menu_fontawesome_icon'][$menu_item_db_id]  ) ) {
		$sanitized_data = sanitize_text_field( $_POST['menu_fontawesome_icon'][$menu_item_db_id] );
		update_post_meta( $menu_item_db_id, '_menu_fontawesome_icon', $sanitized_data );
	} else {
		delete_post_meta( $menu_item_db_id, '_menu_fontawesome_icon' );
	}
}
add_action( 'wp_update_nav_menu_item', 'save_menu_fontawesome_icon', 10, 2 );

function show_menu_item_icon( $title, $item ) {
	if( is_object( $item ) && isset( $item->ID ) ) {
		$menu_fontawesome_icon = get_post_meta( $item->ID, '_menu_fontawesome_icon', true );
		if ( ! empty( $menu_fontawesome_icon ) ) {
			$title .= '<i class="' . $menu_fontawesome_icon . '"></i>';
		}
	}
	return $title;
}
add_filter( 'nav_menu_item_title', 'show_menu_item_icon', 10, 2 );

// Add customizer support
function twitter_nest_customize_register( $wp_customize ) {

// Colors
	$colors = array();
	$colors[] = array(
	  'slug' => 'accent',
	  'default' => '#1DA1F2',
	  'label' => __( 'Accent' )
	);
	$colors[] = array(
	  'slug' => 'text',
	  'default' => '#14171A',
	  'label' => __('Text')
	);
	$colors[] = array(
	  'slug' => 'deep',
	  'default' => '#657786',
	  'label' => __('High-contrast deep tone')
	);
	$colors[] = array(
	  'slug' => 'mid',
	  'default' => '#AAB8C2',
	  'label' => __('Medium tone')
	);
	$colors[] = array(
	  'slug' => 'light',
	  'default' => '#E1E8ED',
	  'label' => __('Light tone'),
		'sanitize_callback' => 'sanitize_hex_color'
	);
	$colors[] = array(
	  'slug' => 'subtle',
	  'default' => '#F5F8FA',
	  'label' => __('Low-contrast subtle tone'),
		'sanitize_callback' => 'sanitize_hex_color'
	);
	$colors[] = array(
	  'slug' => 'background',
	  'default' => '#FFFFFF',
	  'label' => __('Background'),
		'sanitize_callback' => 'sanitize_hex_color'
	);
	foreach( $colors as $color ) {
	  // SETTINGS
	  $wp_customize->add_setting(
		$color['slug'], array(
		  'default' => $color['default'],
		  'type' => 'option',
		  'capability' => 'edit_theme_options'
		)
	  );
	  // CONTROLS
	  $wp_customize->add_control(
		new WP_Customize_Color_Control(
		  $wp_customize,
		  $color['slug'],
		  array('label' => $color['label'],
		  'section' => 'colors',
		  'settings' => $color['slug'])
		)
	  );
	}
	
// Image fields
	$wp_customize->add_setting('nest_avatar', array(
        //default value
    ));
    
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'nest_avatar', array(
        'label' => 'Avatar',
        'settings'  => 'nest_avatar',
        'section'   => 'user_info'
    ) ));
	
	$wp_customize->add_setting('nest_banner', array(
        //default value
    ));
    
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'nest_banner', array(
        'label' => 'Banner',
        'settings'  => 'nest_banner',
        'section'   => 'user_info'
    ) ));

// User info
	$wp_customize->add_section( 'user_info', array(
	  'title' => __( 'User information', 'twitter_nest' ),
	  'description' => __( 'Change the information displayed in the user section preceding your tweets.' ),
	  'priority' => 30,
	) );

	// Text fields
	$wp_customize->add_setting( 'twitter_username', array(
	  'default' => 'NestDiaspora',
	) );

	$wp_customize->add_setting( 'twitter_id', array(
	  'default' => '1594415258952949760',
	) );

	$wp_customize->add_setting( 'twitter_display_name', array(
	  'default' => 'Nest Diaspora',
	) );

	$wp_customize->add_setting( 'twitter_description', array(
	  'default' => 'Hello World!',
	) );

	$wp_customize->add_setting( 'user_location', array(
	  'default' => 'Los Angeles, CA',
	) );

	$wp_customize->add_setting( 'user_pronouns', array(
	  'default' => 'they / them / theirs',
	) );

	$wp_customize->add_setting( 'user_accessibility_needs', array(
	  'default' => 'Please ask for my accessibility needs.',
	) );

	$wp_customize->add_setting( 'twitter_dm_default', array(
	  'default' => 'Hello from the nest!',
	) );

	$wp_customize->add_control( 'twitter_username', array(
	  'label' => __( 'Twitter username' ),
	  'description' => __( 'Your Twitter username is your @handle without the @ symbol.' ),
	  'type' => 'text',
	  'section' => 'user_info',
	  'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'twitter_id', array(
	  'label' => __( 'Twitter ID' ),
	  'description' => __( 'The ID number for your account. You can look up your ID using <a href="https://tweeterid.com/">TweeterID</a>.' ),
	  'type' => 'text',
	  'section' => 'user_info',
	  'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'twitter_display_name', array(
	  'label' => __( 'Display name' ),
	  'description' => __( 'Set a display name.' ),
	  'type' => 'text',
	  'section' => 'user_info',
	  'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'user_location', array(
	  'label' => __( 'Location' ),
	  'description' => __( 'Set a location. This does not have to correspond to an actual place.' ),
	  'type' => 'text',
	  'section' => 'user_info',
	  'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'user_pronouns', array(
	  'label' => __( 'Pronouns' ),
	  'description' => __( 'Set your pronouns. You can put each pronoun set on a different line. HTML is allowed. You can link to <a href="https://pronouns.page/" target="_new" rel="noopener">Pronouns Page</a> with the code <code>' . esc_html('<a href="https://en.pronouns.page/PRONOUN">PRONOUN SET</a>') . '</code>. Other languages are also available.' ),
	  'type' => 'textarea',
	  'section' => 'user_info',
	  'sanitize_callback' => 'sanitize_textarea_field',
	) );

	$wp_customize->add_control( 'twitter_description', array(
	  'label' => __( 'Twitter description' ),
	  'description' => __( 'Enter a brief bio. HTML is allowed.' ),
	  'type' => 'textarea',
	  'section' => 'user_info',
	  'sanitize_callback' => 'sanitize_textarea_field',
	) );

	$wp_customize->add_control( 'twitter_dm_default', array(
	  'label' => __( 'Default DM message' ),
	  'description' => __( 'Set a default message that gets added when people DM you through your nest.' ),
	  'type' => 'text',
	  'section' => 'user_info',
	  'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'user_accessibility_needs', array(
	  'label' => __( 'Accessibility needs' ),
	  'description' => __( 'Describe accessibility needs that others may need to know about. HTML is allowed.' ),
	  'type' => 'textarea',
	  'section' => 'user_info',
	  'sanitize_callback' => 'sanitize_textarea_field',
	) );
}
add_action( 'customize_register', 'twitter_nest_customize_register' );

