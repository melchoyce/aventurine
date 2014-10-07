<?php
/**
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
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'aventurine' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php aventurine_posted_on(); ?>
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'aventurine' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'aventurine' ) );

			if ( ! aventurine_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( ' with tags %2$s.', 'aventurine' );
				} else {
					$meta_text = '';
				}
			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( ' in %1$s with tags %2$s.', 'aventurine' );
				} else {
					$meta_text = __( ' in %1$s.', 'aventurine' );
				}
			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list
			);
		?>

		<?php edit_post_link( __( 'Edit', 'aventurine' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
