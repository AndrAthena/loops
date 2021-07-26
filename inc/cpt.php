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
    'label'               => __( 'Collaborateur', 'loops' ),
    'description'         => __( '', 'loops' ),
    'labels'              => $labels_collab,
    'menu_icon'           => 'dashicons-groups',
    'supports'            => array('title', 'editor', 'excerpt', 'thumbnail', 'post-formats', 'custom-fields', 'page-attributes'),
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'menu_position'       => 5,
    'show_in_admin_bar'   => true,
    'show_in_nav_menus'   => true,
    'can_export'          => true,
    'has_archive'         => false,
    'hierarchical'        => false,
    'exclude_from_search' => false,
    'show_in_rest'        => true,
    'publicly_queryable'  => true,
    'capability_type'     => 'post',
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
    'label'               => __( 'Enseigne', 'loops' ),
    'description'         => __( '', 'loops' ),
    'labels'              => $labels_enseigne,
    'menu_icon'           => 'dashicons-admin-site-alt3',
    'supports'            => array('title', 'editor', 'excerpt', 'thumbnail', 'post-formats', 'custom-fields', 'page-attributes'),
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'menu_position'       => 5,
    'show_in_admin_bar'   => true,
    'show_in_nav_menus'   => true,
    'can_export'          => true,
    'has_archive'         => false,
    'hierarchical'        => false,
    'exclude_from_search' => false,
    'show_in_rest'        => true,
    'publicly_queryable'  => true,
    'capability_type'     => 'post',
    'rewrite'             => array( 'slug' => 'nos-enseignes' ),
    'taxonomies'          => array('ville')
  );
  register_post_type( 'enseigne', $args_enseigne );
  
  $labels_metier = array(
    'name' => __( 'Métiers', 'loops' ),
    'singular_name' => __( 'Métier', 'loops' ),
    'menu_name' => __( 'Métier', 'loops' ),
    'name_admin_bar' => __( 'Métier', 'loops' ),
    'all_items' => __( 'Tous les métiers', 'loops' ),
    'add_new_item' => __( 'Ajouter nouveau métier', 'loops' ),
    'add_new' => __( 'Ajouter', 'loops' ),
    'new_item' => __( 'Nouveau métier', 'loops' ),
    'edit_item' => __( 'Modifier métier', 'loops' ),
    'view_item' => __( 'Voir métier', 'loops' ),
    'view_items' => __( 'Voir métiers', 'loops' ),
    'search_items' => __( 'Rechercher dans les métiers', 'loops' ),
    'not_found' => __( 'Aucun métier trouvé.', 'loops' ),
    'not_found_in_trash' => __( 'Aucun métier trouvé dans la corbeille.', 'loops' ),
    );
  $args_metier = array(
    'label'               => __( 'Métier', 'loops' ),
    'labels'              => $labels_metier,
    'description'         => __( '', 'loops' ),
    'menu_icon'           => 'dashicons-businesswoman',
    'supports'            => array('title', 'editor', 'excerpt', 'thumbnail', 'post-formats', 'custom-fields', 'page-attributes'),
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'menu_position'       => 5,
    'show_in_admin_bar'   => true,
    'show_in_nav_menus'   => true,
    'can_export'          => true,
    'has_archive'         => false,
    'hierarchical'        => false,
    'exclude_from_search' => false,
    'show_in_rest'        => true,
    'publicly_queryable'  => true,
    'capability_type'     => 'post',
    'rewrite'             => array( 'slug' => 'quelles-carrieres-chez-nous' )
  );
  register_post_type( 'metier', $args_metier );

  $labels_recrutement = array(
    'name' => __( 'Recrutement', 'loops' ),
    'singular_name' => __( 'Recrutement', 'loops' ),
    'menu_name' => __( 'Recrutement', 'loops' ),
    'name_admin_bar' => __( 'Recrutement', 'loops' ),
    'all_items' => __( 'Tous les recrutements', 'loops' ),
    'add_new_item' => __( 'Ajouter nouveau recrutement', 'loops' ),
    'add_new' => __( 'Ajouter', 'loops' ),
    'new_item' => __( 'Nouveau recrutement', 'loops' ),
    'edit_item' => __( 'Modifier recrutement', 'loops' ),
    'view_item' => __( 'Voir recrutement', 'loops' ),
    'view_items' => __( 'Voir recrutements', 'loops' ),
    'search_items' => __( 'Rechercher dans les recrutements', 'loops' ),
    'not_found' => __( 'Aucun recrutement trouvé.', 'loops' ),
    'not_found_in_trash' => __( 'Aucun recrutement trouvé dans la corbeille.', 'loops' ),
    );
  $args_recrutement = array(
    'label'               => __( 'Recrutement', 'loops' ),
    'labels'              => $labels_recrutement,
    'description'         => __( '', 'loops' ),
    'menu_icon'           => 'dashicons-businesswoman',
    'supports'            => array('title', 'editor', 'excerpt', 'thumbnail', 'post-formats', 'custom-fields', 'page-attributes'),
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'menu_position'       => 5,
    'show_in_admin_bar'   => true,
    'show_in_nav_menus'   => true,
    'can_export'          => true,
    'has_archive'         => false,
    'hierarchical'        => false,
    'exclude_from_search' => false,
    'show_in_rest'        => true,
    'publicly_queryable'  => true,
    'capability_type'     => 'post',
    'rewrite'             => array( 'slug' => 'recrutement' ),
  );
  register_post_type( 'recrutement', $args_recrutement );
}

function loops_register_taxonomy() {
  $args = array(
    'labels'            => array(
      'name'            => __('Villes', 'loops'),
      'singular_name'   => __('Ville', 'loops'),
      'search_items'    => __('Villes', 'loops'),
    ),
    'public'            => true,
    'show_ui'           => true,
    'show_in_rest'      => true,
    'show_in_menu'      => true,
    'show_admin_column' => true
  );
  register_taxonomy( 'ville', 'enseigne', $args );
}

function init_hook() {
  loops_register_custom_post_type();
  loops_register_taxonomy();
}

add_action( 'init', 'init_hook' );

?>
