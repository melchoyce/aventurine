<?php
/**
 * The template used for displaying single post content.
 *
 * @package aventurine
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-image">
		<?php the_post_thumbnail( 'full' ); ?>
		</div>
	<?php endif; ?>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'aventurine' ),
					'after'  => '</div>',
				) 
			);
			?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php aventurine_get_post_details(); ?>
		<?php edit_post_link( __( 'Edit', 'aventurine' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
