<?php
/**
 * Aventurine Theme Customizer
 *
 * @package aventurine
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function aventurine_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	$wp_customize->add_setting( 'header_color' , array(
		'default'     => 'ffffff',
		'transport'   => 'postMessage',
		'sanitize_callback'    => 'sanitize_hex_color_no_hash',
		'sanitize_js_callback' => 'maybe_hash_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_color', array(
		'label'      => __( 'Header Color', 'aventurine' ),
		'section'    => 'colors',
		'settings'   => 'header_color',
	) ) );

}
add_action( 'customize_register', 'aventurine_customize_register' );

function aventurine_customize_css() {
	$header_color = get_theme_mod( 'header_color', 'ffffff' );
	?>
	<style type="text/css">
		.site-title a,
		.site-title a:hover,
		.site-title a:focus,
		.site-description,
		#colophon,
		#colophon a,
		#infinite-footer .container .blog-credits,
		#infinite-footer .container .blog-info,
		#infinite-footer .container a,
		#infinite-footer .container a:hover,
		#infinite-footer .container a:active,
		#infinite-footer .container a:focus {
			color: #<?php echo esc_attr( $header_color ); ?>;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'aventurine_customize_css' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function aventurine_customize_preview_js() {
	wp_enqueue_script( 'aventurine_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'aventurine_customize_preview_js' );
