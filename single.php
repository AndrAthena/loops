<?php get_header() ?>
<?php get_template_part( 'template-parts/content', 'breadcrumb' ) ?>

<div class="mt-3">
  <div class="container">

    <?php

      if( have_posts() ): while ( have_posts() ): the_post();

      the_content();

      endwhile; endif;

    ?>

      <nav class="pagination">
        <?php
          $previous = get_previous_post( true );
          if($previous):
        ?>
          <li class="previous">
            <span class="mr-3"><</span>
            <div>
              <a href="<?php echo esc_url( get_the_permalink( $previous->ID ) ) ?>">
                <div class="mb-2">
                  <span>Précédent</span><br>
                  <h5><?php echo $previous->post_title ?></h5>
                </div>
                <img src="<?php echo esc_url( get_the_post_thumbnail_url( $previous->ID, 'thumbnail' ) ) ?>" alt="<?php echo $previous->post_title ?>">
              </a>
            </div>
          </li>
        <?php endif; ?>
        <?php
          $next = get_next_post( true );
          if($next):
        ?>
          <li class="next ml-auto">
            <div>
              <a href="<?php echo esc_url( get_the_permalink( $next->ID ) ) ?>">
                <div class="mb-2 text-right">
                  <span>Suivant</span><br>
                  <h5><?php echo $next->post_title ?></h5>
                </div>
                <img src="<?php echo esc_url( get_the_post_thumbnail_url( $next->ID, 'thumbnail' ) ) ?>" alt="<?php echo $next->post_title ?>">
              </a>
            </div>
            <span class="ml-3">></span>
          </li>
        <?php endif; ?>
      </nav>
  </div>
</div>


<?php get_footer() ?>