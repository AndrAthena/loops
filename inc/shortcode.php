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
  $output .= '<div class="row mx-0">';

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

function loops_liste_recrutement_shortcode() {
  $output = '';
  $output .= '<div id="recrutement-filter" class="bg-grey py-4">';
  $output .= '  <div class="container">';
  $output .= '    <form id="filtre-recrutement" action="" method="GET">';
  $output .= '       <div class="row">';
  $output .= '         <div class="col-md-4">';
  $output .= '           <div class="form-inline mb-md-0">';
  $output .= '             <label for="metier"class="mb-0 mr-3 font-weight-bold">Métier</label>';
  $output .= '             <select class="form-select flex-grow-1" name="job">';
  $output .= '                <option value="0">Tout</option>';

  $metier = new WP_Query( array( 'post_type' => 'metier' ) );
  if( $metier->have_posts() ): while( $metier->have_posts() ): $metier->the_post();         
    $output .= '<option value="' . get_the_ID() . '" ' . ( get_query_var( "job" ) == get_the_ID() ? "selected" : "" ) . '>' . get_the_title() . '</option>';
  endwhile; endif; wp_reset_postdata();

  $output .= '             </select>';
  $output .= '           </div>';
  $output .= '         </div>';
  $output .= '         <div class="col-md-4">';
  $output .= '            <div class="form-inline mb-md-0">';
  $output .= '              <label for="magasin"class="mb-0 mr-3 font-weight-bold">Magasin</label>';
  $output .= '              <select id="magasin" class="form-select flex-grow-1" name="shop">';
  $output .= '                <option value="0">Tout</option>';

  $magasin = new WP_Query( array( 'post_type' => 'enseigne' ) );
  if( $magasin->have_posts() ): while( $magasin->have_posts() ): $magasin->the_post();
    $output .= '<option value="' . get_the_ID() . '" ' . ( get_query_var( "shop" ) == get_the_ID() ? "selected" : "" ) . '>' . get_the_title() . '</option>';
  endwhile; endif; wp_reset_postdata();

  $output .= '</select>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '         <div class="col-md-4">';
  $output .= '            <div class="form-inline mb-md-0">';
  $output .= '              <label for="ville"class="mb-0 mr-3 font-weight-bold">Ville</label>';
  $output .= '              <select id="ville" class="form-select flex-grow-1" name="city">';
  $output .= '                <option value="0">Toutes</option>';

  $villes = get_terms( array('taxonomy' => 'ville', 'hide_empty' => 0) );
      
  foreach($villes as $ville) :
  $output .= '<option value="' . $ville->term_id . '" ' . ( get_query_var('city') == $ville->term_id ? "selected" : "" ) . '>' . $ville->name . '</option>';
  endforeach ;

  $output .= '             </select>';
  $output .= '           </div>';
  $output .= '         </div>';
  $output .= '      </div>';
  $output .= '    </form>';
  $output .= '  </div>';
  $output .= '</div>';

  $output .= '<div id="recrutement" class="py-5">';
  $output .= '  <div class="container">';
  $output .= '    <div id="recrutement-result" class="row">';

  $paged = get_query_var('paged') ? get_query_var('paged') : 1;
  $args = array(
    'post_type'       => 'recrutement',
    'post_status'     => 'publish',
    'posts_per_page'  => 9,
    'paged'           => $paged
  );

  $query = new WP_Query( $args );

  if( $query->have_posts() ) {
    while( $query->have_posts() ) {
      $query->the_post();
      $enseigne = get_post( get_field( 'enseigne' ) );
      $description= get_post_field( 'description', $enseigne );
      $logo_id= get_post_field( 'logo', $enseigne );
      $logo_url = wp_get_attachment_url( $logo_id );
      $ville= get_term_by( 'term_id', get_field( 'ville' ), 'ville' );

      $output .= '<div class="col-md-6 col-lg-4 mb-5">';
      $output .= '<div class="card border-0">';
      $output .= '<div class="card-header bg-primary text-white rounded-0">';
      $output .= '<h3 class="card-title mb-0">' . get_the_title() . '</h3>';
      $output .= '<div class="ref"><span class="font-weight-bold">REF</span> • ' .  get_field( 'reference' ) . '</div>';
      $output .= '</div>';
      $output .= '<div class="card-body rounded-0">';
      $output .= '<img src="' . $logo_url . '" alt="' . $enseigne->post_title . '" ' . 'class="mb-4">';
      $output .= '<h3 class="mb-4 font-weight-normal">' . $ville->name . '</h3>';
      $output .= '<div class="text-box">' . wp_trim_words( $description, 35 ) . '</div>';
      $output .= '<a href="' . get_the_permalink() . '" title="' . get_the_title() . '" class="btn px-0">Postuler</a>';
      $output .= '</div>';
      $output .= '</div>';
      $output .= '</div>';
    }
  } else {
    $output .= '<p class="w-100 p-2 text-center">' . __( 'Aucun résultat à afficher.', 'loops' ) . '</p>';
  }
  
  wp_reset_postdata();

  $output .= '    </div>';
  $output .= '  </div>';
  $output .= '</div>';

  $output .= loops_pagination( 'justify-content-center mt-0' );

  return $output;
}

function loops_related_recrutement_shortcode() {
  global $post;
  $output = '';

  $output .= '<div id="recrutement-single" class="py-5">';
  $output .= '  <div class="container">';
  $output .= '    <div id="recrutement-result" class="row">';

  $args = array(
    'post_type'       => 'recrutement',
    'post_status'     => 'publish',
    'posts_per_page'  => 3,
    'post__not_in'    => array( $post->ID ),
    'meta_query'      => array(
      'relation'      => 'OR',
      array(
        'key'         => 'enseigne',
        'value'       => get_post_field( 'enseigne', $post )
      ),
      array(
        'key'         => 'ville',
        'value'       => get_post_field( 'ville', $post )
      )
    )
  );

  
  $query = new WP_Query( $args );

  if( $query->have_posts() ) {
    while( $query->have_posts() ) {
      $query->the_post();
      $enseigne = get_post( get_field( 'enseigne' ) );
      $description= get_post_field( 'description', $enseigne );
      $logo_id= get_post_field( 'logo', $enseigne );
      $logo_url = wp_get_attachment_url( $logo_id );
      $ville= get_term_by( 'term_id', get_field( 'ville' ), 'ville' );

      $output .= '<div class="col-md-6 col-lg-4 mb-5">';
      $output .= '<div class="card border-0">';
      $output .= '<div class="card-header bg-primary text-white rounded-0">';
      $output .= '<h3 class="card-title mb-0">' . get_the_title() . '</h3>';
      $output .= '<div class="ref"><span class="font-weight-bold">REF</span> • ' .  get_field( 'reference' ) . '</div>';
      $output .= '</div>';
      $output .= '<div class="card-body rounded-0">';
      $output .= '<img src="' . $logo_url . '" alt="' . $enseigne->post_title . '" ' . 'class="mb-4">';
      $output .= '<h3 class="mb-4 font-weight-normal">' . $ville->name . '</h3>';
      $output .= '<div class="text-box">' . wp_trim_words( $description, 35 ) . '</div>';
      $output .= '<a href="' . get_the_permalink() . '" title="' . get_the_title() . '" class="btn px-0">Postuler</a>';
      $output .= '</div>';
      $output .= '</div>';
      $output .= '</div>';
    }
  } else {
    $output .= '<p class="w-100 p-2 text-center">' . __( 'Aucun offre d\'emploi similaire trouvé.', 'loops' ) . '</p>';
  }
  
  wp_reset_postdata();

  $output .= '    </div>';
  $output .= '  </div>';
  $output .= '</div>';

  $output .= loops_pagination( 'justify-content-center mt-0' );

  $output .= '<div class="bg-grey py-3">';
  $output .= '<div class="container">';
  $output .= '<div class="text-center">';
  loops_pagination();
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';

  return $output;
}

function loops_temoignage_shortcode() {
  global $post;
  $collaborateur = get_post( get_post_field( 'temoignage_de', $post ) );
  $nom = $collaborateur->post_title;
  $poste_occupe = get_post_field( 'poste_occupe', $collaborateur );
  $enseigne = get_post( get_post_field( 'enseigne', $collaborateur ) );
  $nom_enseigne = $enseigne->post_title;
  $ville = get_the_terms( $enseigne, 'ville' );

  $output = '<div>';
  $output .= '<h5>' . $nom . '</h5>';
  $output .= '<p>' . $poste_occupe . ' chez ' . $nom_enseigne . ' ' . $ville[0]->name. '</p>';
  $output .=  '</div>';

  return $output;
}

function loops_single_recrutement_shortcode() {
  global $post;
  if( 'recrutement' == get_post_type( $post ) ) {
    $metier = get_post( get_post_field( 'metier', $post ) );
    $enseigne = get_post( get_field( 'enseigne', $post ) );
    $feature_image = get_the_post_thumbnail_url( $post->ID ) ? get_the_post_thumbnail_url( $post->ID ) : get_the_post_thumbnail_url( $enseigne->ID );
    $logo_id = get_post_field( 'logo', $enseigne );
    $logo_url = wp_get_attachment_url( $logo_id );
    $ville = get_term_by( 'id', get_post_field( 'ville', $post ), 'ville' );
    $photo_profil_id = get_post_field( 'photo_profil', $metier );
    $photo_profil_url = wp_get_attachment_url( $photo_profil_id );
    $photo_mission_id = get_post_field( 'photo_mission', $metier );
    $photo_mission_url = wp_get_attachment_url( $photo_mission_id );
  }

  get_template_part( 'template-parts/content', 'breadcrumb' );

  ob_start();
?>

<section id="banner-archive" class="position-relative fallback-bg recrutement" style="background-image: url(<?php echo $feature_image ?>)">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <div class="d-flex flex-column justify-content-center align-items-center h-100">
            <h1 class="text-center text-white position-relative mb-5"><?php echo get_the_title() ?></h1>
            <img width="150" src="<?php echo $logo_url ?>" alt="<?php echo get_the_title( $enseigne ) ?>" class="mb-4">
            <div class="text-box mt-4">
              <span class="bg-white text-primary font-weight-bold h5 p-2">
                <?php echo $ville->name; ?>
              </span>
            </div>
            <a href="#postuler" class="btn text-white">Postuler</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="profil">
  <div class="container">
    <div class="row position-relative">
      <img src="<?php echo $photo_profil_url ?>" alt="" class="col-md-6 img-cover mb-4">
      <div class="col-md-6 col-lg-5 text">
        <h2 class="mb-4">Votre profil</h2>
        <?php echo get_post_field( 'profil', $metier ); ?>
      </div>
    </div>
  </div>
</section>
<section id="mission">
  <div class="container">
    <div class="row position-relative">
      <img src="<?php echo $photo_mission_url ?>" alt="" class="col-md-6 img-cover mb-4">
      <div class="col-md-6 col-lg-7"></div>
      <div class="col-md-6 col-lg-5 text">
        <h2 class="mb-4">Votre mission</h2>
        <?php echo get_post_field( 'mission', $metier ); ?>
      </div>
    </div>
  </div>
</section>

<?php

ob_end_flush();

}

function loops_add_shortcode() {
  add_shortcode( 'loops_portfolio', 'loops_portfolio_shortcode' );
  add_shortcode( 'loops_recrutement', 'loops_liste_recrutement_shortcode' );
  add_shortcode( 'loops_related_recrutement', 'loops_related_recrutement_shortcode' );
  add_shortcode( 'loops_temoignage', 'loops_temoignage_shortcode' );
  add_shortcode( 'loops_single_recrutement', 'loops_single_recrutement_shortcode' );
}

add_action( 'init', 'loops_add_shortcode' );