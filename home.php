<?php get_header() ?>

<?php
  $page = get_queried_object();
  $feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $page->ID ), 'full' );
?>

<section id="hero" class="position-relative fallback-bg" style="background-image: url(<?php echo $feature_image[0] ?>)">
  <div class="overlay"></div>
  <div class="h-100 d-flex flex-column justify-content-center align-items-center">
    <h1 class="text-white"><?php _e( 'Actualités', 'loops' )?></h1>
  </div>
</section>
<?php get_template_part( 'template-parts/content', 'breadcrumb' ) ?>
<section id="actualites">
  <div class="container">
    <?php
      $args = array(
        'post_type'       => 'post',
        'post_status'     => 'publish',
      );

      $count = 0;
      
      $query = new WP_Query( $args );
      
      if( $query->have_posts() ): while( $query->have_posts() ): $query->the_post(); ?>
      <?php $class_reverse = $count % 2 ? 'flex-row-reverse' : ''; ?>

      <article <?php post_class( ['d-flex', $class_reverse] ) ?>>
        <div class="fallback-bg mb-3 mb-md-0">
          <?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'img-fluid') ) ?>
        </div>
        <div class="post-content">
          <?php the_title( '<h2>', '</h2>' ) ?>
          <div class="text-box">
            <p>
              <?php echo wp_trim_words( get_the_content(), 40 ) ?>
            </p>
          </div>
          <a href="<?php the_permalink() ?>" class="btn text-primary text-uppercase font-weight-bold text-left px-0">Lire la suite ></a>
        </div>
      </article>

      <?php $count++; endwhile; endif; wp_reset_query() ?>

    </div>
    <div class="py-4 bg-grey border-bottom">
      <?php loops_pagination( 'justify-content-center mt-0' ) ?>
    </div>
</section>


<?php get_footer() ?>