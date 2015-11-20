<?php
/**
 * Fluxo functions and definitions
 *
 * @package Fluxo
 */

if ( ! function_exists( 'fluxo_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function fluxo_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Fluxo, use a find and replace
	 * to change 'fluxo' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'fluxo', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'fluxo' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'fluxo_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // fluxo_setup
add_action( 'after_setup_theme', 'fluxo_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fluxo_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'fluxo_content_width', 640 );
}
add_action( 'after_setup_theme', 'fluxo_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function fluxo_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'fluxo' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'fluxo_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function fluxo_scripts() {
	// normalize.css
	wp_register_style( 'fluxo-normalize', get_template_directory_uri() . '/assets/css/normalize.min.css', '', '3.0.3' );
	wp_enqueue_style( 'fluxo-normalize' );

	// Foundation
	wp_enqueue_style( 'fluxo-foundation-css', get_template_directory_uri() . '/assets/css/foundation.min.css', '', '5.5.2' );
	wp_enqueue_style( 'fluxo-foundation-css' );
	wp_enqueue_script( 'fluxo-foundation', get_template_directory_uri() . '/assets/js/foundation.min.js', array( 'jquery' ), '5.5.2', true );

	// Google Fonts
	wp_register_style( 'fluxo-google-fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic' );
	wp_enqueue_style( 'fluxo-google-fonts' );

	// Main theme style
	wp_enqueue_style( 'fluxo-style', get_stylesheet_uri() );

	// Main theme style
	wp_register_style( 'fluxo-style-main', get_template_directory_uri() . '/assets/css/style.css' );
	wp_enqueue_style( 'fluxo-style-main');
	
	// Map style
	wp_register_style( 'fluxo-map', get_template_directory_uri() . '/assets/css/map.css' );
	wp_register_script('map-functions', get_template_directory_uri() . '/assets/js/map-functions.js', array('jquery'));
	wp_register_script('map-page-scripts', get_template_directory_uri() . '/assets/js/map-page-scripts.js', array('jquery', 'map-functions'));
	
	if(is_home() && get_query_var('mapa-tpl')) // is on /mapa
	{
		wp_enqueue_style( 'fluxo-map');
		wp_enqueue_script('map-page-scripts');
		wp_enqueue_script('map-functions');
	}

	// fullPage.js
	wp_register_style( 'fluxo-fullpage-css', get_template_directory_uri() . '/assets/css/jquery.fullPage.css', '', '2.6.6' );
	wp_enqueue_style( 'fluxo-fullpage-css' );
	
	if(is_home() && !get_query_var('mapa-tpl'))
	{
		wp_enqueue_script( 'fluxo-fullpage', get_template_directory_uri() . '/assets/js/jquery.fullPage.min.js', array( 'jquery' ), '2.6.7', true );
		wp_enqueue_script( 'fluxo-scripts', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '', true );
	}

	// Grunt watch livereload in the browser.
	wp_enqueue_script( 'fluxo-livereload', 'http://localhost:35729/livereload.js?snipver=1', array(), null, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'fluxo_scripts' );

function fluxo_base_custom_url_rewrites($rules) {
	$new_rules = array(
		"emrede/?$" => "index.php?mapa-tpl=mapa",
	);

	return $new_rules + $rules;
}

add_filter('rewrite_rules_array', 'fluxo_base_custom_url_rewrites', 11, 1);

function fluxo_has_sidebar($post_id = null)
{
	if(is_null($post_id)) $post_id = get_the_ID();

	if(!is_int($post_id) || $post_id < 1 ) return true;

	return ! (get_post_meta($post_id, '_hide-sidebar', true) == 'Y');
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
 * Post type emrede.
 */
require get_template_directory() . '/inc/emrede/emrede.php';

/**
 * file import options.
 */
require get_template_directory() . '/inc/options.php';
