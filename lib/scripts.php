<?php

function evos_scripts() {
  wp_enqueue_style( 'layout', get_template_directory_uri() . '/assets/css/layout.css', array(), '1.0', 'all');
  wp_enqueue_script( 'script', get_template_directory_uri() . '/assets/js/scripts.js', array ( 'jquery' ), 1.1, true);
}
add_action( 'wp_enqueue_scripts', 'evos_scripts' );