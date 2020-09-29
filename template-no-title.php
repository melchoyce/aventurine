<?php
/**
 * Template Name: No Title
 * Template Post Type: post, page
 *
 * When selected, this page template will not output a page title. It's up to
 * the content to set an appropriate header.
 *
 * @package aventurine
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php 
			while ( have_posts() ) :
				the_post(); 
				?>

				<?php get_template_part( 'content', 'no-title' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

</div><!-- #content -->

				<?php
				if ( comments_open() || '0' != get_comments_number() ) {
					comments_template();
				}
				?>

<?php endwhile; // end of the loop. ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
