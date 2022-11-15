<?php get_header(); ?>

<?php if (have_posts()) : ?>

<!-- !BEGIN #tweet -->
<main>
<?php while (have_posts()) : the_post(); ?>

  <h2>Tweet #<?php do_action( 'ozh_ta_id' ); ?></h2>
  <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
    <section>
      <?php the_content(); ?>
    </section>
    <footer>
	    <?php get_template_part( 'post_meta' ); ?>
  	<footer>
  </article>

<?php endwhile; ?>

    <nav class="pagination">
      <div class="older"><?php previous_post_link('%link', '&laquo; Previous tweet') ?></div>
      <div class="newer"><?php next_post_link('%link', 'Next tweet &raquo;') ?></div>
    </nav>

</main>
<!-- END #tweet -->




<?php else: ?>

<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>

<?php get_footer(); ?>
