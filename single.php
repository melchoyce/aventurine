<?php
/**
 * The Template for displaying all single posts.
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

			<?php get_template_part( 'content', 'single' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

</div><!-- #content -->

			<?php
			if ( comments_open() || '0' != get_comments_number() ) {
				comments_template();
			}
			?>

		<div class="content-nav container">
			<?php aventurine_content_nav( 'nav-below' ); ?>
		</div>

<?php endwhile; // end of the loop. ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
