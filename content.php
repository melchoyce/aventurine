<?php
/**
 * Fallback template for content.
 *
 * @package aventurine
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>

		<a class="read-more" href="<?php echo get_permalink(); ?>">
		<?php
			/* Translators: %s: post title. */
			printf( __( 'continue reading %s', 'aventurine' ), '<span class="screen-reader-text">' . get_the_title() . '</span>' );
		?>
		</a>
	</div><!-- .entry-summary -->
</article><!-- #post-## -->
