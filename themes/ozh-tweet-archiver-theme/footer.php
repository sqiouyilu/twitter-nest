</div>
<!-- END #content -->

<?php get_sidebar(); ?>


<span class="reset">&nbsp;</span>

<footer id="credits">
  <p>Powered by
  <a href="http://wordpress.org/"><i class="fa fa-wordpress"></i> WordPress</a>
  and <a href="https://github.com/sqiouyilu/twitter-nest"><i class="fa fa-house-signal"></i> Twitter Nest</a>.
  <?php echo get_num_queries(); ?> queries in <?php timer_stop(true,2); ?> seconds.</p>
</footer>
<?php wp_footer(); ?>

</div>
<!-- END #container -->

</body>
</html>
