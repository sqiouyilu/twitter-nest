<?php get_header(); ?>

<?php if (have_posts()) : ?>

<!-- !BEGIN #tweets -->
<main id="content">

		<!-- Search form -->
		<aside id="global-search" class="view-mobile">
			<?php get_search_form(); ?>
		</aside>
		
<h1>Search results for <mark><?php the_search_query(); ?></mark> <?php if( $paged > 1 ) echo "&raquo; page $paged"; ?></h1>

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

<h2>No posts found. Try a different search.</h2>

<?php endif; ?>

<?php get_footer(); ?>
