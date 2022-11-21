<!-- Declare document type -->
<!doctype HTML>

<!-- Declare XHTML and language -->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<!-- =================================================================== -->
<!-- HEAD -->
<!-- =================================================================== -->
<head>

<!-- ------------------------------------------------------------------- -->
<!-- Meta -->
<!-- ------------------------------------------------------------------- -->
		
<!-- Set charset -->
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  
<!-- Set viewport for responsive theme -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- ------------------------------------------------------------------- -->
<!-- Site identity -->
<!-- ------------------------------------------------------------------- -->

<!-- Site title -->
<title><?php wp_title('|', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<!-- ------------------------------------------------------------------- -->
<!-- Stylesheets -->
<!-- ------------------------------------------------------------------- -->

<!-- Theme stylesheet -->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" type="text/css" media="screen" />
	
<?php
	$accent = get_option('accent');
	$text = get_option('text');
	$deep = get_option('deep');
	$mid = get_option('mid');
	$light = get_option('light');
	$subtle = get_option('subtle');
	$background = get_option('background');
	
	$nest_banner = get_template_directory_uri() . '/img/banner.jpg';
	$nest_avatar = get_template_directory_uri() . '/img/avatar.jpg';
?>
<style>
:root {
	/* Customizer color palette */
	--accent: <?php echo $accent; ?>;
	--text: <?php echo $text; ?>;
	--deep: <?php echo $deep; ?>;
	--mid: <?php echo $mid; ?>;
	--light: <?php echo $light; ?>;
	--subtle: <?php echo $subtle; ?>;
	--background: <?php echo $background; ?>;
	
	/* Customizer image settings */
	<?php	
		if (get_theme_mod('nest_banner') !='') {
			$nest_banner = get_theme_mod('nest_banner');
			echo '--banner: url(\'' . $nest_banner . '\');';
		}
	
		if (get_theme_mod('nest_avatar') !='') {
			$nest_avatar = get_theme_mod('nest_avatar');
			echo '--avatar: url(\'' . $nest_avatar .'\');';
		}
	?>
	
}

</style>

<!-- ------------------------------------------------------------------- -->
<!-- Head functions -->
<!-- ------------------------------------------------------------------- -->

<?php wp_head(); ?>
</head>

<!-- =================================================================== -->
<!-- USER PROFILE -->
<!-- =================================================================== -->

<body <?php body_class(); ?>>

<!-- Container for all elements except background -->
<div id="box-container">
		
<!-- Banner with link back to root -->
<header id="banner">
	<a href="<?php bloginfo('url'); ?>" title="Return to front page"></a>
</header>

<!-- ------------------------------------------------------------------- -->
<!-- Statistics top bar -->
<!-- ------------------------------------------------------------------- -->

<!-- Container for entire bar -->
<header id="stats-wrap">
	
	<!-- Individual elements -->
	<ul id="stats-header">

		<!-- Avatar -->
		<li id="avatar"><a href="<?php bloginfo('url'); ?>" title="@<?php echo get_theme_mod( 'twitter_username' ); ?>">@<?php echo get_theme_mod( 'twitter_username' ); ?></a></li>
		
		<!-- Total tweets -->
		<li><span class="metric">tweets</span><span class="statistic"><?php do_action('ozh_ta_total_tweets'); ?></span></li>

		<!-- Total following -->
		<li><span class="metric">following</span><span class="statistic"><?php do_action('ozh_ta_total_following'); ?> <a href="https://twitter.com/<?php echo get_theme_mod( 'twitter_username' ); ?>/following"><i class="fa fa-caret-right"></i></a></span></li>
		
		<!-- Total followers -->
		<li><span class="metric">followers</span><span class="statistic"><?php do_action('ozh_ta_total_followers'); ?> <a href="https://twitter.com/<?php echo get_theme_mod( 'twitter_username' ); ?>/followers"><i class="fa fa-caret-right"></i></a></span></li>
		
		<!-- Total listed -->
		<li><span class="metric">listed</span><span class="statistic"><?php do_action('ozh_ta_total_listed'); ?> <a href="https://twitter.com/<?php echo get_theme_mod( 'twitter_username' ); ?>/memberships"><i class="fa fa-caret-right"></i></a></span></li>
		
		<!-- Search form on desktop view -->
		<li class="view-desktop">
			<aside id="global-search" class="view-desktop">
				<?php get_search_form(); ?>
			</aside>
		</li>

	</ul>
</header>

<!-- ------------------------------------------------------------------- -->
<!-- Body elements under banners -->
<!-- ------------------------------------------------------------------- -->

<!-- Container for body of page -->
<div id="body-container">

<!-- ------------------------------------------------------------------- -->
<!-- User info -->
<!-- ------------------------------------------------------------------- -->

<aside id="user">

	<!-- Container for text fields -->
	<section id="user-summary">
		
		<!-- Display name -->
		<h2 id="user-displayname"><?php echo get_theme_mod( 'twitter_display_name' ); ?></h2>
		
		<!-- Location and pronouns container -->
		<section id="user-quickref">

			<!-- Location -->
			<?php 
		
			if ('user_location') {
				echo '<p id="user-location"><i class="fa-solid fa-location-dot"></i><span class="user-location">' . get_theme_mod( 'user_location' ) . '</span></p>';
			}
		
			?>
		
			<!-- Pronouns -->
			<?php 
		
				// Load a customizer setting into a variable
				$pronouns = get_theme_mod('user_pronouns');

				// Is there any text in our textarea?
				if( !empty($pronouns) ) {

					// Once we verify the variable isn't empty, run nl2br
					$pronouns = nl2br($pronouns);

					// This echos the altered text to the page
					echo '<p id="user-pronouns"><i class="fa-solid fa-signature"></i><span class="user-pronouns">' . $pronouns . '</span></p>';
					
				}
			?>
		</section>
		
		<!-- Bio -->
		<section id="user-bio">
			<p><?php echo get_theme_mod( 'twitter_description' ); ?></p>
		</section>
		
		<!-- Accessibility needs -->
		<section id="user-accessibility-container">
			<?php 
		
				// Load a customizer setting into a variable
				$accessibility = get_theme_mod('user_accessibility_needs');

				// Is there any text in our textarea?
				if( !empty($accessibility) ) {

					// Once we verify the variable isn't empty, run nl2br
					$accessibility = nl2br($accessibility);

					// This echos the altered text to the page
					echo '<h3 id="user-accessibility-label"><i class="fa-brands fa-accessible-icon"></i> Accessibility needs</h3><p id="user-accessibility">' . $accessibility . '</p>';
					
				}
			?>
		</section>
	</section>
	
	<!-- Contact information -->
	<section id="user-contact-information">
	
		<!-- Header -->
		<h3 class="links-out-header">Elsewhere</h3>
	
		<!-- Menu -->
		<?php if ( has_nav_menu( 'links-out' ) ) {

			wp_nav_menu(
				array(
					'theme_location'  => 'links-out',
					'container'       => 'nav',
					'container_id'    => 'links-out',
					'container_class' => FALSE,
					'menu_id'         => 'user-contact',
					'menu_class'      => FALSE,
					'depth'           => 1,
					'fallback_cb'     => 'nest_default_links'
				)
			);
		} ?>

		<!-- Contact on Twitter -->
		<ul id="contact-on-twitter">

			<!-- DM on Twitter with optional default message -->
			<li class="twitter-dm"><a href="https://twitter.com/messages/compose?recipient_id=<?php echo get_theme_mod( 'twitter_id' ); ?>&text=<?php echo urlencode(get_theme_mod( 'twitter_dm_default' )); ?>" class="twitter-dm-button" data-screen-name="@<?php echo get_theme_mod( 'twitter_username' ); ?>">DM @<?php echo get_theme_mod( 'twitter_username' ); ?></a></li>
		
			<!-- Follow on Twitter -->
			<li class="twitter-follow"><a class="twitter-follow-button" href="https://twitter.com/<?php echo get_theme_mod( 'twitter_username' ); ?>">Follow @<?php echo get_theme_mod( 'twitter_username' ); ?></a></li>

		</ul>
	</section>
</aside>

<!-- =================================================================== -->
<!-- TWEETS/MAIN PAGE -->
<!-- =================================================================== -->

<!-- Container for page content and sidebar -->
<div id="content-container">

<!-- Stream toggle -->
<?php
// If you set up static pages for posts and front page, display links. See the comment in file stream_toggle.php
	if( get_option( 'page_for_posts' ) )
	get_template_part( 'stream_toggle' );
?>