<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Fluxo
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
<div id="page" class="hfeed site js-fullpage">

	<header id="masthead" class="site-header small-only-text-center" role="banner">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'fluxo' ); ?></a>
		
		<div class="row">
		 	<div class="medium-4 columns">
				<div class="site-branding">
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title visuallyhidden"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title visuallyhidden"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif; ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/redelivre-blue--small.png'; ?>" alt="Logo redelivre" class="site-logo"></a>
				</div><!-- .site-branding -->
			</div>

			<div class="medium-8 columns">
				<nav id="site-navigation" class="site-navigation site-navigation--main medium-text-right" role="navigation">
					<?php
					if ( has_nav_menu( 'primary' ) )
					{
						echo strip_tags(wp_nav_menu( array(
								'theme_location' => 'primary',
								'menu_id' => 'primary-menu',
								'container'       => false,
								'echo'            => false,
								'items_wrap'      => '%3$s',
								'depth'           => 0,
						) ), '<a>' );
					}
					else
					{?>
						<a href="<?php echo wp_registration_url(); ?>">Cadastre-se</a>
						<?php
					}
					wp_loginout();?>
				</nav><!-- #site-navigation -->
			</div>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
