<?php
/**
 * flat-writer Theme Customizer
 *
 * @package flat-writer
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function flat_writer_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	$wp_customize->add_setting( 'header_color' , array(
	    'default'     => '#ffffff',
	    'transport'   => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_color', array(
		'label'        => __( 'Header Color', 'mytheme' ),
		'section'    => 'colors',
		'settings'   => 'header_color',
	) ) );

}
add_action( 'customize_register', 'flat_writer_customize_register' );

function flat_writer_customize_css() {
    ?>
         <style type="text/css">
             .site-title a,
             .site-title a:hover,
             .site-description,
             #colophon,
             #colophon a { color:<?php echo get_theme_mod('header_color'); ?>; }
         </style>
    <?php
}
add_action( 'wp_head', 'flat_writer_customize_css');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function flat_writer_customize_preview_js() {
	wp_enqueue_script( 'flat_writer_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'flat_writer_customize_preview_js' );
