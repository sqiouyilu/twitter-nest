<?php get_header(); ?>

<?php if (have_posts()) : ?>

<!-- !BEGIN #tweets -->
<main id="content">
	
		<!-- Search form -->
		<aside id="global-search" class="view-mobile">
			<?php get_search_form(); ?>
		</aside>

<h1>Recent tweets
    <?php if( get_option( 'page_for_posts' ) ) echo "and replies"; ?>
    <?php if( $paged > 1 ) echo "&laquo; page $paged"; ?>
    </h1>

<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
    <section class="tweet">
        <?php the_content(); ?>
    </section>
    <footer>
	    <?php get_template_part( 'post_meta' ); ?>
	</footer>
  </article>

<?php endwhile; ?>

    <nav class="pagination">
        <div class="older"><?php next_posts_link('&laquo; Older tweets') ?></div>
        <div class="newer"><?php previous_posts_link('Newer tweets &raquo;') ?></div>
    </nav>

</main>
<!-- END #tweets -->

<?php else : ?>

<h2>No posts found</h2>
<?php get_search_form(); ?>

<?php endif; ?>

<?php get_footer(); ?>