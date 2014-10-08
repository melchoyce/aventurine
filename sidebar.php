<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package aventurine
 */
?>

<?php if ( is_active_sidebar( 'sidebar-1' ) || is_active_sidebar( 'sidebar-2' ) ) : ?>
<div id="secondary" class="widget-area container clear" role="complementary">

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div class="column">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
	<?php endif; // end sidebar widget area ?>

	<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
	<div class="column">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</div>
	<?php endif; // end sidebar widget area ?>

</div><!-- #secondary -->
<?php endif; ?>
