<?php

function loops_register_custom_post_type() {
  $labels = array(
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
  $args = array(
    'label' => __( 'collaborateur', 'loops' ),
    'description' => __( '', 'loops' ),
    'labels' => $labels,
    'menu_icon' => 'dashicons-groups',
    'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'post-formats'),
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
  
  register_post_type( 'equipe', $args );
}

add_action( 'init', 'loops_register_custom_post_type' );

?>
