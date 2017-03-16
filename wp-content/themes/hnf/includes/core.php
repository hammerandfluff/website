<?php
namespace HNF\Core;

/**
 * Sets up this file with the WordPress API.
 *
 * @return void
 */
function load() {
	add_action( 'after_setup_theme', __NAMESPACE__ . '\\setup' );
	add_action( 'after_setup_theme', __NAMESPACE__ . '\\setup_theme', 100 );
}

/**
 * Register various methods with the WordPress API.
 *
 * @return void
 */
function setup() {
	add_action( 'hnf_setup_theme',  __NAMESPACE__ . '\\i18n' );
	add_action( 'hnf_setup_theme', __NAMESPACE__ . '\\theme_support' );
	add_action( 'hnf_setup_theme', __NAMESPACE__ . '\\menus' );
	add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\scripts' );
	add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\styles' );
	add_action( 'wp_head', __NAMESPACE__ . '\\header_meta' );
}

/**
 * Fires the setup theme hook for theme functionality to run on.
 *
 * @return void
 */
function setup_theme() {
	do_action( 'hnf_setup_theme' );
}

/**
 * Makes WP Theme available for translation.
 *
 * Translations can be added to the /languages directory for the hnf text
 * domain. These should be based off of the included .pot file.
 *
 * @return void
 */
function i18n() {
	load_theme_textdomain( 'hnf', HNF_PATH . '/languages' );
}

/**
 * Registers support for various core theme features.
 *
 * @return void.
 */
function theme_support() {

}

/**
 * Registers the various nav menus for this theme.
 *
 * @return void
 */
function menus() {
	register_nav_menu(
		'primary',
		__( 'Primary Menu', 'hnf' )
	);
}

/**
 * Enqueue scripts for front-end.
 *
 * @return void
 */
function scripts() {
	wp_enqueue_script(
		'hnf',
		HNF_TEMPLATE_URL . "/assets/js/dist/main.bundle.js",
		array(),
		HNF_VERSION,
		true
	);
}

/**
 * Enqueue styles for front-end.
 *
 * @return void
 */
function styles() {
	wp_enqueue_style(
		'hnf',
		HNF_URL . "/assets/css/dist/main.css",
		array(),
		HNF_VERSION
	);
}

/**
 * Add humans.txt to the <head> element.
 *
 * @return void
 */
function header_meta() {
	/**
	 * Filter the path used for the site's humans.txt attribution file
	 *
	 * @param string $humanstxt
	 */
	$humanstxt = apply_filters( 'hnf_humans', HNF_TEMPLATE_URL . '/humans.txt' );

	echo '<link type="text/plain" rel="author" href="' . esc_url( $humanstxt ) . '" />';
}
