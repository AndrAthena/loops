</main>
  <footer>
    <div class="footer-menu">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 mb-4 mb-md-0">
            <?php
              $custom_logo_id = get_theme_mod( 'custom_logo' );
              $logo = wp_get_attachment_image_src( $custom_logo_id, 'logo' );
      
              if( has_custom_logo() ):
            ?>
            <img src="<?php echo esc_url( $logo[0] ) ?>" alt="<?php echo get_bloginfo( 'name' ) ?>">
            <?php else: ?>
              <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ) ?>" alt="<?php echo get_bloginfo( 'name' ) ?>">
            <?php endif ?>
          </div>
          <div class="col-sm-6">
            <?php if( is_active_sidebar( 'footer-menu' ) ) dynamic_sidebar( 'footer-menu' ) ?>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-bottom bg-grey py-4">
      <div class="container">
        <div class="d-flex flex-column flex-lg-row align-items-center">
          <div class="mb-3 mb-lg-0">
            <a class=" border-right pr-3 mr-2" href="<?php echo get_page_link( get_page_by_title( 'Mentions légales' ) ) ?>">Mentions légales</a>
            <a href="<?php echo get_page_link( get_page_by_title( 'CGV' ) )  ?>">CGV</a>
          </div>
          <div class="ml-lg-auto">
            <span>
              Copyright © <?php echo date('Y') ?>
              <a href="<?php bloginfo( 'url' ) ?>"><?php echo preg_replace("/\w+:\/\//", "", get_bloginfo('url')) ?></a> - Design par Agence de communication Montpellier
            </span>
            <img class="ml-2" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/studio-gazoline.png' ) ?>" alt="Studio Gazoline" />
          </div>
        </div>
      </div>
    </div>
  </footer>
  <?php wp_footer() ?> 
</body>
</html>