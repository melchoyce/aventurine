/**
 * animations.js
 *
 * Adds a class to the site title on load to create an animation
 */
( function( $ ) {

	var header = document.getElementById("masthead");

	$( document ).ready(function(){
		$( header ).addClass('animate');
	});

} )( jQuery );
