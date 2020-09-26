<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package aventurine
 */

if ( ! function_exists( 'aventurine_content_nav' ) ) :
	/**
	 * Display navigation to next/previous pages when applicable
	 *
	 * @param string $nav_id slug for this menu, used as HTML ID.
	 */
	function aventurine_content_nav( $nav_id ) {
		global $wp_query, $post;

		// Don't print empty markup on single pages if there's nowhere to navigate.
		if ( is_single() ) {
			$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
			$next     = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous ) {
				return;
			}
		}

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
			return;
		}

		$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';

		?>
		<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
			<h2 class="screen-reader-text"><?php _e( 'Post navigation', 'aventurine' ); ?></h2>

			<?php if ( is_single() ) : ?>

				<?php previous_post_link( '<div class="nav-previous">%link</div>', ' %title <span class="meta-nav">' . _x( '&rarr;', 'Previous post link', 'aventurine' ) . '</span>' ); ?>
				<?php next_post_link( '<div class="nav-next">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Next post link', 'aventurine' ) . '</span> %title' ); ?>

			<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : ?>

				<?php if ( get_next_posts_link() ) : ?>
				<div class="nav-previous"><?php next_posts_link( __( 'Older posts <span class="meta-nav">&rarr;</span> ', 'aventurine' ) ); ?></div>
				<?php endif; ?>

				<?php if ( get_previous_posts_link() ) : ?>
				<div class="nav-next"><?php previous_posts_link( __( '<span class="meta-nav">&larr;</span> Newer posts', 'aventurine' ) ); ?></div>
				<?php endif; ?>

			<?php endif; ?>

		</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
		<?php
	}
endif;

if ( ! function_exists( 'aventurine_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @param WP_Comment $comment Comment data object.
	 * @param array      $args    Optional. An array of arguments. Default empty array.
	 * @param int        $depth   Optional. Depth of the current comment in reference to parents. Default 0.
	 */
	function aventurine_comment( $comment, $args, $depth ) {
		if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : 
			?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
				<?php _e( 'Pingback:', 'aventurine' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'aventurine' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

		<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<?php if ( 0 != $args['avatar_size'] ) : ?>
			<div class="comment-image">
				<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
			</div>
			<?php endif; ?>

			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>
				</div><!-- .comment-author -->

				<div class="comment-metadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
						<?php
							printf(
								/* Translators: 1: date, 2: time. */
								_x( '%1$s at %2$s', '1: date, 2: time', 'aventurine' ),
								get_comment_date(),
								get_comment_time()
							);
						?>
						</time>
					</a>
				</div><!-- .comment-metadata -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'aventurine' ); ?></p>
				<?php endif; ?>
			</footer><!-- .comment-meta -->

			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<?php
				comment_reply_link(
					array_merge(
						$args,
						array(
							'add_below' => 'div-comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<div class="reply">',
							'after'     => '</div>',
						) 
					) 
				);
			?>
		</article><!-- .comment-body -->

			<?php
		endif;
	}
endif;

if ( ! function_exists( 'aventurine_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time, author.
	 *
	 * @deprecated 1.0.0 in favor of `aventurine_get_post_details`.
	 */
	function aventurine_posted_on() {
		aventurine_get_post_details( false );
	}
endif;

if ( ! function_exists( 'aventurine_get_post_details' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time, author,
	 * categories, and tags.
	 *
	 * @param {boolean} $show_taxonomy Whether the function should also print
	 *                                 taxonomy data (used for legacy support).
	 */
	function aventurine_get_post_details( $show_taxonomy = true ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		printf(
			/* Translators: 1: date, 2: author. */
			__( '<span class="posted-on">Posted on %1$s</span><span class="byline"> by %2$s</span>', 'aventurine' ),
			sprintf(
				'<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
				esc_url( get_permalink() ),
				esc_attr( get_the_time() ),
				$time_string
			),
			sprintf(
				'<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				/* Translators: %s: author name. */
				esc_attr( sprintf( __( 'View all posts by %s', 'aventurine' ), get_the_author() ) ),
				esc_html( get_the_author() )
			)
		);

		if ( ! $show_taxonomy ) {
			return;
		}

		/* Translators: used between list items, there is a space after the comma */
		$category_list = get_the_category_list( __( ', ', 'aventurine' ) );

		/* Translators: used between list items, there is a space after the comma */
		$tag_list = get_the_tag_list( '', __( ', ', 'aventurine' ) );

		if ( ! $category_list ) {
			if ( $tag_list ) {
				/* Translators: 1: not used 2: tags. */
				$meta_text = __( ' with tags %2$s.', 'aventurine' );
			} else {
				$meta_text = '';
			}
		} else {
			if ( $tag_list ) {
				/* Translators: 1: categories, 2: tags. */
				$meta_text = __( ' in %1$s with tags %2$s.', 'aventurine' );
			} else {
				/* Translators: 1: categories. */
				$meta_text = __( ' in %1$s.', 'aventurine' );
			}
		}

		printf(
			$meta_text,
			$category_list,
			$tag_list
		);
	}
endif;

/**
 * Get the theme credits.
 *
 * @param {boolean} $show_wp Whether the string should include a WordPress link.
 */
function aventurine_get_credits( $show_wp = true ) {
	$credits = '';
	// @todo Privacy policy URL.

	if ( $show_wp ) {
		$credits .= '<a href="http://wordpress.org/" rel="generator">';
		/* translators: %s: WordPress. */
		$credits .= sprintf( __( 'Proudly powered by %s', 'aventurine' ), 'WordPress' );
		$credits .= '</a>';
		$credits .= '<span class="sep"> | </span>';
	}

	$credits .= sprintf(
		/* Translators: 1: theme name, 2: developer names. */
		__( 'Theme: %1$s by %2$s.', 'aventurine' ),
		'Aventurine',
		'<a href="http://themes.redradar.net/" rel="designer">Kelly&nbsp;Dwan &amp; Mel&nbsp;Choyce</a>'
	);
	
	return $credits;
}
add_filter( 'aventurine_credits', 'aventurine_show_credits' );
