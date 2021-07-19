<section id="portfolio">
  <div class="row">
    <?php
    $args = array(
      'post_type'       => 'collaborateur',
      'post_status'     => 'publish',
      'posts_per_page'  => -1,
    );
    $query = new WP_Query( $args );
    
    if( $query->have_posts() ): while( $query->have_posts() ): $query->the_post();
      var_dump(get_the_title());
    ?>
    <div class="col-md-6 col-lg-3">
      <div class="portfolio-overlay"></div>
    </div>
    <?php endwhile; endif; wp_reset_postdata() ?>
  </div>
</section>