<?php

/**
 * Template part: <ul class="post-meta"></p> under each post
 */

?>

<section class="post-meta">
	<p class="meta-intents">
		<span class="meta-reply"><a href="https://twitter.com/intent/tweet?in_reply_to=<?php do_action( 'ozh_ta_id' ); ?>"><i class="fa fa-reply"></i> Reply</a> </span>
		<span class="meta-retweet"><a href="https://twitter.com/intent/retweet?tweet_id=<?php do_action( 'ozh_ta_id' ); ?>"><i class="fa fa-retweet"></i> Retweet</a> </span>
		<span class="meta-like"><a href="https://twitter.com/intent/like?tweet_id=<?php do_action( 'ozh_ta_id' ); ?>"><i class="fa fa-heart"></i> Like</a></span>
	</p>
	<p class="meta-origin">	
		<span class="meta-permalink">Tweeted on <?php the_time('F j, Y \a\t g:i a') ?> </span>
	<?php if( ozh_ta_is_reply_or_not( false ) == 'is_reply' ) { ?>
		<span class="meta-conversation"><?php do_action( 'ozh_ta_in_reply_to_tweet' ) ?> </span>
    <?php } ?>
		<span class="meta-source">via <?php do_action( 'ozh_ta_source'); ?></span>
		<span class="meta-twitterlink"><a href="<?php do_action( 'ozh_ta_tweet_link' ); ?>" title="Original on Twitter"><i class="fa-brands fa-twitter"></i> Original</a> </span>
		<span class="meta-wplink"><a href="<?php the_permalink() ?>" title="Local Permalink" rel="bookmark"><i class="fa fa-bookmark"></i> Local Permalink</a></span> 
		<span class="meta-edit"><?php edit_post_link('[edit]', '', ''); ?></span></p>
</section>