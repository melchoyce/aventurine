<?php
/**
 * @package aventurine
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
		<a class="read-more" href="<?php echo get_permalink(); ?>">read more<span class="screen-reader-text"> about <?php the_title(); ?></span></a>
	</div><!-- .entry-summary -->
</article><!-- #post-## -->
