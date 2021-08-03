<?php

function loops_nav_menu_css_class( $classes, $item, $args ) {
  if( 'main' == $args->theme_location ) {
    $classes[] = 'nav-item';
  }

  return $classes;
}
add_filter( 'nav_menu_css_class', 'loops_nav_menu_css_class', 10, 4 );

function loops_nav_menu_link_attributes( $atts, $item, $args ) {
  if( 'main' == $args->theme_location ) {
    $atts['class'] = 'nav-link';
  }
  
  return $atts;
}

function loops_breadcrumb() {
  $showOnHome = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = '<span class="delimiter">/</span>'; // delimiter between crumbs
  $home = 'Accueil'; // text for the 'Home' link
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
  global $post;
  $homeLink = get_bloginfo('url');
 
    echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

    if( is_home() ) {
      echo $before . 'Actualités';
    }

    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
      if( get_post_type() == 'post' ) {
        echo $before . '<a href="' . get_post_type_archive_link('post') . '">Actualités</a>' . $delimiter . single_cat_title('', false) . $after;
      } else {
        echo $before . 'Catégorie : "' . single_cat_title('', false) . '"' . $after;
      }
 
    } elseif ( is_search() ) {
      echo $before . 'Résultats de la recherche "' . get_search_query() . '"' . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        if( get_post_type() == 'enseigne' ) {
          echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">Nos enseignes</a>';
        }
        elseif( get_post_type() == 'metier' ) {
          echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">Quelles carrières chez nous ?</a>';
        }
        else {
          echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
        }
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      }
      else {
        echo '<a href="' . get_post_type_archive_link( get_post_type() ) . '">' . __( 'Actualités', 'loops' ) . '</a>';
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
      }
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }

}
add_filter( 'nav_menu_link_attributes', 'loops_nav_menu_link_attributes', 10, 4 );

function loops_pagination($class = '') {
  global $wp_query;
  $pages = paginate_links(
    array(
      'type'      => 'array',
      'total'     => $wp_query->max_num_pages,
      'prev_text' => '<',
      'next_text' => '>',
    )
  );
  if($pages != NULL) {
    echo '<div class="py-4 bg-grey border-bottom">';
    echo '<div class="pagination ' . $class . '">';
    foreach ($pages as $page) {
      $active = strpos($page, 'current') ? " active" : "";
      echo '<li class="page-item' . $active  . '">';
      echo str_replace( 'page-numbers', 'page-link', $page );
      echo "</li>";
    }
    echo "</div>";
    echo "</div>";
  } else return;
}

function loops_query_var($query) {
  $query[] = "job";
  $query[] = "shop";
  $query[] = "city";
  return $query;
}

add_filter( 'query_vars', 'loops_query_var' );

function loops_ajax_recrutement() {
  $paged = get_query_var('paged') ? get_query_var('paged') : 1;
  $args = array(
    'post_type'       => 'recrutement',
    'post_status'     => 'publish',
    'posts_per_page'  => 9,
    'paged'           => $paged
  );
  
  $meta_query = array();
  
  if( isset( $_POST['filter'] ) && !is_null( $_POST['filter'] ) ) {
    extract( $_POST['filter'] );
    /**
     * Filter by job
    */
    if( $job ) {
      $filter_by_job = array(
        'key'     => 'metier',
        'value'   => $job
      );
      $meta_query[] = $filter_by_job;
    }

    /**
     * Filter by shop
     */
    if( $shop ) {
      $filter_by_shop = array(
        'key'     => 'enseigne',
        'value'   => $shop
      );
      $meta_query[] = $filter_by_shop;
    }

    /**
     * Filter by city
     */
    if( $city ) {
      $filter_by_city = array(
        'key'     => 'ville',
        'value'   => $city
      ); 
      $meta_query[] = $filter_by_city;
    }

    if( count( $meta_query ) ) {
      $args['meta_query'] = $meta_query;
    }

    $query = new WP_Query( $args );

    if( $query->have_posts() ) {
      while( $query->have_posts() ) {
        $query->the_post();
        $enseigne = get_post( get_field( 'enseigne' ) );
        $description= get_post_field( 'description', $enseigne );
        $logo_id= get_post_field( 'logo', $enseigne );
        $logo_url = wp_get_attachment_url( $logo_id );
        $ville= get_term_by( 'term_id', get_field( 'ville' ), 'ville' );

        $output .= '<div class="col-md-6 col-lg-4">';
        $output .= '<div class="card border-0">';
        $output .= '<div class="card-header bg-primary text-white rounded-0">';
        $output .= '<h3 class="card-title mb-0">' . get_the_title() . '</h3>';
        $output .= '<div class="ref"><span class="font-weight-bold">REF</span> • ' .  get_field( 'reference' ) . '</div>';
        $output .= '</div>';
        $output .= '<div class="card-body rounded-0">';
        $output .= '<img src="' . $logo_url . '" alt="' . $enseigne->post_title . '" ' . 'class="mb-4">';
        $output .= '<h3 class="mb-4 font-weight-normal">' . $ville->name . '</h3>';
        $output .= '<div class="text-box">' . wp_trim_words( $description, 35 ) . '</div>';
        $output .= '<a href="' . get_the_permalink() . '" title="' . get_the_title() . '" class="btn px-0">Postuler</a>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
      }
    } else {
      $output .= '<p class="w-100 p-2 text-center">' . __( 'Aucun résultat à afficher.', 'loops' ) . '</p>';
    }
  }

  echo $output;

  wp_die();
}

add_action( 'wp_ajax_load_list_recrutement', 'loops_ajax_recrutement' );
add_action( 'wp_ajax_nopriv_load_list_recrutement', 'loops_ajax_recrutement' );