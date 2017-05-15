<?php
global $evos_extra_options;
$evos_extra_options['main_title'] = true;
$evos_extra_options['evos_layout_options'] = array( 'no-sidebar' => 'No Sidebar', 'sidebar-left' => 'Left Sidebar', 'sidebar-right' => 'Right Sidebar', 'full-width' => 'Full Width' );

if ( ! function_exists( 'evos_setup' ) ) :

function evos_setup() {
	// Evos textdomain
	load_theme_textdomain( 'twentysixteen', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_filter( 'pre_option_link_manager_enabled', '__return_true' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'twentysixteen' ),
		'footer_bottom_menu' => __( 'Footer Bottom Menu', 'twentysixteen' ),
		'social'  => __( 'Social Links Menu', 'twentysixteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add image sizes
	add_image_size( 'size-large', 1920, 800, true );
}
endif; // twentysixteen_setup
add_action( 'after_setup_theme', 'evos_setup' );


class Walker_Quickstart_Menu extends Walker_Nav_Menu {

	/**
	 * What the class handles.
	 *
	 * @see Walker::$tree_type
	 * @since 3.0.0
	 * @var string
	 */
	public $tree_type = array( 'post_type', 'taxonomy', 'custom' );

	/**
	 * Database fields to use.
	 *
	 * @see Walker::$db_fields
	 * @since 3.0.0
	 * @todo Decouple this.
	 * @var array
	 */
	public $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker::start_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		if( $depth === 0 ) :
			$output .= "\n$indent<ul class=\"sub-menu level-0\">\n";
			return;
		endif;
			

		$output .= "\n$indent<ul class=\"sub-menu\">\n";
	}

 	/**
	 * Ends the element output, if needed.
	 *
	 * @see Walker::end_el()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Page data object. Not used.
	 * @param int    $depth  Depth of page. Not Used.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		if( $depth === 0 ) :
			$output .= "</li><li class='sep'>/</li>\n";
			return;
		endif;

		$output .= "</li>\n";
	}
}