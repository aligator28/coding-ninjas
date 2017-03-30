<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		if (get_post_meta( $post->ID, 'ninja_product_id', true ) != '') :
			$prod_id = get_post_meta( $post->ID, 'ninja_product_id', true );
	?>
				<button class="button cn-add-to-cart"><a href="/shop/?add-to-cart=<?php echo $prod_id; ?>">Add to cart</a></button>
	<?php
				endif;

		if ( is_sticky() && is_home() ) :
			echo twentyseventeen_get_svg( array( 'icon' => 'thumb-tack' ) );
		endif;
	?>
	<header class="entry-header">
		<?php
			if ( 'post' === get_post_type() ) :
				echo '<div class="entry-meta">';
					if ( is_single() ) :
						twentyseventeen_posted_on();
					else :
						echo twentyseventeen_time_link();
						twentyseventeen_edit_link();
					endif;
				echo '</div><!-- .entry-meta -->';
			endif;

			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

			$subtitle = get_post_meta(get_the_ID(), 'movie_sub_title', true);
			if(isset($subtitle)) {
			  echo '<h3>' . esc_html( $subtitle ) . '</h3>';
			}
		?>
	</header><!-- .entry-header -->

	<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'twentyseventeen-featured-image' ); ?>
			</a>

		</div><!-- .post-thumbnail -->
	<?php endif; ?>

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			if ( is_single() ) :
		
				the_content( sprintf(
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ),
					get_the_title()
				) );
			else:

				$content = get_the_content();
				echo wp_trim_words( strip_shortcodes( $content ), '15', $more = '...' );
			?>
				<a href="<?php the_permalink(); ?>">More</a>
			<?php

			endif;

			wp_link_pages( array(
				'before'      => '<div class="page-links">' . __( 'Pages:', 'twentyseventeen' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( is_single() ) : ?>
		<?php twentyseventeen_entry_footer(); ?>
	<?php endif; ?>

</article><!-- #post-## -->
