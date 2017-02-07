<?php 
	 add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
	 function my_theme_enqueue_styles() { 
 		  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' ); 
 		  } 

// Making sure the theme support Woocommerce
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

// //Registering Custom Taxonomy
// add_action( 'init', 'create_genres_taxonomy' );

// function create_genres_taxonomy() {
// 	register_taxonomy(
// 		'genres',
// 		'movies',
// 		array(
// 			'label' => 'Genres',
// 			'hierarchical' => true,
// 			'rewrite' => array(
// 				'slug' => 'genre'
// 			)
// 		)
// 	);
// }


//Creating a function to create Custom Post Type
// function custom_post_type() {
// 	$labels = array(
// 		'name'                => _x( 'Movies', 'Post Type General Name', 'twentyseventeen' ),
// 		'singular_name'       => _x( 'Movie', 'Post Type Singular Name', 'twentyseventeen' ),
// 		'menu_name'           => __( 'Movies', 'twentyseventeen' ),
// 		'parent_item_colon'   => __( 'Parent Movie', 'twentyseventeen' ),
// 		'all_items'           => __( 'All Movies', 'twentyseventeen' ),
// 		'view_item'           => __( 'View Movie', 'twentyseventeen' ),
// 		'add_new_item'        => __( 'Add New Movie', 'twentyseventeen' ),
// 		'add_new'             => __( 'Add New', 'twentyseventeen' ),
// 		'edit_item'           => __( 'Edit Movie', 'twentyseventeen' ),
// 		'update_item'         => __( 'Update Movie', 'twentyseventeen' ),
// 		'search_items'        => __( 'Search Movie', 'twentyseventeen' ),
// 		'not_found'           => __( 'Not Found', 'twentyseventeen' ),
// 		'not_found_in_trash'  => __( 'Not found in Trash', 'twentyseventeen' ),
// 	);
	
// 	$args = array(
// 		'label'               => __( 'movies', 'twentyseventeen' ),
// 		'description'         => __( 'Movie news and reviews', 'twentyseventeen' ),
// 		'labels'              => $labels,
// 		'supports'            => array( 'title', 'editor', 'thumbnail', ),
// 		'taxonomies'          => array( 'genres' ),	
// 		'hierarchical'        => false,
// 		'public'              => true,
// 		'show_ui'             => true,
// 		'show_in_menu'        => true,
// 		'show_in_nav_menus'   => true,
// 		'show_in_admin_bar'   => true,
// 		'menu_position'       => 5,
// 		'can_export'          => true,
// 		'has_archive'         => true,
// 		'exclude_from_search' => false,
// 		'publicly_queryable'  => true,
// 		'capability_type'     => 'page',
// 	);
// 	register_post_type( 'movies', $args );

// }
// add_action( 'init', 'custom_post_type', 0 );

// Adding custom post type which is product 
if ( post_type_exists('product') )
    return;

do_action( 'woocommerce_register_post_type' );

$permalinks        = get_option( 'woocommerce_permalinks' );
$product_permalink = empty( $permalinks['product_base'] ) ? _x( 'product', 'slug', 'woocommerce' ) : $permalinks['product_base'];

register_post_type( "product",
    apply_filters( 'woocommerce_register_post_type_product',
        array(
            'labels' => array(
                    'name'                  => __( 'Movies', 'woocommerce' ),
                    'singular_name'         => __( 'Movie', 'woocommerce' ),
                    'menu_name'             => _x( 'Movies', 'Admin menu name', 'woocommerce' ),
                    'add_new'               => __( 'Add Movie', 'woocommerce' ),
                    'add_new_item'          => __( 'Add New Movie', 'woocommerce' ),
                    'edit'                  => __( 'Edit', 'woocommerce' ),
                    'edit_item'             => __( 'Edit Movie', 'woocommerce' ),
                    'new_item'              => __( 'New Movie', 'woocommerce' ),
                    'view'                  => __( 'View Movie', 'woocommerce' ),
                    'view_item'             => __( 'View Movie', 'woocommerce' ),
                    'search_items'          => __( 'Search Movies', 'woocommerce' ),
                    'not_found'             => __( 'No Movies found', 'woocommerce' ),
                    'not_found_in_trash'    => __( 'No Movies found in trash', 'woocommerce' ),
                    'parent'                => __( 'Parent Movie', 'woocommerce' )
                ),
            'description'           => __( 'This is where you can add new movie to your store.', 'woocommerce' ),
            'public'                => true,
            'show_ui'               => true,
            'capability_type'       => 'product',
            'map_meta_cap'          => true,
            'publicly_queryable'    => true,
            'exclude_from_search'   => false,
            'hierarchical'          => false, // Hierarchical causes memory issues - WP loads all records!
            'rewrite'               => $product_permalink ? array( 'slug' => untrailingslashit( $product_permalink ), 'with_front' => false, 'feeds' => true ) : false,
            'query_var'             => true,
            'supports'              => array( 'title', 'editor', 'thumbnail' ),
            'has_archive'           => ( $shop_page_id = wc_get_page_id( 'shop' ) ) && get_page( $shop_page_id ) ? get_page_uri( $shop_page_id ) : 'shop',
            'show_in_nav_menus'     => true
        )
    )
);
// Getting rid of extra option
add_filter('woocommerce_product_data_tabs', function($tabs) {
    unset($tabs['shipping']);
    unset($tabs['inventory']);
    unset($tabs['attribute']);
    unset($tabs['variations']);
    unset($tabs['advanced']);
    return $tabs;
}, 10, 1);
// Changing default options
function wc_product_type_options( $product_type_options ) {
    $product_type_options['virtual']['default'] = 'yes';
    $product_type_options['downloadable']['default'] = 'yes';
    return $product_type_options;
}
add_filter( 'product_type_options', 'wc_product_type_options' );

/* Customize Product Genres Labels */
add_filter( 'woocommerce_taxonomy_args_product_cat', 'custom_wc_taxonomy_args_product_cat' );
function custom_wc_taxonomy_args_product_cat( $args ) {
	$args['label'] = __( 'Product Genres', 'woocommerce' );
	$args['labels'] = array(
        'name' 				=> __( 'Product Genres', 'woocommerce' ),
        'singular_name' 	=> __( 'Product Genre', 'woocommerce' ),
        'menu_name'			=> _x( 'Genres', 'Admin menu name', 'woocommerce' ),
        'search_items' 		=> __( 'Search Product Genres', 'woocommerce' ),
        'all_items' 		=> __( 'All Product Genres', 'woocommerce' ),
        'parent_item' 		=> __( 'Parent Product Genre', 'woocommerce' ),
        'parent_item_colon' => __( 'Parent Product Genre:', 'woocommerce' ),
        'edit_item' 		=> __( 'Edit Product Genre', 'woocommerce' ),
        'update_item' 		=> __( 'Update Product Genre', 'woocommerce' ),
        'add_new_item' 		=> __( 'Add New Product Genre', 'woocommerce' ),
        'new_item_name' 	=> __( 'New Product Genre Name', 'woocommerce' )
	);

	return $args;
}

// Skip the cart step 
add_filter('woocommerce_add_to_cart_redirect', 'twentyseventeen_add_to_cart_redirect');
function twentyseventeen_add_to_cart_redirect() {
 global $woocommerce;
 $checkout_url = $woocommerce->cart->get_checkout_url();
 return $checkout_url;
}

//Remove some fields from billing form
function wpb_custom_billing_fields( $fields = array() ) {
 unset($fields['billing_company']);
 unset($fields['billing_address_1']);
 unset($fields['billing_address_2']);
 unset($fields['billing_state']);
 unset($fields['billing_city']);
 unset($fields['billing_phone']);
 unset($fields['billing_postcode']);
 unset($fields['billing_country']);
 return $fields;
}
add_filter('woocommerce_billing_fields','wpb_custom_billing_fields');

// After registration edirect to featured product page
function custom_registration_redirect() {
    return home_url('/featured-movies/');
}
add_action('woocommerce_registration_redirect', 'custom_registration_redirect', 2);


// Add new field to registration form
// add_action( 'woocommerce_register_form_start', 'my_custom_checkout_field' );

// function my_custom_checkout_field( $checkout ) {
//     /* Skype */
//     woocommerce_form_field( 'weight_customer', array(
//         'type'          => 'text',
//         'class'         => array('skype form-row-wide'),
//         'label'         => __('Skype'),
//         'placeholder'   => __(''),
//     ), get_user_meta(  get_current_user_id(),'Skype username' , true  ) );
// }

// //Verification 
// add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');

// function my_custom_checkout_field_process() {
//     // Check 
//     if ( ! $_POST['skype'] )
//         wc_add_notice( __( 'Do not forget Skype.' ), 'error' );
// }

// //Update field
// add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );

// function my_custom_checkout_field_update_order_meta( $order_id ) {
//     if ( ! empty( $_POST['skype'] ) ) {
//         update_user_meta( get_current_user_id(), 'skype', sanitize_text_field( $_POST['skype'], '' ));
//     }
// }


function wooc_extra_register_fields() {
    ?>

    <p class="form-row form-row-wide">
    <label for="reg_billing_skype"><?php _e( 'Skype', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
    </p>

    <?php
}

add_action( 'woocommerce_register_form_start', 'wooc_extra_register_fields' );

/**
 * Validate the extra register fields.
 *
 * @param  string $username          Current username.
 * @param  string $email             Current email.
 * @param  object $validation_errors WP_Error object.
 *
 * @return void
 */
function wooc_validate_extra_register_fields( $username, $email, $validation_errors ) {
    if ( isset( $_POST['billing_skype'] ) && empty( $_POST['billing_skype'] ) ) {
        $validation_errors->add( 'billing_skype_error', __( 'You have to put your skype username.', 'woocommerce' ) );
    }
}

add_action( 'woocommerce_register_post', 'wooc_validate_extra_register_fields', 10, 3 );

/**
 * Save the extra register fields.
 *
 * @param  int  $customer_id Current customer ID.
 *
 * @return void
 */
function wooc_save_extra_register_fields( $customer_id ) {
    if ( isset( $_POST['billing_skype'] ) ) {
        // WooCommerce billing first name.
        update_user_meta( $customer_id, 'billing_skype', sanitize_text_field( $_POST['billing_skype'] ) );
    }
}

add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields' );