<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package aventurine
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="hfeed site">

	<a class="screen-reader-text skip-link" href="#content"><?php _e( 'Skip to content', 'aventurine' ); ?></a>
	<nav id="site-navigation" class="main-navigation clear" role="navigation">
		<div class="container">
			<button class="menu-toggle"><?php _e( 'Menu', 'aventurine' ); ?></button>

			<?php
				get_search_form();
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'show_home' => true,
					)
				);
				?>
		</div>
	</nav><!-- #site-navigation -->
	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding container">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<p class="site-description"><?php bloginfo( 'description' ); ?></p>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content container">
