<?php

/**
 * Template Name: Archive Recrutement
 */

?>

<?php get_header() ?>

<div>
  <?php
  
  $page = get_queried_object();
  $feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $page->ID ), 'full' );
  $page_except = get_the_excerpt( $page->ID );

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
                <select class="form-select flex-grow-1" name="metier">
                  <option selected>Tout</option>
                  <?php
                  $metier = new WP_Query( array( 'post_type' => 'metier' ) );
                  
                  if( $metier->have_posts() ): while( $metier->have_posts() ): $metier->the_post(); ?>
                  
                  <option value="<?php echo "metier-" . get_the_ID() ?>"><?php echo get_the_title(); ?></option>

                  <?php endwhile; endif; wp_reset_postdata(); ?>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-inline mb-md-0">
                <label for="metier"class="mb-0 mr-3 font-weight-bold">Magasin</label>
                <select class="form-select flex-grow-1" name="enseigne">
                  <option selected>Tout</option>
                  <?php
                  $magasin = new WP_Query( array( 'post_type' => 'enseigne' ) );
                  
                  if( $magasin->have_posts() ): while( $magasin->have_posts() ): $magasin->the_post(); ?>
                  
                  <option value="<?php echo "magasin-" . get_the_ID() ?>"><?php echo get_the_title(); ?></option>

                  <?php endwhile; endif; wp_reset_postdata(); ?>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-inline mb-md-0">
                <label for="metier"class="mb-0 mr-3 font-weight-bold">Ville</label>
                <select class="form-select flex-grow-1" name="ville">
                  <option selected>Toutes</option>
                  <?php

                  $villes = get_terms(array(
                    'taxonomy'    => 'ville',
                    'hide_empty'  => 0
                  ));

                  foreach($villes as $ville) : ?>

                  <option value="<?php echo $ville->term_id ?>"><?php echo $ville->name ?></option>

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
          if( isset( $_GET['ville'] ) ) {
            $ville_term = $_GET['ville'];
            var_dump( $ville_term );
          }

          $args = array(
            'post_type'     => 'recrutement',
            'post_stataus'  => 'publish',
            // 'tax_query'     => array(
            //   array(
            //     'taxonomy'  => 'ville',
            //     'field'     => 'name',
            //     'terms'     => $ville_term
            //   )
            // )
          );

          $query = new WP_Query( $args );

          if( $query->have_posts() ): while ( $query->have_posts() ): $query->the_post();
          $enseigne = get_field( 'enseigne' );
          ?>
          <div class="col-md-4">
            <div class="card border-0">
              <div class="card-header bg-primary text-white rounded-0">
                <h3 class="card-title mb-0"><?php echo get_the_title() ?></h3>
                <div class="ref"><span class="font-weight-bold">REF</span> • <?php the_field( 'reference' ) ?></div>
              </div>
              <div class="card-body rounded-0">
                <div class="text-box">
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                </div>
                <a href="<?php the_permalink() ?>" class="btn px-0">Postuler</a>
              </div>
            </div>
          </div>
          <?php endwhile; endif; wp_reset_postdata(); ?>
        </div>
      </div>
    </div>
  <?php
  $args = array(
    'post_type'       => 'recrutement',
    'post_status'     => 'publish',
    'posts_per_page'  => 9
  );

  $query = new WP_Query( $args );
  if( $query->have_posts() ): while( $query->have_posts() ):
    $query->the_post();
  ?>  
    <article <?php post_class() ?>>
    </article>

  <?php endwhile; endif; wp_reset_postdata(); ?>
  </section>
</div>

<?php get_footer() ?>