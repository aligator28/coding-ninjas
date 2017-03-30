<?php

// get_post_meta( $post->ID, 'ninja_movies_featured', true )


function my_template() {
    $args = array(
        'post_type' => 'movies',
        'meta_query' => array(
            array(
                'key' => 'ninja_movies_featured',
                'value' => 'yes',
                'compare' => 'LIKE'
            )
        )
     );
    global $featured_movies_query;
    $featured_movies_query = new WP_Query( $args );

    global $post;
    if ( $post->post_type == 'movies' && isset($_GET['featured']) ) 
    {
        get_template_part( 'template-parts/movies/content', 'featured-movies-main' );
        exit();
    }
}
add_action('template_redirect', 'my_template');

