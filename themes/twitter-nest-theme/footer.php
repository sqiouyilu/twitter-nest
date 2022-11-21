			<!-- Sidebar -->
			<?php get_sidebar(); ?>

	</div>
</div>
	<!-- END container -->
		
				<!-- BEGIN credits -->
				<footer id="credits">

				<!-- Credits -->
				<p>Powered by <a href="http://wordpress.org/"><i class="fa-brands fa-wordpress-simple"></i> WordPress</a> and <a href="https://github.com/sqiouyilu/twitter-nest"><i class="fa-solid fa-house-signal"></i> Twitter Nest</a>.

				<!-- Query monitor -->
				<?php echo get_num_queries(); ?> queries in <?php timer_stop(true,2); ?> seconds.</p>
				</footer>
				<!-- END credits -->

			<!-- Footer -->
			<?php wp_footer(); ?>
</div>
	</body>
	<!-- END body -->

</html>
<!-- END document -->