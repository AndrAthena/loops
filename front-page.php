<?php get_header() ?>

<div>

<?php

if( have_posts() ): while ( have_posts() ): the_post();

the_content();

endwhile; endif;

?>

<?php get_template_part( 'template-parts/content', 'portfolio' ) ?>

</div>

<?php get_footer() ?>