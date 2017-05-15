<article <?php post_class('item'); ?>>
    <h2 class="item-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
    <a href="<?php the_permalink();?>" class="item-image-outer">
    	<?php 
	    	if ( has_post_thumbnail() ) :
				the_post_thumbnail();
			endif;
		?>
	</a>
    <div class="item-excerpt">
       <?php the_excerpt();?>
    </div>
    <a href="<?php the_permalink();?>" class="more-link button">Read more</a>
</article>