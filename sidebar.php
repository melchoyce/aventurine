<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package flat-writer
 */
?>

	<div id="secondary" class="widget-area container clear" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>
		<?php dynamic_sidebar( 'sidebar-1' ) ?>
	</div><!-- #secondary -->
