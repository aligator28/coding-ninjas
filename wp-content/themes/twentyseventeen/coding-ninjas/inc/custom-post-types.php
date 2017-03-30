<?php


function coding_ninjas_custom_post_type() {

// Set UI labels for Custom Post Type
  $labels = array(
    'name'                => _x( 'Movies', 'Post Type General Name', 'twentyseventeen' ),
    'singular_name'       => _x( 'Movie', 'Post Type Singular Name', 'twentyseventeen' ),
    'menu_name'           => __( 'Movies', 'twentyseventeen' ),
    'all_items'           => __( 'All Movies', 'twentyseventeen' ),
    'view_item'           => __( 'View Movie', 'twentyseventeen' ),
    'add_new_item'        => __( 'Add New Movie', 'twentyseventeen' ),
    'add_new'             => __( 'Add New', 'twentyseventeen' ),
    'edit_item'           => __( 'Edit Movie', 'twentyseventeen' ),
    'update_item'         => __( 'Update Movie', 'twentyseventeen' ),
    'search_items'        => __( 'Search Movie', 'twentyseventeen' ),
    'not_found'           => __( 'Not Found', 'twentyseventeen' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'twentyseventeen' ),
  );
  
// Set other options for Custom Post Type
  $args = array(
    'label'               => __( 'movies', 'twentyseventeen' ),
    'description'         => __( 'Movie news and reviews', 'twentyseventeen' ),
    'labels'              => $labels,
    'menu_icon'           => 'dashicons-tickets-alt',
    // Features this CPT supports in Post Editor
    'supports'            => array( 
      'title', 
      'editor', 
      // 'excerpt', 
      // 'author', 
      'thumbnail', 
      // 'comments', 
      // 'revisions', 
      // 'custom-fields', 
      ),
    // You can associate this CPT with a taxonomy or custom taxonomy. 
    'taxonomies'          => array( 'category', 'featured' ),
    /* A hierarchical CPT is like Pages and can have
    * Parent and child items. A non-hierarchical CPT
    * is like Posts.
    */  
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 5,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'page',
  );
  
  // Registering your Custom Post Type
  register_post_type( 'movies', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/

add_action( 'init', 'coding_ninjas_custom_post_type', 0 );
