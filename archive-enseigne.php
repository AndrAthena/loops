<?php get_header() ?>

<?php ?>

<div id="nos-enseignes">
  <section>
  
  <?php
    $args = array(
      'post_type'   => 'enseigne',
      'post_status' => 'publish',
      'order'       => 'ASC'
    );
    $query = new WP_Query( $args );
  
    if( $query->have_posts() ): while( $query->have_posts() ): $query->the_post();
      $logo = get_field( 'logo' );
      $information = get_field( 'information' );
      $lien = get_field( 'lien' );
      $title = $lien['title'];
      $url = $lien['url'];
  ?>
  
  <article class="fallback-bg position-relative">
    <div class="row">
      <div class="col-lg-8 p-0">
        <?php the_post_thumbnail( 'full', array('class' => 'img-cover') ) ?>
      </div>
      <div class="col-lg-4 bg-white p-0"></div>
    </div>
    <div class="row">
      <div class="container bg-transparent">
        <div class="row h-100">
          <div class="col-lg-5 align-self-end bg-white text-pad pb-0">
            <img class="mb-3" src="<?php echo $logo ?>" alt="<?php echo get_the_title() ?>">
            <div class="text-box">
              <?php the_excerpt() ?>
            </div>
            <a href="<?php echo esc_url( $url ) ?>" class="btn px-0"><?php echo $title ?></a>
          </div>
          <div class="offset-lg-3 col-lg-4 bg-white d-flex">
            <div class="mt-auto text-pad">
              <?php the_title( '<h2>', '</h2>' ) ?>
              <div>
                <?php echo $information ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </article>
  
  <?php endwhile; endif; wp_reset_postdata(); ?>
  
  </section>
</div>

<?php get_footer() ?>