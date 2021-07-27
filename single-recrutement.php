<?php get_header() ?>

<?php if(have_posts()): the_post();
  $metier = get_post( get_field( 'metier' ) );
  $enseigne = get_post( get_field( 'enseigne' ) );
  $feature_image = get_the_post_thumbnail_url( $post->ID ) ? get_the_post_thumbnail_url( $post->ID ) : get_the_post_thumbnail_url( $enseigne->ID );
  $logo_id = get_post_field( 'logo', $enseigne );
  $logo_url = wp_get_attachment_url( $logo_id );
  $ville = wp_get_post_terms( $enseigne->ID, 'ville' );
?>

<?php get_template_part( 'template-parts/content', 'breadcrumb' ) ?>
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
              <?php
                foreach ($ville as $v) {
                  echo $v->name;
                }
              ?>
              </span>
            </div>
            <a href="#postuler" class="btn text-white">Postuler</a>
        </div>
      </div>
    </div>
  </div>
</section>

  <?php echo do_shortcode( '[elementor-template id="815"]' ); ?>
  <?php echo do_shortcode( '[elementor-template id="808"]' ); ?>
  <?php the_content() ?>
<?php endif; ?>
<?php get_footer() ?>