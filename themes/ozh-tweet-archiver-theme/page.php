<?php get_header(); ?>

<!-- !BEGIN #tweet -->
<main>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<article class="post" id="post-<?php the_ID(); ?>">
  <h2><?php the_title(); ?></h2>
  <section class="entry">
    <?php the_content(); ?>
  </section>
</article>
<?php endwhile; endif; ?>
<?php edit_post_link('[edit]', '<p>', '</p>'); ?>

</div>
<!-- END #tweet -->
  
  
<?php get_footer(); ?>
