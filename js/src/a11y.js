/**
 * a11y.js
 *
 * Handles toggling a focus/blur state on dropdowns for keyboard nav
 */
( function( $ ) {
	// make dropdowns functional on focus
	var navigation;

	navigation = document.querySelectorAll( '.main-navigation a' );
	if ( navigation.length === 0 ) {
		return;
	}

	$( navigation ).on( 'focus blur', function() {
		$( this ).parents('li').toggleClass( 'focus' );
	});

} )( jQuery );
