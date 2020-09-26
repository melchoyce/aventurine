<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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

				<?php get_template_part( 'content', 'page' ); ?>

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
