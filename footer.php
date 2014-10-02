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
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'aventurine' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'aventurine' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'aventurine' ), 'Aventurine', '<a href="http://themes.redradar.net/" rel="designer">Kelly&nbsp;Dwan &amp; Mel&nbsp;Choyce</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>