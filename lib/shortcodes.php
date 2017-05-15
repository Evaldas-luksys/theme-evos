<?php
/*
if( !function_exists( 'evos_get_social_shares' ) ) :		
	function evos_get_social_shares(){
		$bookmarks = get_bookmarks( array(
			'orderby'        => 'name',
			'order'          => 'ASC',
		));

		if( $bookmarks ) : ?>
			 <div class="socials">
		        <ul class="icons">
		        <?php
		           foreach ( $bookmarks as $bookmark ) :
					    printf( '<li class="icons-item"><a href="%s"><span class="share-text">%s</span> <i class="fa fa-facebook"></i><i class="fa fa-plus"></i></a></li>',
				    		$bookmark->link_url,
				    		$bookmark->link_name 
					    );
					endforeach;
		      	?>
		        </ul>
		    </div>
	<?php	
		endif;
	}
endif;

add_shortcode( 'myshortcode', 'my_shortcode_handler' );
*/

function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);