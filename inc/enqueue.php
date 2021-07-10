<?php

function loops_enqueue () {
  wp_enqueue_style( 'fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap', array(), false );
  wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick.css', array(), false );
  wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.css', array(), false );
  wp_enqueue_style( 'bootstrap-reboot', get_template_directory_uri() . '/assets/css/bootstrap-reboot.min.css', array(), '4.1.3' );
  wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.1.3' );
  wp_enqueue_style('style', get_stylesheet_uri(), array(), false);
  wp_enqueue_script( 'bootstrap', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '4.1.3', true );
  wp_enqueue_script( 'slick', get_stylesheet_directory_uri() . '/assets/js/slick.min.js', array('jquery'), false, true );
  wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/assets/js/script.js', array('jquery'), '4.1.3', true );
}

add_action( 'wp_enqueue_scripts', 'loops_enqueue' );