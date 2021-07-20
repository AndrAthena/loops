<?php

function loops_register_custom_post_type() {
  $labels_collab = array(
    'name' => __( 'Collaborateurs', 'loops' ),
    'singular_name' => __( 'Collaborateur', 'loops' ),
    'menu_name' => __( 'Collaborateur', 'loops' ),
    'name_admin_bar' => __( 'Collaborateur', 'loops' ),
    'all_items' => __( 'Tous les collaborateurs', 'loops' ),
    'add_new_item' => __( 'Ajouter nouveau collaborateur', 'loops' ),
    'add_new' => __( 'Ajouter', 'loops' ),
    'new_item' => __( 'Nouveau collaborateur', 'loops' ),
    'edit_item' => __( 'Modifier collaborateur', 'loops' ),
    'view_item' => __( 'Voir collaborateur', 'loops' ),
    'view_items' => __( 'Voir collaborateurs', 'loops' ),
    'search_items' => __( 'Rechercher dans les collaborateurs', 'loops' ),
    'not_found' => __( 'Aucun collaborateur trouvé.', 'loops' ),
    'not_found_in_trash' => __( 'Aucun collaborateur trouvé dans la corbeille.', 'loops' ),
    );
  $args_collab = array(
    'label' => __( 'collaborateur', 'loops' ),
    'description' => __( '', 'loops' ),
    'labels' => $labels_collab,
    'menu_icon' => 'dashicons-groups',
    'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'post-formats', 'custom-fields'),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'can_export' => true,
    'has_archive' => true,
    'hierarchical' => false,
    'exclude_from_search' => false,
    'show_in_rest' => true,
    'publicly_queryable' => true,
    'capability_type' => 'post',
  );
  
  register_post_type( 'collaborateur', $args_collab );
  
  $labels_enseigne = array(
    'name' => __( 'Enseignes', 'loops' ),
    'singular_name' => __( 'Enseigne', 'loops' ),
    'menu_name' => __( 'Enseigne', 'loops' ),
    'name_admin_bar' => __( 'Enseigne', 'loops' ),
    'all_items' => __( 'Tous les enseignes', 'loops' ),
    'add_new_item' => __( 'Ajouter nouveau enseigne', 'loops' ),
    'add_new' => __( 'Ajouter', 'loops' ),
    'new_item' => __( 'Nouveau enseigne', 'loops' ),
    'edit_item' => __( 'Modifier enseigne', 'loops' ),
    'view_item' => __( 'Voir enseigne', 'loops' ),
    'view_items' => __( 'Voir enseignes', 'loops' ),
    'search_items' => __( 'Rechercher dans les enseignes', 'loops' ),
    'not_found' => __( 'Aucun enseigne trouvé.', 'loops' ),
    'not_found_in_trash' => __( 'Aucun enseigne trouvé dans la corbeille.', 'loops' ),
    );
  $args_enseigne = array(
    'label' => __( 'enseigne', 'loops' ),
    'description' => __( '', 'loops' ),
    'labels' => $labels_enseigne,
    'menu_icon' => 'dashicons-admin-site-alt3',
    'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'post-formats', 'custom-fields'),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'can_export' => true,
    'has_archive' => true,
    'hierarchical' => false,
    'exclude_from_search' => false,
    'show_in_rest' => true,
    'publicly_queryable' => true,
    'capability_type' => 'post',
    'rewrite' => array( 'slug' => 'nos-enseignes' )
  );
  
  register_post_type( 'enseigne', $args_enseigne );
}

add_action( 'init', 'loops_register_custom_post_type' );

?>
