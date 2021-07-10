<?php

function green_climate_register_widget() {
  register_sidebar(
    array(
      'name'          => __('Footer', 'loops'),
      'id'            => 'footer-menu',
      'before_widget' => '<div id="%1$s" class="footer-nav-menu">',
      'after_widget'  => '</div>',
      'before_title'  => '<h2 class="d-none">',
      'after_title'   => '</h2>'
    )
  );
}

add_action( 'widgets_init', 'green_climate_register_widget' );