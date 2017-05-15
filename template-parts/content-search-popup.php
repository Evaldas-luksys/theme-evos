<form class="search-form-overlay" id="search-form-overlay" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<a href="#" class="close-search"></a>
	<div class="form-inner">
		<div class="search-text">Type and Press “enter” to Search</div>
		<input type="text" class="input-field" name="s" value="<?php echo get_search_query(); ?>" placeholder="Search here">
<!-- 		<button type="submit" class="submit-button"></button> -->
	</div>
</form>