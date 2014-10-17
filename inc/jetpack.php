<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package aventurine
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function aventurine_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'content',
	) );
}
add_action( 'after_setup_theme', 'aventurine_jetpack_setup' );

/**
 * Credits
 */
function aventurine_infinite_scroll_credit( $credits ) {
	$credits = '<a href="http://wordpress.org/" rel="generator">' . sprintf( __( 'Proudly powered by %s', 'aventurine' ), 'WordPress' ) . '</a>';
	$credits .= '<span class="sep"> | </span>';
	$credits .= '<a href="http://themes.redradar.net/">' . sprintf( __( 'Theme: %1$s', 'aventurine' ), 'Aventurine' ) . '</a>';

	return $credits;
}
add_filter( 'infinite_scroll_credit', 'aventurine_infinite_scroll_credit' );

/**
 * Add background color to infinite scroll element
 */
function aventurine_background_style() {
	$color = get_background_color();

	if ( ! $color ){
		return;
	}

	printf( '<style type="text/css">#infinite-footer .container { background-color: #%s; }</style>', esc_attr( $color ) );
}
add_action( 'wp_head', 'aventurine_background_style' );
