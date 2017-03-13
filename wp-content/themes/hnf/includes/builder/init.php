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
	do_action( 'hnf_bb_setup' );
}

/**
 * Includes the beaver builder customizations and intializes them.
 * @return void
 */
function startup() {
	$path = HNF_INC . 'builder/';
	$ns = '\\HNF\\Builder\\';
	$modules = apply_filters( 'hnf_bb_startup_items', [
		'modules/base.php' => false,
		'accordion-row.php' => $ns .'Accordion_Row\\load',
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
