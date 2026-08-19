<?php
/**
 * browme theme functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BROWME_VERSION', '1.0.0' );
define( 'BROWME_DIR', get_template_directory() );
define( 'BROWME_URI', get_template_directory_uri() );

/**
 * Theme setup
 */
function browme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style' ) );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'automatic-feed-links' );

	set_post_thumbnail_size( 1920, 1440, true );
	add_image_size( 'browme-card', 960, 720, true );
	add_image_size( 'browme-square', 960, 960, true );

	load_theme_textdomain( 'browme', BROWME_DIR . '/languages' );
}
add_action( 'after_setup_theme', 'browme_setup' );

/**
 * Styles / scripts
 */
function browme_assets() {
	wp_enqueue_style(
		'google-fonts-browme',
		'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&family=Shippori+Mincho:wght@400;500;600&family=Noto+Serif+JP:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style( 'browme-base', BROWME_URI . '/css/base.css', array(), BROWME_VERSION );
	wp_enqueue_style( 'browme-style', BROWME_URI . '/css/style.css', array( 'browme-base' ), BROWME_VERSION );
	wp_enqueue_style( 'browme-wp', BROWME_URI . '/css/wp-overrides.css', array( 'browme-style' ), BROWME_VERSION );

	wp_enqueue_script( 'gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js', array(), '3.12.5', true );
	wp_enqueue_script( 'gsap-scrolltrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js', array( 'gsap' ), '3.12.5', true );
	wp_enqueue_script( 'browme-main', BROWME_URI . '/js/main.js', array( 'gsap', 'gsap-scrolltrigger' ), BROWME_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'browme_assets' );

/**
 * Favicons — theme defaults, overridden automatically if the
 * Customizer "Site Icon" is set.
 */
function browme_favicons() {
	if ( has_site_icon() ) {
		return;
	}
	echo '<link rel="icon" type="image/png" sizes="16x16" href="' . esc_url( BROWME_URI . '/img/favicon-16.png' ) . '">' . "\n";
	echo '<link rel="icon" type="image/png" sizes="32x32" href="' . esc_url( BROWME_URI . '/img/favicon-32.png' ) . '">' . "\n";
	echo '<link rel="icon" type="image/png" sizes="512x512" href="' . esc_url( BROWME_URI . '/img/favicon-512.png' ) . '">' . "\n";
	echo '<link rel="apple-touch-icon" href="' . esc_url( BROWME_URI . '/img/apple-touch-icon.png' ) . '">' . "\n";
}
add_action( 'wp_head', 'browme_favicons' );

/**
 * Includes
 */
require BROWME_DIR . '/inc/post-types.php';
require BROWME_DIR . '/inc/template-tags.php';
require BROWME_DIR . '/inc/contact-form.php';
