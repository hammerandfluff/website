<?php
namespace HNF\Builder\Init;

use HNF\Builder\Modules;

/**
 * Sets up this file with the WordPress API.
 *
 * @return void
 */
function load() {
	add_action( 'hnf_setup_theme', __NAMESPACE__ . '\\setup' );
}

/**
 * Register various methods with the WordPress API.
 *
 * @return void
 */
function setup() {
	if ( ! class_exists( 'FLBuilder' ) ) {
		return;
	}

	add_action( 'init', __NAMESPACE__ . '\\init' );
	add_action( 'hnf_bb_setup', __NAMESPACE__ . '\\startup' );
	add_filter( 'fl_builder_color_presets', __NAMESPACE__ . '\\colors' );
	add_filter( 'fl_builder_settings_form_defaults', __NAMESPACE__ . '\\global_defaults', 10, 2 );
	add_action( 'post_class', __NAMESPACE__ . '\\no_constrained' );
	add_action( 'hnf_header_class', __NAMESPACE__ . '\\constrained_header' );
	add_action( 'fl_builder_font_families_system', __NAMESPACE__ . '\\raleway' );
	do_action( 'hnf_bb_setup' );
}

/**
 * Includes the beaver builder customizations and intializes them.
 *
 * @return void
 */
function startup() {
	$path = HNF_INC . 'builder/';
	$ns = '\\HNF\\Builder\\';
	$modules = apply_filters( 'hnf_bb_startup_items', [
		'modules/base.php' => false,
		'accordion-row.php' => $ns .'Accordion_Row\\load',
		'rich-text-columns.php' => $ns . 'Rich_Text_Columns\\load',
		'modules/image-grid/image-grid.php' => [
			$ns . 'Modules\\ImageGrid',
			'load'
		]
	] );

	foreach( $modules as $file => $load_func ) {
		require_once $path . $file;
		if ( is_callable( $load_func ) ) {
			call_user_func( $load_func );
		}
	}
}

/**
 * Fires an action to let modules know they can run safely.
 *
 * @return void
 */
function init() {
	do_action( 'hnf_bb_init' );
}

/**
 * Adds default colors to the builder's color picker.
 *
 * @param  array $colors The current array of colors
 * @return array         The colors array with our brand colors applied.
 */
function colors( $colors ) {
	/*
	#FFFFFF
	#000000
	#333333
	#58595B
	#E8E7E7
	#FCAF1E
	#43C3D8
	*/
	array_unshift(
		$colors,
		'ffffff',
		'000000',
		'333333',
		'58595b',
		'e8e7e7',
		'fcaf1e',
		'43c3d8'
	);
	return $colors;
}

/**
 * Sets global defaults for Beaver Builder for this theme.
 *
 * @param  stdClass $settings An object full of settings for the passed type.
 * @param  string   $type     The type of settings being worked on.
 * @return stdClass           The updated settings object.
 */
function global_defaults( $settings, $type ) {
	if ( 'global' === $type ) {
		$settings->row_width = '900';
		$settings->row_margins = '0';
		$settings->row_padding = '0';
		$settings->module_margins = '0';
		$settings->responsive_breakpoint = '600';
		$settings->medium_breakpoing = '960';
	}
	return $settings;
}

/**
 * Removes the constrained class from the post_class when the builder is active.
 *
 * @param  array $classes The array of post classes.
 * @return array          The updated array of post classes.
 */
function no_constrained( $classes ) {
	if ( \FLBuilderModel::is_builder_enabled() ) {
		$classes = array_diff( $classes, [ 'constrained' ] );
	}
	return $classes;
}

/**
 * Adds the constrained class to the header if it's output on a builder page.
 *
 * @param  array $classes The array of header classes.
 * @return array          The updated array of header classes.
 */
function constrained_header( $classes ) {
	if ( \FLBuilderModel::is_builder_enabled() ) {
		$classes[] = 'constrained';
	}
	return $classes;
}

/**
 * Add 'Raleway' to the system fonts for Beaver Builder
 *
 * This allows the theme to manage the Raleway font-face so that changing
 * settings in Beaver Builder doesn't override the font stack.
 *
 * @param  array $fonts The array of currently set system fonts.
 * @return array        The updated array of fonts with Raleway included.
 */
function raleway( $fonts ) {
	$fonts['Raleway'] = [
		'fallback' => 'Helvetica, Arial, sans-serif',
		'weights' => [
			300,
			400,
			600,
			700
		]
	];

	return $fonts;
}
