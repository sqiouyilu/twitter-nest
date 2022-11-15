<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php wp_title('|', true, 'right'); ?> <?php bloginfo('name'); ?></title>
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/font-awesome.min.css" type="text/css" media="screen" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header>
	<a href="<?php bloginfo('url'); ?>" title="Back home"></a>
</header>

<header id="stats-wrap">
    <ul id="stats-header">
        <li id="tiny-name">DISPLAY NAME <a href="https://twitter.com/USERNAME">@USERNAME</a></li>
        <li><span class="metric">tweets</span><span class="statistic"><?php do_action('ozh_ta_total_tweets'); ?></span></li>
        <li><span class="metric">following</span><span class="statistic"><?php do_action('ozh_ta_total_following'); ?> <a href="https://twitter.com/USERNAME/following"><i class="fa fa-caret-right"></i></a></span></li>
        <li><span class="metric">followers</span><span class="statistic"><?php do_action('ozh_ta_total_followers'); ?> <a href="https://twitter.com/USERNAME/followers"><i class="fa fa-caret-right"></i></a></span></li>
        <li><span class="metric">listed</span><span class="statistic"><?php do_action('ozh_ta_total_listed'); ?> <a href="https://twitter.com/USERNAME/memberships"><i class="fa fa-caret-right"></i></a></span></li>
    </ul>
</header>

<!-- !BEGIN #container -->
<div id="container">

<!-- !BEGIN #content -->
<div id="content">

<!-- !BEGIN #user -->
<aside id="user">
    <figure id="user-pic">
        <a href="SET TO WORDPRESS URL OR TWITTER PROFILE" class="avatar"></a>
    </figure>
    <section id="user-info">
        <ul>
            <li class="user-displayname">DISPLAY NAME</li>
            <li class="username"><i class="fa fa-twitter"></i>@<a href="https://twitter.com/USERNAME">USERNAME</a></li>
            <li class="user-loc"><i class="fa fa-map-marker"></i>LOCATION</li>

<!-- Font Awesome icon reference for customizing URL badges: https://fontawesome.com/icons -->
            <li class="user-url"><i class="fa fa-link"></i><a href="http://YOURWEBSITE.COM/">WEBSITE</a></li>
            
			<li class="user-bio"><p>YOUR BIO HERE</p></li>
			
<!-- Use tweeterid.com to look up your user ID for DM button -->
			
			<li class="user-dm-follow"><p><a href="https://twitter.com/messages/compose?recipient_id=YOUR_USER_ID&text=DEFAULT_MESSAGE" class="twitter-dm-button" data-screen-name="@username">DM @USERNAME</a></p>
				<p><a class="twitter-follow-button" href="https://twitter.com/USERNAME" data-show-count="false" data-show-screen-name="false">Follow @USERNAME</a></p></li>
        </ul>
    </section>
</aside>
<!-- END #user -->
	
<!-- !BEGIN Twitter tools -->
<aside id="twitter-tools">
	<nav class="twitter-tools">
		<h2>
		  <i class="fa fa-info-circle"></i> Twitter Reference
		</h2>

		<ul>
			<li><a href="https://cards-dev.twitter.com/validator" target="_new">Card validator</a></li>
			<li><a href="https://developer.twitter.com/en/docs/twitter-for-websites/cards/overview/markup" target="_new">Card markup reference</a></li>
			<li><a href="https://publish.twitter.com/" target="_new">Embed publisher</a></li>
			<li><a href="https://developer.twitter.com/en/docs/twitter-for-websites/embedded-tweets/overview" target="_new">Embedded tweet documentation</a></li>
			<li><a href="https://developer.twitter.com/en/docs/twitter-api/v1/data-dictionary/object-model/tweet" target="_new">Tweet data dictionary</a></li>
			<li><a href="https://developer.twitter.com/en/docs/twitter-for-websites/web-intents/overview" target="_new">Web intents documentation</a></li>
			<li><a href="https://developer.twitter.com/en/docs/twitter-for-websites/tweet-button/overview" target="_new">Tweet text components</a></li>
			<li><a href="https://twemoji.twitter.com/" target="_new">Twemoji</a></li>
		</ul>

	</nav>
</aside>
	
<?php
// If you set up static pages for posts and front page, display links. See the comment in file stream_toggle.php
if( get_option( 'page_for_posts' ) )
    get_template_part( 'stream_toggle' );
?>
