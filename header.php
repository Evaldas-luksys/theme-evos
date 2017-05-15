<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>
			<?php bloginfo('name'); // show the blog name, from settings ?> | 
			<?php is_front_page() ? bloginfo('description') : wp_title(''); // if we're on the home page, show the description, from the site's settings - otherwise, show the title of the post or page ?>
		</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <?php wp_head();?>
    </head>
    <body <?php body_class(); ?>>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <?php
            global $evos_extra_options;
        ?>
        <header class="mastheader" id="mastheader">
            <?php if( get_theme_mod('evos_display_top_bar') )  : ?>
                <div class="top-section">
                    <div class="top-section-inner c">
                        <div class="frow justify-between">
                            <?php if( is_active_sidebar( 'topbar-left-widget-area' ) ) : ?>
                                <div class="top-section-item"> <?php dynamic_sidebar( 'topbar-left-widget-area' );?></div>   
                            <?php endif;?>
                            <?php if( is_active_sidebar( 'topbar-right-widget-area' ) ) : ?>
                                <div class="top-section-item"> <?php dynamic_sidebar( 'topbar-right-widget-area' );?></div>   
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            <?php endif;?>


            <div class="masthead-inner">
                <div class="main-header-area c">
                    <div class="frow justify-between">

                        <h1 class="logo-wrapper frow direction-column">
                            <?php if( !empty(get_theme_mod('evos_logo')) ) : ?>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-link">
                                    <img src="<?php echo esc_url(get_theme_mod('evos_logo'));?>">
                                </a>
                            <?php endif;?>
                        </h1>
                        
                        <div class="header-inner">
                            <div class="frow">
                                
                                <a class="hamburger-menu" id="mobile-menu">
                                    <div class="bar"></div>   
                                </a>


                                <?php wp_nav_menu( array( 
                                    'theme_location'    => 'primary',
                                    'menu_id'           => 'main-menu',
                                    'walker'            => new Walker_Quickstart_Menu() 
                                 ) ); ?>

                                <a href="#" class="search-button"></a>
                               
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </header>

        <main class="main">
            <?php if( 
                    get_theme_mod('evos_display_homepage_slider')
                    && get_theme_mod('evos_homepage_slider_category')
                    && is_front_page()
                ) : ?>
                <div class="slider">
                    <?php
                        $args = array(
                            'category'          => get_theme_mod('evos_homepage_slider_category'),
                            'posts_per_page'    => -1
                        );
                        $slides = get_posts( $args );

                        foreach ( $slides as $post ) : setup_postdata( $post ); ?>
                            <a class="slide" href="<?php the_permalink();?>">
                                <?php if( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail();?>
                                <?php endif;?>
                                <div class="slider-content" slide-image>
                                    <div class="slider-content-header">
                                        <?php the_title();?>
                                    </div>
                                    <div class="slider-content-body">
                                       <?php the_excerpt();?>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; 
                        wp_reset_postdata();?>
                </div>
            <?php endif;?>

            <?php if( get_theme_mod('evos_call_to_action') ) : ?>
                <div class="call-to-action">
                    <div class="c outer">
                        <div class="frow justify-between">
                            <?php if( get_theme_mod('evos_call_to_action_text') ) : ?>
                                <div class="call-to-action-text"><?php echo get_theme_mod('evos_call_to_action_text');?></div>
                            <?php endif;?>
                            <?php if( get_theme_mod('evos_call_to_action_button_text') ) : ?>
                                <div class="call-to-action-helper">
                                    <a href="<?php echo get_theme_mod('evos_call_to_action_button_link');?>" class="call-to-action-button hvr-buzz-out"><?php echo get_theme_mod('evos_call_to_action_button_text');?></a>
                                </div>
                            <?php endif;?>
                        </div> 
                    </div>
                </div>
            <?php endif;?>

            <?php
              $display_top_banner = false;
              if( is_singular() ) :
                $banner_options = get_post_meta($post->ID, 'evos_display_top_banner', true);
              elseif( is_home() ) :
                $banner_options = get_post_meta(get_option( 'page_for_posts' ), 'evos_display_top_banner', true);
              endif;

              if( $banner_options === 'on' || (empty($banner_options) && get_theme_mod('evos_display_banner_global')) )
                $display_top_banner = true;

              if( $display_top_banner && has_post_thumbnail() ) :
                get_template_part('template-parts/content', 'banner');
              endif;
            ?>

            <div class="c gutter">
                <div class="inner-wrapper">
                    <?php if( $evos_extra_options['main_title'] ) : ?>
                        <?php echo evos_get_title();?>
                    <?php endif;?>