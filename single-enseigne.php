<?php get_header() ?>
<?php get_template_part( 'template-parts/content', 'breadcrumb' ) ?>

<div class="container">
  <?php
    if( have_posts() ): while ( have_posts() ): the_post();
      the_content();
    endwhile; endif;
  ?>
</div>

<?php get_footer() ?>