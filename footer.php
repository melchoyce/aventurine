<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package flat-writer
 */
?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info container">
			<?php do_action( 'flat_writer_credits' ); ?>
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'flat-writer' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'flat-writer' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'flat-writer' ), 'flat writer', '<a href="http://underscores.me/" rel="designer">Underscores.me</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>