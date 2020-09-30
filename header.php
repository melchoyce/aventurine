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
	<nav id="site-navigation" class="main-navigation primary-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary', 'aventurine' ); ?>">
		<div class="menu-wrapper">
			<div class="menu-button-container">
				<button id="primary-open-menu" class="button open" aria-haspopup="true" aria-controls="primary-navigation">
					<?php esc_html_e( 'Menu', 'aventurine' ); ?>
					<span class="screen-reader-text"><?php esc_html_e( 'expanded', 'aventurine' ); ?></span>
				</button><!-- #primary-open-menu -->
				<button id="primary-close-menu" class="button close" aria-haspopup="true" aria-controls="primary-navigation" aria-expanded="true">
					<?php esc_html_e( 'Close', 'aventurine' ); ?>
					<span class="screen-reader-text"><?php esc_html_e( 'collapsed', 'aventurine' ); ?></span>
				</button><!-- #primary-close-menu -->
			</div><!-- .menu-button-container -->

			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'show_home' => true,
					'menu_class' => 'primary-menu-container',
					'container' => 'ul',
				)
			);
			?>
		</div>

		<?php get_search_form(); ?>
	</nav><!-- #site-navigation -->
	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding container">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<p class="site-description"><?php bloginfo( 'description' ); ?></p>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content container">
