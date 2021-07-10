<button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#site-menu" aria-controls="site-menu" aria-expanded="false" aria-label="Toggle navigation">
  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
    <path d="M0 0h24v24H0V0z" fill="none"/><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/>
  </svg>
</button>

<?php wp_nav_menu( array(
  'container_id'      => 'site-menu',
  'container_class'   => 'collapse navbar-collapse flex-grow-1',
  'menu_class'				=> 'navbar-nav ml-auto',
  'theme_location'	 	=> 'main',
) );

?>