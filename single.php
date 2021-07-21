<?php get_header() ?>
<?php get_template_part( 'template-parts/content', 'breadcrumb' ) ?>

<div class="mt-3">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <?php if(has_post_thumbnail()): the_post_thumbnail( 'full', array('class' => 'post-thumbnail') ) ?>
        <?php else: ?>
          <div class="bg-grey post-thumbnail"></div>
        <?php endif ?>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8 mx-auto mb-5">
        <article>
        <?php
          if( have_posts() ): while ( have_posts() ): the_post();
            the_title('<h1 class="mt-5 mb-3">', '</h1>');
            the_content();
          endwhile; endif;
        ?>
        </article>
      </div>
    </div>

    <div class="row pb-5 border-bottom">
      <div class="col-lg-8 mx-auto">
        <nav class="pagination h-auto">
          <?php
            $previous = get_previous_post( true );
            if($previous):
          ?>
            <li class="previous">
              <span class="mr-3"><</span>
              <a href="<?php echo esc_url( get_the_permalink( $previous->ID ) ) ?>">
                <div class="mb-2">
                  <span>Précédent</span><br>
                  <h5><?php echo $previous->post_title ?></h5>
                </div>
                <?php if( has_post_thumbnail($previous->ID)) : ?>
                  <img src="<?php echo esc_url( get_the_post_thumbnail_url( $previous->ID, 'medium' ) ) ?>" alt="<?php echo $previous->post_title ?>">
                <?php endif; ?>
              </a>
            </li>
          <?php endif; ?>
          <?php
            $next = get_next_post( true );
            if($next):
          ?>
            <li class="next ml-auto">
              <a href="<?php echo esc_url( get_the_permalink( $next->ID ) ) ?>">
                <div class="mb-2 text-right">
                  <span>Suivant</span><br>
                  <h5><?php echo $next->post_title ?></h5>
                </div>
                <?php if( has_post_thumbnail($next->ID)) : ?>
                  <img src="<?php echo esc_url( get_the_post_thumbnail_url( $next->ID, 'medium' ) ) ?>" alt="<?php echo $next->post_title ?>">
                <?php endif; ?>
              </a>
              <span class="ml-3">></span>
            </li>
          <?php endif; ?>
        </nav>
      </div>
    </div>
  </div>
</div>


<?php get_footer() ?>