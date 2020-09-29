<?php
/**
 * The template for displaying image attachments.
 *
 * @package aventurine
 */

get_header(); ?>

	<div id="primary" class="content-area image-attachment">
		<main id="main" class="site-main" role="main">

		<?php 
		while ( have_posts() ) :
			the_post(); 
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-image">
					<?php echo wp_get_attachment_image( get_the_ID(), 'full' ); ?>
				</div>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<div class="entry-attachment">
						<?php if ( has_excerpt() ) : ?>
						<div class="entry-caption">
							<?php the_excerpt(); ?>
						</div><!-- .entry-caption -->
						<?php endif; ?>
					</div><!-- .entry-attachment -->

					<?php
						the_content();
						wp_link_pages(
							array(
								'before' => '<div class="page-links">' . __( 'Pages:', 'aventurine' ),
								'after'  => '</div>',
							) 
						);
					?>
				</div><!-- .entry-content -->

				<footer class="entry-meta">
					<?php
					$metadata = wp_get_attachment_metadata();
					/* Translators: 1: publish date, 2: image size */
					$meta_string = __( 'Published on %1$s at %2$s.', 'aventurine' );
					if ( $post->post_parent ) {
						/* Translators: 1: publish date, 2: image size, 3: parent post */
						$meta_string = __( 'Published on %1$s at %2$s in %3$s.', 'aventurine' );
					}
					printf(
						$meta_string,
						sprintf(
							'<span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span>',
							esc_attr( get_the_date( 'c' ) ),
							esc_html( get_the_date() )
						),
						sprintf(
							'<a href="%1$s">%2$s &times; %3$s</a>',
							esc_url( wp_get_attachment_url() ),
							$metadata['width'],
							$metadata['height']
						),
						sprintf(
							'<a href="%1$s" rel="gallery">%2$s</a>',
							esc_url( get_permalink( $post->post_parent ) ),
							get_the_title( $post->post_parent )
						)
					);

					edit_post_link( __( 'Edit', 'aventurine' ), ' <span class="edit-link">', '</span>' );
					?>
				</footer><!-- .entry-meta -->
			</article><!-- #post-## -->

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- #content -->
			<?php
			if ( comments_open() || '0' != get_comments_number() ) {
				comments_template();
			}
			?>

<div class="content-nav container">
	<nav role="navigation" id="image-navigation" class="image-navigation">
		<div class="nav-previous"><?php previous_image_link( false, __( 'Previous <span class="meta-nav">&rarr;</span>', 'aventurine' ) ); ?></div>
		<div class="nav-next"><?php next_image_link( false, __( '<span class="meta-nav">&larr;</span> Next', 'aventurine' ) ); ?></div>
	</nav><!-- #image-navigation -->
</div>

<?php endwhile; // end of the loop. ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
