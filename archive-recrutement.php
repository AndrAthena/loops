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
    <?php echo do_shortcode( '[loops_recrutement]' ) ?>
  </section>
</div>

<?php get_footer() ?>