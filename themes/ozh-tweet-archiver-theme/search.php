<?php get_header(); ?>

<?php if (have_posts()) : ?>

<!-- !BEGIN #tweets -->
<main>
<h2>Search results for &laquo;<?php the_search_query(); ?>&raquo; <?php if( $paged > 1 ) echo "&laquo; page $paged"; ?></h2>

<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
    <section>
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

<h2>No posts found. Try a different search.</h2>

<?php endif; ?>

<?php get_footer(); ?>
