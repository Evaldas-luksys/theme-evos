<?php 
	get_header();
	
	// Front page is Latest posts page
    if( is_home() ) :
        get_template_part('template-parts/content-archive');

    // Front page is chosen
    else :
        get_template_part('template-parts/content');
    endif;

    evos_display_sidebar();

	get_footer();
?>