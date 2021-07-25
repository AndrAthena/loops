<?php

function loops_portfolio_shortcode() {
  global $post;

  $args = array(
    'post_type'       => 'collaborateur',
    'post_status'     => 'publish',
    'posts_per_page'  => -1,
    'meta_key'        => 'enseigne',
    'meta_value'      => get_post_type( $post->ID ) == 'enseigne' ? $post->ID : ''
  );
  $query = new WP_Query( $args );
  
  $output = '<section id="portfolio">';
  $output .= '<div class="row">';

  if( $query->have_posts() ) {
    while( $query->have_posts() ) {
      $query->the_post();
      
      $output .= '<div class="col-md-6 col-lg-3 px-0">';
      $output .= '<div class="card-portfolio">';
      $output .= '<img src="' . get_the_post_thumbnail_url() . '" alt="' . get_the_title() . '">';
      $output .= '<div class="portfolio-overlay">';
      $output .= '<h3 class="">' . get_the_title() . '</h3>';
      $output .= '<p>' . get_field( 'poste_occupe' ) . '</p>';
      $output .= '</div>';
      $output .= '</div>';
      $output .= '</div>';
    }
  } else {
    $output .= '<div class="portfolio-blank">';
    $output .= '<h3 class="text-center text-primary">' . __( 'Aucun collaborateur trouvé', 'loops' ) . '</h3>';
    $output .= '</div>';
  }
  
  wp_reset_postdata();
  
  $output .= '</div>';
  $output .= '</section>';

  return $output;
}

function loops_add_shortcode() {
  add_shortcode( 'loops_portfolio', 'loops_portfolio_shortcode' );
}

add_action( 'init', 'loops_add_shortcode' );