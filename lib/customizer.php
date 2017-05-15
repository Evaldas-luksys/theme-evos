<?php

function mytheme_customize_register( $wp_customize ) {

  // Global options
  $wp_customize->add_panel( 'evos_global_settings', array(
    'title' => 'Global Settings',
    'description' => 'Evos global settings',
    'priority' => 10,
  ) );

  // Header section
   $wp_customize->add_section('evos_header', array(
      'priority' => 1,
      'title' => __('Header', 'evos'),
      'panel' => 'evos_global_settings'
   ));

  // Top bar settings
   $wp_customize->add_setting('evos_display_top_bar', array(
      'default' => 0,
      'capability' => 'edit_theme_options',
   ));

   $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'evos_display_top_bar', array(
      'label' => __('Display topbar', 'evos'),
      'section' => 'evos_header',
      'setting' => 'evos_display_top_bar',
      'type' => 'checkbox'
   )));   

  // Header logo
   $wp_customize->add_setting('evos_logo', array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'esc_url_raw'
   ));

   $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'evos_logo', array(
      'label' => __('Upload logo for your header', 'evos'),
      'section' => 'evos_header',
      'setting' => 'evos_logo'
   )));

  // Header fixed
  $wp_customize->add_setting('evos_header_fixed', array(
      'default' => 0,
      'capability' => 'edit_theme_options',
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'evos_header_fixed', array(
      'label' => __('Header Fixed?', 'evos'),
      'section' => 'evos_header',
      'setting' => 'evos_header_fixed',
      'type' => 'checkbox'
  )));

    // Homepage panel
   $wp_customize->add_panel( 'evos_homepage_panel', array(
        'title' => 'Homepage Settings',
        'description' => 'Homepage settings',
        'priority' => 10,
    ) );

  // Homepage slider
  $wp_customize->add_section('evos_homepage', array(
      'priority' => 1,
      'title' => __('Slideshow options', 'evos'),
      'panel' => 'evos_homepage_panel'
   ));

   $wp_customize->add_setting('evos_display_homepage_slider', array(
      'default' => 0,
      'capability' => 'edit_theme_options',
   ));

   $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'evos_display_homepage_slider', array(
      'label' => __('Display homepage slider', 'evos'),
      'section' => 'evos_homepage',
      'setting' => 'evos_display_homepage_slider',
      'type'    => 'checkbox'
   )));

   // Homepage slider category
   $wp_customize->add_setting('evos_homepage_slider_category', array(
      'capability' => 'edit_theme_options',
   ));

   foreach (get_categories() as $key => $category) :
        $posts_categories[$category->term_id] = $category->cat_name;
    endforeach;

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'evos_homepage_slider_category', array(
      'label' => __('Homepage slider category', 'evos'),
      'section' => 'evos_homepage',
      'setting' => 'evos_homepage_slider_category',
      'type'    => 'select',
      'choices' => $posts_categories
  )));

  // Homepage call to action
  $wp_customize->add_section('evos_call_to_action', array(
      'priority' => 1,
      'title' => __('Call to Action', 'evos'),
      'panel' => 'evos_homepage_panel'
   ));

  $wp_customize->add_setting('evos_call_to_action', array(
      'default' => 0,
      'capability' => 'edit_theme_options',
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'evos_call_to_action', array(
      'label' => __('Display Call to action section?', 'evos'),
      'section' => 'evos_call_to_action',
      'setting' => 'evos_call_to_action',
      'type' => 'checkbox'
  )));

  // Call to action text
  $wp_customize->add_setting('evos_call_to_action_text', array(
      'default' => '',
      'capability' => 'edit_theme_options',
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'evos_call_to_action_text', array(
      'label' => __('Call to action text', 'evos'),
      'section' => 'evos_call_to_action',
      'setting' => 'evos_call_to_action_text',
      'type' => 'textarea'
  )));

  // Call to action button text
  $wp_customize->add_setting('evos_call_to_action_button_text', array(
      'default' => '',
      'capability' => 'edit_theme_options',
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'evos_call_to_action_button_text', array(
      'label' => __('Call to action text', 'evos'),
      'section' => 'evos_call_to_action',
      'setting' => 'evos_call_to_action_button_text',
      'type' => 'textarea'
  )));

  // Call to action button link
  $wp_customize->add_setting('evos_call_to_action_button_link', array(
      'default' => '#',
      'capability' => 'edit_theme_options',
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'evos_call_to_action_button_link', array(
      'label' => __('Call to action button link', 'evos'),
      'section' => 'evos_call_to_action',
      'setting' => 'evos_call_to_action_button_link',
      'type' => 'text'
  )));

  // Featured block
  $wp_customize->add_section('evos_featured_block', array(
      'priority' => 1,
      'title' => __('Featured block', 'evos'),
      'panel' => 'evos_homepage_panel'
  ));

  $wp_customize->add_setting('evos_display_featured_area', array(
      'default' => 0,
      'capability' => 'edit_theme_options',
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'evos_display_featured_area', array(
      'label' => __('Display featured area?', 'evos'),
      'section' => 'evos_featured_block',
      'setting' => 'evos_display_featured_area',
      'type' => 'checkbox'
  )));

  // Featured block title
  $wp_customize->add_setting('evos_featured_block_title', array(
      'default' => '',
      'capability' => 'edit_theme_options',
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'evos_featured_block_title', array(
      'label' => __('Featured block title', 'evos'),
      'section' => 'evos_featured_block',
      'setting' => 'evos_featured_block_title',
      'type' => 'text'
  )));

  // Featured block subtitle
  $wp_customize->add_setting('evos_featured_block_subtitle', array(
      'default' => '',
      'capability' => 'edit_theme_options',
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'evos_featured_block_subtitle', array(
      'label' => __('Featured block sub title', 'evos'),
      'section' => 'evos_featured_block',
      'setting' => 'evos_featured_block_subtitle',
      'type' => 'textarea'
  )));

  // FEATURED BLOCK 1
  // Image
  $wp_customize->add_setting('evos_featured_block_image_1', array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'esc_url_raw'
  ));

  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'evos_featured_block_image_1', array(
      'label' => __('Featured area 1 logo', 'evos'),
      'section' => 'evos_featured_block',
      'setting' => 'evos_featured_block_image_1'
  )));

  // Title
  $wp_customize->add_setting('evos_featured_block_title_1', array(
      'default' => '',
      'capability' => 'edit_theme_options',
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'evos_featured_block_title_1', array(
      'label' => __('Featured block title 1', 'evos'),
      'section' => 'evos_featured_block',
      'setting' => 'evos_featured_block_title_1',
      'type' => 'text'
  )));

  // Subtitle
  $wp_customize->add_setting('evos_featured_block_subtitle_1', array(
      'default' => '',
      'capability' => 'edit_theme_options',
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'evos_featured_block_subtitle_1', array(
      'label' => __('Featured block subtitle 1', 'evos'),
      'section' => 'evos_featured_block',
      'setting' => 'evos_featured_block_subtitle_1',
      'type' => 'text'
  )));

  // FEATURED BLOCK 2
  // Image
  $wp_customize->add_setting('evos_featured_block_image_2', array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'esc_url_raw'
  ));

  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'evos_featured_block_image_2', array(
      'label' => __('Featured area 2 logo', 'evos'),
      'section' => 'evos_featured_block',
      'setting' => 'evos_featured_block_image_2'
  )));

  // Title
  $wp_customize->add_setting('evos_featured_block_title_2', array(
      'default' => '',
      'capability' => 'edit_theme_options',
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'evos_featured_block_title_2', array(
      'label' => __('Featured block title 2', 'evos'),
      'section' => 'evos_featured_block',
      'setting' => 'evos_featured_block_title_2',
      'type' => 'text'
  )));

  // Subtitle
  $wp_customize->add_setting('evos_featured_block_subtitle_2', array(
      'default' => '',
      'capability' => 'edit_theme_options',
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'evos_featured_block_subtitle_2', array(
      'label' => __('Featured block subtitle 2', 'evos'),
      'section' => 'evos_featured_block',
      'setting' => 'evos_featured_block_subtitle_2',
      'type' => 'text'
  )));

  // FEATURED BLOCK 3
  // Image
  $wp_customize->add_setting('evos_featured_block_image_3', array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'esc_url_raw'
  ));

  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'evos_featured_block_image_3', array(
      'label' => __('Featured area 3 logo', 'evos'),
      'section' => 'evos_featured_block',
      'setting' => 'evos_featured_block_image_3'
  )));

  // Title
  $wp_customize->add_setting('evos_featured_block_title_3', array(
      'default' => '',
      'capability' => 'edit_theme_options',
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'evos_featured_block_title_3', array(
      'label' => __('Featured block title 3', 'evos'),
      'section' => 'evos_featured_block',
      'setting' => 'evos_featured_block_title_3',
      'type' => 'text'
  )));

  // Subtitle
  $wp_customize->add_setting('evos_featured_block_subtitle_3', array(
      'default' => '',
      'capability' => 'edit_theme_options',
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'evos_featured_block_subtitle_3', array(
      'label' => __('Featured block subtitle 3', 'evos'),
      'section' => 'evos_featured_block',
      'setting' => 'evos_featured_block_subtitle_3',
      'type' => 'text'
  )));

  // Articles
  $wp_customize->add_section('evos_featured_posts', array(
      'priority' => 1,
      'title' => __('Featured Posts', 'evos'),
      'panel' => 'evos_homepage_panel'
  ));

  $posts_array = array('' => 'Select post');
  $args = array( 'post_type' => 'post', 'posts_per_page' => -1 );
  $posts = new WP_Query( $args );

  // Get posts
  if ( $posts->have_posts() ) :
    while ( $posts->have_posts() ) :
      $posts->the_post();
      $posts_array[get_the_ID()] = get_the_title(); 
    endwhile;
    wp_reset_postdata();
  endif;

  $wp_customize->add_setting('evos_homepage_feautred_posts_1', array(
    'capability' => 'edit_theme_options',
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'evos_homepage_feautred_posts_1', array(
      'label' => __('Homepage post 1', 'evos'),
      'section' => 'evos_featured_posts',
      'setting' => 'evos_homepage_feautred_posts_1',
      'type'    => 'select',
      'choices' => $posts_array
  )));

  $wp_customize->add_setting('evos_homepage_feautred_posts_2', array(
    'capability' => 'edit_theme_options',
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'evos_homepage_feautred_posts_2', array(
      'label' => __('Homepage post 2', 'evos'),
      'section' => 'evos_featured_posts',
      'setting' => 'evos_homepage_feautred_posts_2',
      'type'    => 'select',
      'choices' => $posts_array
  )));

  $wp_customize->add_setting('evos_homepage_feautred_posts_3', array(
    'capability' => 'edit_theme_options',
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'evos_homepage_feautred_posts_3', array(
      'label' => __('Homepage post 3', 'evos'),
      'section' => 'evos_featured_posts',
      'setting' => 'evos_homepage_feautred_posts_3',
      'type'    => 'select',
      'choices' => $posts_array
  )));


  // Layout options
  $wp_customize->add_section('evos_layout', array(
      'priority' => 1,
      'title' => __('Layout options', 'evos'),
      'panel' => 'evos_global_settings'
  ));

  $wp_customize->add_setting('evos_layout_settings', array(
      'default' => 0,
      'capability' => 'edit_theme_options',
  ));

  global $evos_extra_options;

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'evos_layout_settings', array(
      'label' => __('Display homepage slider', 'evos'),
      'section' => 'evos_layout',
      'setting' => 'evos_layout_settings',
      'type'    => 'select',
      'choices' => $evos_extra_options['evos_layout_options']
  )));

  $wp_customize->add_section('evos_banner', array(
      'priority' => 1,
      'title' => __('Banner settings', 'evos'),
      'panel' => 'evos_global_settings'
  ));

  $wp_customize->add_setting('evos_display_banner_global', array(
      'default' => 0,
      'capability' => 'edit_theme_options',
  ));

  global $evos_extra_options;

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'evos_display_banner_global', array(
      'label' => __('Display top banner', 'evos'),
      'section' => 'evos_banner',
      'setting' => 'evos_display_banner_global',
      'type'    => 'checkbox',
  )));


}
add_action( 'customize_register', 'mytheme_customize_register' );