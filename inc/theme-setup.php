<?php

function loops_theme_setup () {
  add_theme_support( 'title-tag' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'widgets' );
  add_theme_support( 'custom-logo', array(
    'width'   => 190,
    'height'  => 80
  ) );
  add_theme_support( "html5", array(
    'search-form'
  ) );
  add_theme_support( 'post-formats', array('image', 'gallery', 'quote', 'audio', 'video') );
  add_post_type_support( 'page', array( 'excerpt', 'page-attributes' ) );

  load_textdomain( "loops", get_template_directory_uri() . '/languages' );

  register_nav_menus( array(
    "main"    => __( "Primaire", "loops" ),
    "footer"  => __( "Pied de page", "loops" ),
  ) );
}

add_action( 'after_setup_theme', 'loops_theme_setup' );