<?php

/**
 * Template Name: Archive Métier
 */

?>
<?php get_header() ?>

<div>
  <?php
  
  $page = get_queried_object();
  $feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_queried_object_id() ), 'full' );
  $page_except = get_the_excerpt( get_queried_object() );

  ?>

  <section id="banner-archive" class="position-relative fallback-bg metier" style="background-image: url(<?php echo $feature_image[0] ?>)">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-none d-lg-block"></div>
        <div class="col-lg-6">
          <div class="d-flex flex-column justify-content-end h-100">
            <h1 class="text-primary"><?php echo $page_except ?></h1>
          </div>
        </div>
      </div>
      <?php $post_type = 'metier'; get_template_part( 'template-parts/cpt', 'list'  ) ?>
    </div>
  </section>
  
  <section id="metier" class="container-fluid">
  <?php
  $paged = get_query_var('paged') ? get_query_var('paged') : 1;
  $args = array(
    'post_type'       => 'metier',
    'post_status'     => 'publish',
    'posts_per_page'  => 5,
    'paged'           => $paged
  );

  $query = new WP_Query( $args );
  $i = 0;
  if( $query->have_posts() ): while( $query->have_posts() ):
    $query->the_post();
  ?>  
    <article <?php post_class('position-relative mt-5') ?>>
      <div class="<?php echo ($i % 2) ? 'text-right' : 'text-left' ?>">
        <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="<?php get_the_title() ?>" class="elementor-img-cover">
      </div>
      <div class="information <?php echo ($i % 2) ? 'text-position-left' : 'text-position-right' ?>">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 bg-white <?php echo ($i % 2) ? 'mr-auto' : 'ml-auto' ?>">
              <div class="info-metier">
                <?php the_title('<h2 class="mb-4">', '</h2>') ?>
                <div class="text-box">
                  <?php the_field('description') ?>
                </div>
                <a href="<?php esc_url( the_permalink() ) ?>" class="btn px-0">Voir la fiche métier</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </article>

  <?php $i++; endwhile; endif; wp_reset_postdata(); ?>
  
  </section>
  <div class="bg-grey py-3">
    <div class="container">
      <div class="text-center">
        <?php loops_pagination() ?>
      </div>
    </div>
  </div>
  <section>
        <?php echo do_shortcode( '[elementor-template id="392"]' ) ?>
  </section>
</div>

<?php get_footer() ?>