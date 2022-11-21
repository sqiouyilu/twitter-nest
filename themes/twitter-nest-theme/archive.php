<?php get_header(); ?>

<?php if (have_posts()) : ?>

<!-- !BEGIN #tweets -->
<main id="content">
	
		<!-- Search form -->
		<aside id="global-search" class="view-mobile">
			<?php get_search_form(); ?>
		</aside>

<?php /* If this is a monthly archive */ if (is_month()) { ?>
<h1>Tweet Archive for <?php single_month_title( ' ' );; ?>
<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
<h1>Tweet Archive for <?php echo get_query_var('year'); ?>
<?php /* If this is a tag archive */ } elseif (is_tag()) { ?>
<h1>Tweet Archive for hashtag &#8220;#<?php single_tag_title(); ?>&#8221;
<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
<?php } 

 if( $paged > 1 ) echo " &raquo; page $paged";
?></h1>

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

<?php else :

    if (is_date()) { // If this is a date archive
      echo "<h2>No posts found for this date.</h2>";
    } else {
      echo "<h2>No posts found.</h2>";
    }

  endif;
?>

<?php get_footer(); ?>
