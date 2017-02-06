<?php 
	 add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
	 function my_theme_enqueue_styles() { 
 		  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' ); 
 		  } 


//Registering Custom Taxonomy
add_action( 'init', 'create_genres_taxonomy' );

function create_genres_taxonomy() {
	register_taxonomy(
		'genres',
		'movies',
		array(
			'label' => 'Genres',
			'hierarchical' => true,
			'rewrite' => array(
				'slug' => 'genre'
			)
		)
	);
}


//Creating a function to create Custom Post Type
function custom_post_type() {
	$labels = array(
		'name'                => _x( 'Movies', 'Post Type General Name', 'twentythirteen' ),
		'singular_name'       => _x( 'Movie', 'Post Type Singular Name', 'twentythirteen' ),
		'menu_name'           => __( 'Movies', 'twentythirteen' ),
		'parent_item_colon'   => __( 'Parent Movie', 'twentythirteen' ),
		'all_items'           => __( 'All Movies', 'twentythirteen' ),
		'view_item'           => __( 'View Movie', 'twentythirteen' ),
		'add_new_item'        => __( 'Add New Movie', 'twentythirteen' ),
		'add_new'             => __( 'Add New', 'twentythirteen' ),
		'edit_item'           => __( 'Edit Movie', 'twentythirteen' ),
		'update_item'         => __( 'Update Movie', 'twentythirteen' ),
		'search_items'        => __( 'Search Movie', 'twentythirteen' ),
		'not_found'           => __( 'Not Found', 'twentythirteen' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'twentythirteen' ),
	);
	
	$args = array(
		'label'               => __( 'movies', 'twentythirteen' ),
		'description'         => __( 'Movie news and reviews', 'twentythirteen' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		'taxonomies'          => array( 'genres' ),	
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
	register_post_type( 'movies', $args );

}
add_action( 'init', 'custom_post_type', 0 );
?>