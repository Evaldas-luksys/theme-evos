<?php

function evos_get_title(){
	global $post;
	$title = '';
  $title_element = '';

	if( is_singular() ) :
		$title = get_the_title();
  elseif( is_front_page() && is_home() ) :
    $title = '';
	elseif( is_home() ) :
		$title = get_the_title( get_option('page_for_posts', true) );
  elseif( is_search() ) :
    $title = 'Search results for: '. get_search_query();
	endif;

  if( !empty($title) ) :
    $title_element = '<h1 class="main-title">'.$title.'</h1>';
  endif;

	return $title_element;
}

add_filter( 'body_class', function( $classes ) {
   global $post,	$evos_display_sidebar;
   $evos_display_sidebar = true;
   $extra_classes = array();

    if( is_singular() ) :
   		$layout_option = get_post_meta($post->ID, 'evos_layout_options', true);
   		$extra_classes[] = !empty($layout_option) ? $layout_option : get_theme_mod('evos_layout_settings');
    elseif( is_home() ) :
    	$layout_option = get_post_meta( get_option( 'page_for_posts' ), 'evos_layout_options', true );
   		$extra_classes[] = !empty( $layout_option ) ? $layout_option : get_theme_mod('evos_layout_settings');
   	else :
   		$extra_classes[] = get_theme_mod('evos_layout_settings');
   endif;

   if( in_array('no-sidebar', $extra_classes) || in_array('full-width', $extra_classes) )
   		$evos_display_sidebar = false;

    if(  $evos_display_sidebar )
       $extra_classes[] = 'sidebar-active';

    if( get_theme_mod('evos_header_fixed') )
      $extra_classes[] = 'header_sticky';

    if( get_theme_mod('evos_display_top_bar') )
      $extra_classes[] = 'top-bar-active';

   $result = array_merge($classes, $extra_classes);

   return $result;
} );


function evos_display_sidebar(){
	global $evos_display_sidebar, $post;

	if( $evos_display_sidebar )
		return get_sidebar();
}