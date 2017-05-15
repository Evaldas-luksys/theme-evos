<section class="main-content">

<?php 
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		if( !is_search() ) :
			get_template_part('item', get_post_type());
		else :
			get_template_part('item', 'search');
		endif;
	endwhile;
else :
	get_template_part('template-parts/content', 'none');
endif;


the_posts_pagination( array(
	'mid_size'  => 2,
	'prev_text' => __( 'Previous', 'textdomain' ),
	'next_text' => __( 'Next', 'textdomain' ),
) );

?>
           
<!-- 
    <div class="mult-article-wrapper grid">
       
    </div> -->

   <!--  <a href="#" class="back-link"><i class="fa fa-angle-left"></i>Newer posts</a>
    <a href="#" class="next-link">Older posts<i class="fa fa-angle-right"></i></a> -->
<!--     <a href="#" class="load-more">Load more</a> -->
</section>
