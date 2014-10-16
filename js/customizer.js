/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a, .site-description, #colophon, #colophon a, #infinite-footer .container .blog-credits, #infinite-footer .container .blog-info, #infinite-footer .container a' ).css( {
				'color': to
			} );
		} );
	} );
	// Background color.
	wp.customize( 'background_color', function( value ) {
		value.bind( function( to ) {
			$( '#infinite-footer .container' ).css( {
				'background-color': to
			} );
		} );
	} );
} )( jQuery );
