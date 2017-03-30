<?php

if (is_admin() /*&& $_GET['post_type'] == 'movies'*/) {
	add_action( 'edit_form_after_title', 'movie_sub_title', 0 );
}

function movie_sub_title() {
    add_meta_box(
    	'movie_sub_title_metabox', 
    	'Edit Sub Title', 
    	'movie_sub_title_metabox_function', 
    	'movies', 
    	'normal', 
    	'high'
    );
    add_meta_box(
    	'movie_price_metabox', 
    	'Movie Price', 
    	'movie_price_metabox_function', 
    	'movies', 
    	'normal', 
    	'default'
    );
    add_meta_box( 
    	'ninja-meta', 
    	'Featured Movie Selector',
    	'ninja_movies_function', 
    	'movies', 
    	'normal', 
    	'default' 
    );
    //hidden product id
    add_meta_box( 
        'ninja_product_id', 
        'Product ID (just to display)',
        'ninja_product_id_function',
        'movies', 
        'normal', 
        'default' 
    );
}


function ninja_product_id_function( $post ) {
    global $post; ## global post object
    $ninja_product_id = get_post_meta( $post->ID, 'ninja_product_id', true );
    ?>
    <input type="text" disabled name="ninja_product_id" id="ninja_product_id" class="widefat" value="<?php if(isset($ninja_product_id)) { echo $ninja_product_id; } ?>" />
    <?php
}

function product_id_save_meta($post_id, $post) {
    global $post;

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return false; ## Block if doing autosave

    if ( !current_user_can( 'edit_post', $post->ID )) {
        return $post->ID; ## Block if user doesn't have priv
    }

    if($_POST['ninja_product_id']) {
        update_post_meta($post->ID, 'ninja_product_id', intval( $_POST['ninja_product_id'] ) );
    } 
    else {
        update_post_meta($post->ID, 'ninja_product_id', '');
    }

    return false;

}
add_action('save_post', 'product_id_save_meta', 1, 2);









function ninja_movies_function( $post ) {

    global $post; ## global post object
    // wp_nonce_field( plugin_basename( __FILE__ ), 'featured_movies_nonce' ); ## Create nonce
    //retrieve the meta data values if they exist
    $ninja_movies_featured = get_post_meta( $post->ID, 'ninja_movies_featured', true );
    echo 'Select yes below to make Movie featured';
    ?>
    <p>Featured: 
    <select name="ninja_movies_featured">
        <option value="no" <?php selected( $ninja_movies_featured, 'no' ); ?>>No</option>
        <option value="yes" <?php selected( $ninja_movies_featured, 'yes' ); ?>>Yes</option>
    </select>
    </p>
    <?php
}


function featured_movies_save_meta($post_id, $post) {
    global $post;

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return false; ## Block if doing autosave

    if ( !current_user_can( 'edit_post', $post->ID )) {
        return $post->ID; ## Block if user doesn't have priv
    }

    // if ( !wp_verify_nonce( $_POST['featured_movies_nonce'], plugin_basename(__FILE__) )) {


    // } else {
        if($_POST['ninja_movies_featured']) {

            update_post_meta($post->ID, 'ninja_movies_featured', sanitize_text_field( $_POST['ninja_movies_featured'] ) );
        } else {
            update_post_meta($post->ID, 'ninja_movies_featured', '');
        }
    // }

    return false;

}
add_action('save_post', 'featured_movies_save_meta', 1, 2);

// //hook to save the meta box data
// add_action( 'save_post', 'ninja_movies_save_meta' );
// function ninja_movies_save_meta( $post_ID ) {
//     global $post;
//     if( $post->post_type == "movies" ) {
//     if ( isset( $_POST ) ) {
//         update_post_meta( $post_ID, '_ninja_movies_featured', strip_tags( $_POST['ninja_movies_featured'] ) );
//     }
// }




function movie_sub_title_metabox_function() {

    global $post; ## global post object

    wp_nonce_field( plugin_basename( __FILE__ ), 'movie_sub_title_nonce' ); ## Create nonce

    $subtitle = get_post_meta($post->ID, 'movie_sub_title', true); ## Get the subtitle

    ?>
    <p>
        <label for="movie_sub_title">Sub Title</label>
        <input type="text" name="movie_sub_title" id="movie_sub_title" class="widefat" value="<?php if(isset($subtitle)) { echo $subtitle; } ?>" />
    </p>
    <?php
}

function movie_sub_title_save_meta($post_id, $post) {
    global $post;

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return false; ## Block if doing autosave

    if ( !current_user_can( 'edit_post', $post->ID )) {
        return $post->ID; ## Block if user doesn't have priv
    }

    if ( !wp_verify_nonce( $_POST['movie_sub_title_nonce'], plugin_basename(__FILE__) )) {


    } else {
        if($_POST['movie_sub_title']) {
            update_post_meta($post->ID, 'movie_sub_title', sanitize_text_field( $_POST['movie_sub_title'] ) );
        } else {
            update_post_meta($post->ID, 'movie_sub_title', '');
        }
    }

    return false;

}
add_action('save_post', 'movie_sub_title_save_meta', 1, 2);






function movie_price_metabox_function() {

    global $post, $ninja_price; ## global post object

    wp_nonce_field( plugin_basename( __FILE__ ), 'movie_price_nonce' ); ## Create nonce

    $ninja_price = get_post_meta($post->ID, 'movie_price', true); ## Get the subtitle

    ?>
    <p>
        <label for="movie_price">Movie Price</label>
        <input type="text" name="movie_price" id="movie_price" class="widefat" style="width:50px" value="<?php if(isset($ninja_price)) { echo $ninja_price; } ?>" />
    </p>
    <?php
}

function movie_price_save_meta($post_id, $post) {
    global $post;

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return false; ## Block if doing autosave

    if ( !current_user_can( 'edit_post', $post->ID )) {
        return $post->ID; ## Block if user doesn't have priv
    }

    if ( !wp_verify_nonce( $_POST['movie_price_nonce'], plugin_basename(__FILE__) )) {


    } else {
        if($_POST['movie_price']) {
            update_post_meta($post->ID, 'movie_price', floatval( $_POST['movie_price'] ) );
        } else {
            update_post_meta($post->ID, 'movie_price', '');
        }
    }

    return false;

}
add_action('save_post', 'movie_price_save_meta', 1, 2);



/*
add_action('the_content','rei_add_to_cart_button', 20, 1);

function rei_add_to_cart_button($content){
	global $post;
	if ($post->post_type !== 'movies') { return $content; }
	
	ob_start();


	$post_type = 'product';
	set_post_type( $post->ID, $post_type );
	?>
	<a rel="nofollow" href="/shop/?add-to-cart=<?php echo $post->ID; ?>" data-quantity="1" data-product_id="<?php echo $post->ID; ?>" data-product_sku="" class="button product_type_simple add_to_cart_button ajax_add_to_cart added">Add to cart</a>

	<form action="" method="post">
		<input name="add-to-cart" type="hidden" value="<?php echo $post->ID ?>" />
		<input name="quantity" type="number" value="1" min="1"  />
		<input name="submit" type="submit" value="Add to cart" />
	</form>
	<?php
	
	return $content . ob_get_clean();
}
*/


/* in templates

the_title();
$subtitle = get_post_meta(get_the_ID(), 'movie_sub_title', true);
if(isset($subtitle)) {
  echo $subtitle;
}

*/