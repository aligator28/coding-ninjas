<?php 
/*
	This function duplicate Movie custom post types
	to WooCommerce as a product
*/

add_action('save_post','save_post_callback', 10, 2);
add_action('publish_post','save_post_callback', 10, 2);

function save_post_callback($post_id, $post) {

    global $post; 
    if ($post->post_type != 'movies') { return; }

    //if you get here then it's your post type so do your thing....

	$parent_term = term_exists( 'movies', 'product' ); // array is returned if taxonomy is given
	$parent_term_id = $parent_term['term_id']; // get numeric term id
	wp_insert_term(
	  'Movies', // the term 
	  'product', // the taxonomy
	  array(
	    'description'=> 'Category for movies',
	    'slug' => 'movies',
	    'parent'=> $parent_term_id
	  )
	);


    $movie_post = $post;
	
	// prepare data to create new product
	$post = array(
	    'post_author' => $movie_post->post_author,
	    'post_content' => $movie_post->post_content,
	    'post_status' => "publish",
	    'post_title' => $movie_post->post_title,
	    'post_parent' => '',
	    'post_type' => "product",
	);

	// get product id if exitsts
	$product_movie_id = intval( $_POST['ninja_product_id'] );
	$movie_price = floatval( $_POST['movie_price'] );


	//check if such product already exists
	if ( empty( $product_movie_id ) ) {
		//Create new product
		$post_id = wp_insert_post( $post, $wp_error );
		
		//get current product id to store for movie item metabox
		update_post_meta($movie_post->ID, 'ninja_product_id', $post_id);
	}
	else {
		$post_id = $product_movie_id;
	}


// var_dump( $post_id );
// exit();

	if($post_id){
	    $attach_id = get_post_meta($product->parent_id, "_thumbnail_id", true);
	    add_post_meta($post_id, '_thumbnail_id', $attach_id);
	}

	wp_set_object_terms( $post_id, 'Movies', 'product_cat' );
	wp_set_object_terms($post_id, 'simple', 'product_type');

	update_post_meta( $post_id, '_visibility', 'visible' );
	update_post_meta( $post_id, '_stock_status', 'instock');
	update_post_meta( $post_id, 'total_sales', '0');
	update_post_meta( $post_id, '_downloadable', 'yes');
	update_post_meta( $post_id, '_virtual', 'yes');
	update_post_meta( $post_id, '_regular_price', $movie_price );
	update_post_meta( $post_id, '_sale_price', "" );
	update_post_meta( $post_id, '_purchase_note', "" );
	update_post_meta( $post_id, '_featured', "no" );
	update_post_meta( $post_id, '_weight', "" );
	update_post_meta( $post_id, '_length', "" );
	update_post_meta( $post_id, '_width', "" );
	update_post_meta( $post_id, '_height', "" );
	update_post_meta($post_id, '_sku', "");
	update_post_meta( $post_id, '_product_attributes', array());
	update_post_meta( $post_id, '_sale_price_dates_from', "" );
	update_post_meta( $post_id, '_sale_price_dates_to', "" );
	update_post_meta( $post_id, '_price', $movie_price );
	update_post_meta( $post_id, '_sold_individually', "" );
	update_post_meta( $post_id, '_manage_stock', "no" );
	update_post_meta( $post_id, '_backorders', "no" );
	update_post_meta( $post_id, '_stock', "" );

	// file paths will be stored in an array keyed off md5(file path)
	// $downdloadArray =array('name'=>"Test", 'file' => $uploadDIR['baseurl']."/video/".$video);

	// $file_path =md5($uploadDIR['baseurl']."/video/".$video);


	// $_file_paths[  $file_path  ] = $downdloadArray;
	// grant permission to any newly added files on any existing orders for this product
	// do_action( 'woocommerce_process_product_file_download_paths', $post_id, 0, $downdloadArray );
	// update_post_meta( $post_id, '_downloadable_files', $_file_paths);
	update_post_meta( $post_id, '_download_limit', '');
	update_post_meta( $post_id, '_download_expiry', '');
	update_post_meta( $post_id, '_download_type', '');
	update_post_meta( $post_id, '_product_image_gallery', '');	
}