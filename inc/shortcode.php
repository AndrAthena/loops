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

function loops_liste_recrutement() {
  $output = '';
  $output .= '<div class="bg-grey py-4">';
  $output .= '<div class="container">';
  $output .= '<form id="filtre-recrutement" action="the_permalink()" method="GET">';
  $output .= '<div class="row">';
  $output .= '<div class="col-md-4">';
  $output .= '<div class="form-inline mb-md-0">';
  $output .= '<label for="metier"class="mb-0 mr-3 font-weight-bold">Métier</label>';
  $output .= '<select class="form-select flex-grow-1" name="job">';
  $output .= '<option value="0">Tout</option>';

  $metier = new WP_Query( array( 'post_type' => 'metier' ) );
  if( $metier->have_posts() ): while( $metier->have_posts() ): $metier->the_post();         
    $output .= '<option value="' . the_ID() . '" ' . get_query_var( "job" ) == get_the_ID() ? "selected" : "" . '>' . get_the_title() . '</option>';
  endwhile; endif; wp_reset_postdata();

  $output .= '</select>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '<div class="col-md-4">';
  $output .= '<div class="form-inline mb-md-0">';
  $output .= '<label for="magasin"class="mb-0 mr-3 font-weight-bold">Magasin</label>';
  $output .= '<select id="magasin" class="form-select flex-grow-1" name="shop">';
  $output .= '<option value="0">Tout</option>';

  $magasin = new WP_Query( array( 'post_type' => 'enseigne' ) );
  if( $magasin->have_posts() ): while( $magasin->have_posts() ): $magasin->the_post();
    $output .= '<option value="' . the_ID() . '" ' . get_query_var( "shop" ) == get_the_ID() ? "selected" : "" . '>' . get_the_title() . '</option>';
  endwhile; endif; wp_reset_postdata();

  $output .= '</select>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '<div class="col-md-4">';
  $output .= '<div class="form-inline mb-md-0">';
  $output .= '<label for="ville"class="mb-0 mr-3 font-weight-bold">Ville</label>';
  $output .= '<select id="ville" class="form-select flex-grow-1" name="city">';
  $output .= '<option value="0">Toutes</option>';

  $villes = get_terms( array('taxonomy' => 'ville', 'hide_empty' => 0) );
      
  foreach($villes as $ville) :
  $output .= '<option value="' . $ville->term_id . '" ' . get_query_var('city') == $ville->term_id ? "selected" : "" . '>' . $ville->name . '</option>';
  endforeach ;

  $output .= '</select>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</form>';
  $output .= '</div>';
  $output .= '</div>';



  $output .= '<div class="py-5">';
  $output .= '<div class="container">';
  $output .= '<div class="row">';

  $paged = get_query_var('paged') ? get_query_var('paged') : 1;
  $args = array(
    'post_type'       => 'recrutement',
    'post_status'     => 'publish',
    'posts_per_page'  => 9,
    'paged'           => $paged
  );
  $meta_query = array();

  /**
   * Filter by job
   */
  if( isset( $_GET['job'] ) && $_GET['job'] ) {
    $job = $_GET['job'];
    $filter_by_job = array(
      'key'     => 'metier',
      'value'   => $job
    );
    $meta_query[] = $filter_by_job;
  }

  /**
   * Filter by shop
   */
  if( isset( $_GET['shop'] ) && $_GET['shop'] ) {
    $shop = $_GET['shop'];
    $filter_by_shop = array(
      'key'     => 'enseigne',
      'value'   => $shop
    );
    $meta_query[] = $filter_by_shop;
  }

  /**
   * Filter by city
   */
  if( isset( $_GET['city'] ) && $_GET['city'] ) {
    $term_city = $_GET['city'];
    $filter_by_city = array(
      'key'     => 'ville',
      'value'   => $term_city
    ); 
    $meta_query[] = $filter_by_city;
  }

  if( count( $meta_query ) ) {
    $args['meta_query'] = $meta_query;
  }

  $query = new WP_Query( $args );

  if( $query->have_posts() ): while( $query->have_posts() ) :
    $query->the_post();
    $enseigne = get_post( get_field( 'enseigne' ) );
    $description= get_post_field( 'description', $enseigne );
    $logo_id= get_post_field( 'logo', $enseigne );
    $logo_url = wp_get_attachment_url( $logo_id );
    $ville= get_term_by( 'term_id', get_field( 'ville' ), 'ville' );

    $output .= '<div class="col-md-4">';
    $output .= '<div class="card border-0">';
    $output .= '<div class="card-header bg-primary text-white rounded-0">';
    $output .= '<h3 class="card-title mb-0">' . get_the_title() . '</h3>';
    $output .= '<div class="ref"><span class="font-weight-bold">REF</span> • ' .  the_field( 'reference' ) . '</div>';
    $output .= '</div>';
    $output .= '<div class="card-body rounded-0">';
    $output .= '<img src="' . $logo_url . '" alt="' . $enseigne->post_title . '" ' . 'class="mb-4">';
    $output .= '<h3 class="mb-4 font-weight-normal">' . $ville->name . '</h3>';
    $output .= '<div class="text-box">' . wp_trim_words( $description, 35 ) . '</div>';
    $output .= '<a href="' . the_permalink() . '" title="' . get_the_title() . '" class="btn px-0">Postuler</a>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
  endwhile; endif; wp_reset_postdata(); 

  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';

  return $output;
}

function loops_add_shortcode() {
  add_shortcode( 'loops_portfolio', 'loops_portfolio_shortcode' );
  add_shortcode( 'loops_recrutement', 'loops_liste_recrutement' );
}

add_action( 'init', 'loops_add_shortcode' );