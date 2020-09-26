<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package aventurine
 */

/**
 * Filter image attachment links to include an anchor to the main content.
 *
 * @param string $link    The attachment's permalink.
 * @param int    $post_id Attachment ID.
 */
function aventurine_enhanced_image_navigation( $link, $post_id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $post_id ) ) {
		return $link;
	}

	$image = get_post( $post_id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $post_id ) {
		$link .= '#main';
	}

	return $link;
}
add_filter( 'attachment_link', 'aventurine_enhanced_image_navigation', 10, 2 );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function aventurine_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() ) {
		return $title;
	}

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'aventurine' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'aventurine_wp_title', 10, 2 );

/**
 * Unset the website field, Remove the required *
 *
 * @param string[] $fields Array of the default comment fields.
 */
function aventurine_comment_fields( $fields ) {
	$commenter = wp_get_current_commenter();
	unset( $fields['url'] );
	$fields['author'] = sprintf(
		'<p class="comment-form-author"><label for="author">%1$s</label> <input id="author" name="author" type="text" value="%2$s" size="30" aria-required="true" placeholder="%1$s" /></p>',
		__( 'Name', 'aventurine' ),
		esc_attr( $commenter['comment_author'] )
	);

	$fields['email'] = sprintf(
		'<p class="comment-form-email"><label for="email">%1$s</label><input id="email" name="email" type="email" value="%2$s" size="30" aria-required="true" placeholder="%1$s" /></p>',
		__( 'Email', 'aventurine' ),
		esc_attr( $commenter['comment_author_email'] )
	);

	return $fields;
}
add_filter( 'comment_form_default_fields', 'aventurine_comment_fields' );

/**
 * Print out credits.
 */
function aventurine_show_credits() {
	?>
	<a href="http://wordpress.org/" rel="generator">
	<?php
		/* translators: %s: WordPress. */
		printf( __( 'Proudly powered by %s', 'aventurine' ), 'WordPress' );
	?>
	</a>
	<span class="sep"> | </span>
	<?php
	printf(
		/* Translators: 1: theme name, 2: developer names. */
		__( 'Theme: %1$s by %2$s.', 'aventurine' ),
		'Aventurine',
		'<a href="http://themes.redradar.net/" rel="designer">Kelly&nbsp;Dwan &amp; Mel&nbsp;Choyce</a>'
	);
}
add_filter( 'aventurine_credits', 'aventurine_show_credits' );
