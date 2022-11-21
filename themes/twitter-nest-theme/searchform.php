<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" name="s" id="s" value="<?php the_search_query(); ?>" placeholder="Search Tweets" class="txt" />
	<button type="submit" id="searchsubmit" class="btn btn-success">
		<i class="fa-solid fa-magnifying-glass"></i><span class="submit-label"> Search</span>
	</button>
</form>