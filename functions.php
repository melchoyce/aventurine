<?php
/**
 * Aventurine functions and definitions
 *
 * @package aventurine
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'aventurine_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function aventurine_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Aventurine, use a find and replace
	 * to change 'aventurine' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'aventurine', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );
	set_post_thumbnail_size( 900, 9999 ); // 900 pixels wide by unlimited tall

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

	add_editor_style( array( 'editor-style.css', aventurine_fonts_url() ) );

	add_filter( 'use_default_gallery_style', '__return_false' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'aventurine' ),
	) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'aventurine_custom_background_args', array(
		'default-color' => '1abc9c',
		'default-image' => '',
	) ) );
}
endif; // aventurine_setup
add_action( 'after_setup_theme', 'aventurine_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function aventurine_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Left Footer Widgets', 'aventurine' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Only appear on single posts &amp; pages', 'aventurine' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Right Footer Widgets', 'aventurine' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Only appear on single posts &amp; pages', 'aventurine' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'aventurine_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function aventurine_scripts() {
	wp_enqueue_style( 'aventurine-style', get_stylesheet_uri() );

	wp_enqueue_script( 'aventurine-scripts', get_template_directory_uri() . '/js/aventurine.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'aventurine-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'aventurine_scripts' );

/**
 * Returns the Google font stylesheet URL, if available.
 *
 * The use of Varela Round, Josefin Sans and Ubuntu Mono by default is
 * localized. For languages that use characters not supported by either
 * font, the font can be disabled.
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function aventurine_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Varela Round, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$varela = _x( 'on', 'Varela Round font: on or off', 'aventurine' );

	/* Translators: If there are characters in your language that are not
	 * supported by Josefin Sans, translate this to 'off'. Do not translate into
	 * your own language.
	 */
	$josefin = _x( 'on', 'Josefin Sans font: on or off', 'aventurine' );

	/* Translators: If there are characters in your language that are not
	 * supported by Ubuntu Mono, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$ubuntu = _x( 'on', 'Ubuntu Mono font: on or off', 'aventurine' );

	if ( 'off' !== $varela || 'off' !== $josefin || 'off' !== $ubuntu ) {
		$font_families = array();

		if ( 'off' !== $varela )
			$font_families[] = 'Varela+Round:400'; //Only comes in 400

		if ( 'off' !== $josefin )
			$font_families[] = 'Josefin+Sans:400';

		if ( 'off' !== $ubuntu )
			$font_families[] = 'Ubuntu+Mono:400';

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => implode( '|', $font_families ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" );
	}

	return $fonts_url;
}

/**
 * Loads our special font CSS file.
 *
 * To disable in a child theme, use wp_dequeue_style()
 * function mytheme_dequeue_fonts() {
 *     wp_dequeue_style( 'aventurine-fonts' );
 * }
 * add_action( 'wp_enqueue_scripts', 'mytheme_dequeue_fonts', 11 );
 *
 * @return void
 */
function aventurine_fonts() {
	$fonts_url = aventurine_fonts_url();
	if ( ! empty( $fonts_url ) )
		wp_enqueue_style( 'aventurine-fonts', esc_url_raw( $fonts_url ), array(), null );
}
add_action( 'wp_enqueue_scripts', 'aventurine_fonts' );

/**
 * Enqueue Google fonts style to admin screens for TinyMCE typography dropdown.
 */
function aventurine_admin_fonts( $hook_suffix ) {
	if ( ! in_array( $hook_suffix, array( 'post-new.php', 'post.php' ) ) ) {
		return;
	}

	aventurine_fonts();

}
add_action( 'admin_enqueue_scripts', 'aventurine_admin_fonts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

