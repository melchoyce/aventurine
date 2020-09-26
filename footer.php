<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package aventurine
 */

?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info container">
			<?php do_action( 'aventurine_credits' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
