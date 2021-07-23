<?php

$includes = array( '/inc/hook.php', '/inc/theme-setup.php', '/inc/enqueue.php', '/inc/widget.php', '/inc/cpt.php',  '/inc/shortcode.php', '/inc/acf.php' );

foreach ($includes as $include) {
  $include = locate_template( $include );
  load_template( $include );
}