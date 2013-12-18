<?php
/**
 * @package flat-writer
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
		<a class="read-more" href="<?php echo get_permalink(); ?>">read more<span class="screen-reader-text"> about <?php the_title(); ?></span></a>
	</div><!-- .entry-summary -->
</article><!-- #post-## -->
