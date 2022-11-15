<?php

/**
 * Template part: the <p class="meta">..</p> under each post
 */

?>
<p class="meta">
    <?php if( is_single() ) { ?>
        From <?php do_action( 'ozh_ta_source'); ?>
    <?php } ?>
    <?php do_action( 'ozh_ta_in_reply_to_tweet' ) ?>
    <?php if( ozh_ta_is_reply_or_not( false ) == 'is_reply' ) { ?>
        &mdash;
    <?php } ?>
    <?php the_time('g:ia M j Y') ?>
    
    <br />
    
    <a href="<?php do_action( 'ozh_ta_tweet_link' ); ?>" title="Original on Twitter"><i class="fa fa-twitter"></i> Original</a>
    <a href="<?php the_permalink() ?>" title="Permalink" rel="bookmark"><i class="fa fa-bookmark"></i> Local Permalink</a>
    &mdash; <a href="https://twitter.com/intent/tweet?in_reply_to=<?php do_action( 'ozh_ta_id' ); ?>"><i class="fa fa-reply"></i> Reply</a>
    <a href="https://twitter.com/intent/retweet?tweet_id=<?php do_action( 'ozh_ta_id' ); ?>"><i class="fa fa-retweet"></i> Retweet</a>
    <a href="https://twitter.com/intent/like?tweet_id=<?php do_action( 'ozh_ta_id' ); ?>"><i class="fa fa-heart"></i> Like</a>
    <?php edit_post_link('[edit]', '', ''); ?>
</p>
