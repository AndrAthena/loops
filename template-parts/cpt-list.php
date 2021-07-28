<div class="text-right position-relative">
  <ul class="liste-type">
  <?php

  global $post_type;

  $args = array(
    'post_type'       => $post_type,
    'post_status'     => 'publish',
    'posts_per_page'  => 5
  );
  $query = new WP_Query( $args );

  if( $query->have_posts() ) :
    while( $query->have_posts() ) :
      $query->the_post();
  ?>

  <li>
    <a href="<?php the_permalink() ?>" class="text-body"><?php echo get_the_title() ?></a>
  </li>

  <?php endwhile; endif; wp_reset_postdata(); ?>
  </ul>
</div>