<?php

/**
 * Template Name: Archive Recrutement
 */

?>

<?php get_header() ?>

<div>
  <?php
  
  $page           = get_queried_object();
  $feature_image  = wp_get_attachment_image_src( get_post_thumbnail_id( get_queried_object_id() ), 'full' );
  $page_except    = get_the_excerpt( get_queried_object_id() );

  ?>
  <?php get_template_part( 'template-parts/content', 'breadcrumb' ) ?>

  <section id="banner-archive" class="position-relative fallback-bg enseigne" style="background-image: url(<?php echo $feature_image[0] ?>)">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-none d-lg-block"></div>
        <div class="col-lg-6">
          <div class="d-flex flex-column justify-content-end h-100">
            <h1 class="text-primary"><?php echo $page_except ?></h1>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <section id="recrutement">
    <div class="container">
      <h2 class="text-center mb-4">Nos offres d'emploi</h2>
      <div class="row">
        <div class="col-md-7 mx-auto">
          <p class="text-center">Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Nulla quis lorem ut libero malesuada feugiat. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus.</p>
        </div>
      </div>
    </div>
    <div class="bg-grey py-4">
      <div class="container">
        <form id="filtre-recrutement" action="<?php the_permalink() ?>" method="GET">
          <div class="row">
            <div class="col-md-4">
              <div class="form-inline mb-md-0">
                <label for="metier"class="mb-0 mr-3 font-weight-bold">Métier</label>
                <select class="form-select flex-grow-1" name="job">
                  <option value="0">Tout</option>
                  <?php
                  $metier = new WP_Query( array( 'post_type' => 'metier' ) );
                  
                  if( $metier->have_posts() ): while( $metier->have_posts() ): $metier->the_post(); ?>
                  
                  <option value="<?php the_ID() ?>" <?php echo get_query_var( 'job' ) == get_the_ID() ? 'selected' : '' ?>><?php echo get_the_title(); ?></option>
                  
                  <?php endwhile; endif; wp_reset_postdata(); ?>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-inline mb-md-0">
                <label for="magasin"class="mb-0 mr-3 font-weight-bold">Magasin</label>
                <select id="magasin" class="form-select flex-grow-1" name="shop">
                  <option value="0">Tout</option>
                  <?php
                  $magasin = new WP_Query( array( 'post_type' => 'enseigne' ) );
                  
                  if( $magasin->have_posts() ): while( $magasin->have_posts() ): $magasin->the_post(); ?>
                  
                  <option value="<?php the_ID() ?>" <?php echo get_query_var( 'shop' ) == get_the_ID() ? 'selected' : '' ?>><?php echo get_the_title(); ?></option>

                  <?php endwhile; endif; wp_reset_postdata(); ?>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-inline mb-md-0">
                <label for="ville"class="mb-0 mr-3 font-weight-bold">Ville</label>
                <select id="ville" class="form-select flex-grow-1" name="city">
                  <option value="0">Toutes</option>
                    <?php
                    $villes = get_terms( array('taxonomy' => 'ville', 'hide_empty' => 0) );
                    
                    foreach($villes as $ville) : ?>
                    
                      <option value="<?php echo $ville->term_id ?>" <?php echo get_query_var('city') == $ville->term_id ? 'selected' : '' ?>><?php echo $ville->name ?></option>
                    
                    <?php endforeach ;?>
                </select>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="py-5">
      <div class="container">
        <div class="row">
          <?php        
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
              'key'    => 'metier',
              'value'  => $job
            );
            $meta_query[] = $filter_by_job;
          }

          /**
           * Filter by shop
           */
          if( isset( $_GET['shop'] ) && $_GET['shop'] ) {
            $shop = $_GET['shop'];
            $filter_by_shop = array(
              'key'    => 'enseigne',
              'value'  => $shop
            );
            $meta_query[] = $filter_by_shop;
          }

          /**
           * Filter by city
           */
          if( isset( $_GET['city'] ) && $_GET['city'] ) {
            $term_city = $_GET['city'];
            $filter_by_city = array(
              'key'    => 'ville',
              'value'  => $term_city
            );           
            $meta_query[] = $filter_by_city;
          }

          if( count( $meta_query ) ) {
            $args['meta_query'] = $meta_query;
          }

          $query = new WP_Query( $args );

          if( $query->have_posts() ): while( $query->have_posts() ) :
            $query->the_post();
            $enseigne           = get_post( get_field( 'enseigne' ) );
            $description        = get_post_field( 'description', $enseigne );
            $logo_id            = get_post_field( 'logo', $enseigne );
            $logo_url           = wp_get_attachment_url( $logo_id );
            $ville              = get_term_by( 'term_id', get_field( 'ville' ), 'ville' );
          ?>
          <div class="col-md-4">
            <div class="card border-0">
              <div class="card-header bg-primary text-white rounded-0">
                <h3 class="card-title mb-0"><?php echo get_the_title() ?></h3>
                <div class="ref"><span class="font-weight-bold">REF</span> • <?php the_field( 'reference' ) ?></div>
              </div>
              <div class="card-body rounded-0">
                <img src="<?php echo $logo_url ?>" alt="<?php echo $enseigne->post_title ?>" class="mb-4">
                <h3 class="mb-4 font-weight-normal"><?php echo $ville->name ?></h3>
                <div class="text-box"><?php echo wp_trim_words( $description, 35 )  ?></div>
                <a href="<?php the_permalink() ?>" title="<?php echo get_the_title() ?>" class="btn px-0">Postuler</a>
              </div>
            </div>
          </div>
          <?php endwhile; endif; wp_reset_postdata(); ?>
        </div>
      </div>
    </div>
    <div class="bg-grey py-3">
      <div class="container">
        <div class="text-center">
          <?php loops_pagination() ?>
        </div>
      </div>
    </div>
  </section>
</div>

<?php get_footer() ?>