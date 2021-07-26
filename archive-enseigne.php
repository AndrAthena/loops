<?php

/**
 * Template Name: Archive Enseigne
 */

?>

<?php get_header() ?>

<div>
  <?php
  
  $page = get_queried_object();
  $feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_queried_object_id() ), 'full' );
  $page_except = get_the_excerpt( get_queried_object() );

  ?>

  <section id="banner-archive" class="position-relative fallback-bg enseigne" style="background-image: url(<?php echo $feature_image[0] ?>)">
    <div class="container">
      <div class="row">
        <div class="col-lg-7 d-none d-lg-block"></div>
        <div class="col-lg-5">
          <div class="d-flex flex-column justify-content-end h-100">
            <h1 class="text-primary"><?php echo $page_except ?></h1>
          </div>
        </div>
      </div>
      <?php $post_type = 'enseigne'; get_template_part( 'template-parts/cpt', 'list'  ) ?>
    </div>
  </section>
  
  <section id="nos-enseignes" class="container-fluid">
  <?php
  $args = array(
    'post_type'       => 'enseigne',
    'post_status'     => 'publish',
    'posts_per_page'  => 6
  );

  $query = new WP_Query( $args );
  $i = 0;
  if( $query->have_posts() ): while( $query->have_posts() ):
    $query->the_post();
    $logo = get_field('logo');
    $information = get_field('information');
    $description = get_field('description');
    $lien = get_field('lien');
  ?>  
    <article <?php post_class('position-relative') ?>>
      <div class="overlay">
        <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="<?php get_the_title() ?>" class="elementor-img-cover">
      </div>
      <div class="row <?php echo ($i % 2) ? 'flex-row-reverse' : '' ?>">
        <div class="col d-flex my-3 my-lg-0">
          <div class="bg-white description text-pad">
            <img src="<?php echo $logo ?>" alt="<?php get_the_title() ?>" class="mb-4" />
            <div class="text-box">
              <?php echo $description ?>
            </div>
            <a href="<?php echo esc_url( $lien['url'] ) ?>" class="btn px-0"><?php echo $lien['title'] ?></a>
          </div>
        </div>
        <div class="col <?php echo !($i % 2) ? 'ml-lg-auto' : 'mr-lg-auto' ?> d-flex flex-column mb-lg-0">
          <div class="information">
            <?php the_title('<h2 class="mb-4">', ' ></h2>') ?>
            <?php echo $information ?>
          </div>
        </div>
      </div>
    </article>

  <?php $i++; endwhile; endif; wp_reset_postdata(); ?>
  </section>
  <section>
    <?php echo do_shortcode( '[elementor-template id="392"]' ) ?>
  </section>
</div>

<?php get_footer() ?>