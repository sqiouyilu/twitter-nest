<!-- BEGIN nest meta sidebar -->
<aside id="sidebar">

		<!-- BEGIN archives widget -->
		<aside class="widget">
		
			<!-- Title -->
			<h2><i class="fa fa-calendar"></i> Archives</h2>

			<!-- Widget body -->
			<?php /**/ ?>
				<div id='archives'>
					<?php otat_month_archives(); ?>
				</div>
			<?php /**/ ?>
		</aside>
		<!-- END archives widget -->

		<!-- BEGIN statistics widget -->
		<aside class="widget">
			
			<!-- Title -->
			<h2><i class="fa fa-dashboard"></i> Stats</h2>

			<!-- Widget body -->
			<section>
			<?php /**/ ?>

				<ul id="stats">
					<li class="stats"><span class="stats-label">Tweets</span><span class="stats-count"><?php do_action('ozh_ta_total_tweets'); ?></span></li>
					<li class="stats"><span class="stats-label">Followers</span><span class="stats-count"><?php do_action('ozh_ta_total_followers'); ?></span></li>
					<li class="stats"><span class="stats-label">Following</span><span class="stats-count"><?php do_action('ozh_ta_total_following'); ?></span></li>
					<li class="stats"><span class="stats-label">Listed</span><span class="stats-count"><?php do_action('ozh_ta_total_listed'); ?></span></li>
					<li class="stats"><span class="stats-label">Link ratio</span><span class="stats-count"><?php do_action('ozh_ta_link_ratio'); ?></span></li>
					<li class="stats"><span class="stats-label">Reply ratio</span><span class="stats-count"><?php do_action('ozh_ta_reply_ratio'); ?></span></li>
					<li class="stats"><span class="stats-label">Tweeting since</span><span class="stats-count"><?php do_action('ozh_ta_tweeting_since'); ?></span></li>
				</ul>

			<?php /**/ ?>
			</section>
		</aside>
		<!-- END stats widget -->

		<!-- BEGIN hashtags widget -->
		<aside class="widget">
			
			<!-- Title -->
			<h2><i class="fa fa-tags"></i> #hashtags</h2>
	
			<!-- Tag cloud -->
			<section>
			<?php wp_tag_cloud('format=list'); ?>
			</section>
		</aside>
		<!-- END hashtags widget -->
	
		<!-- BEGIN meta -->
		<aside class="widget">

			<!-- Title -->
			<h2><i class="fa fa-info-circle"></i> Meta</h2>

			<!-- Widget body -->
			<section>
			<ul id="meta">
				<li class="stats"><span class="stats-label">Tweets archive every</span><span class="stats-count"><?php global $ozh_ta; echo ozh_ta_seconds_to_words( $ozh_ta['refresh_interval'] ); ?></span></li>
				<li class="stats"><span class="stats-label">Next update in</span><span class="stats-count"><?php echo ozh_ta_next_update_in( true, false ); ?></span></li>
				<li><a href="/tweets/settings/">Twitter settings</a></li>
			</ul>
			</section>
		</aside>
		<!-- END meta -->
		
		<!-- BEGIN Twitter reference block -->
		<aside class="widget">	
	
		<!-- Title -->
			<h2>
			 	<i class="fa fa-info-circle"></i> Twitter Reference
			</h2>

			<!-- Links -->
			<section>
			<ul class="twitter-reference">
				<li><a href="https://cards-dev.twitter.com/validator" target="_new">Card validator</a></li>
				<li><a href="https://developer.twitter.com/en/docs/twitter-for-websites/cards/overview/markup" target="_new">Card markup reference</a></li>
				<li><a href="https://publish.twitter.com/" target="_new">Embed publisher</a></li>
				<li><a href="https://developer.twitter.com/en/docs/twitter-for-websites/embedded-tweets/overview" target="_new">Embedded tweet documentation</a></li>
				<li><a href="https://developer.twitter.com/en/docs/twitter-api/v1/data-dictionary/object-model/tweet" target="_new">Tweet data dictionary</a></li>
				<li><a href="https://developer.twitter.com/en/docs/twitter-for-websites/web-intents/overview" target="_new">Web intents documentation</a></li>
				<li><a href="https://developer.twitter.com/en/docs/twitter-for-websites/tweet-button/overview" target="_new">Tweet text components</a></li>
				<li><a href="https://twemoji.twitter.com/" target="_new">Twemoji</a></li>
			</ul>
			</section>
		</aside>			
		<!-- END Twitter reference block -->
		
		<!-- Capture no sidebar case -->
		<?php //endif; // no dynamic sidebar?>

</aside>
<!-- END nest meta sidebar -->