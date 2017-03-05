<?php
namespace HNF\Builder\Clean;

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
	add_action( 'init', __NAMESPACE__ . '\\init', -1 );
	add_action( 'fl_builder_ui_bar_buttons',  __NAMESPACE__ . '\\buttons' );
	add_action( 'wp_default_scripts', __NAMESPACE__ . '\\jquery' );
	remove_action( 'wp_footer', 'FLBuilder::include_jquery' );
}

/**
 * Fires an action to let modules know they can run safely.
 *
 * @return void
 */
function init() {
	if ( class_exists( 'FLBuilder' ) ) {
		do_action( 'hnf_bb_init' );
	}
}

/**
 * Remove certain buttons from the beaver builder admin bar.
 *
 * @param  array $buttons The array of buttons to render.
 * @return array          The updated array of buttons.
 */
function buttons( $buttons ) {
	$hidden_items = [ 'upgrade', 'buy', 'templates' ];
	foreach ( $hidden_items as $hidden_item ) {
		if ( isset( $buttons[ $hidden_item ] ) ) {
			unset( $buttons[ $hidden_item ] );
		}
	}
	return $buttons;
}

/**
 * Moves jQuery to the footer when loaded.
 *
 * @return void
 */
function jquery( $wp_scripts ) {
	if( is_admin() ) {
		return;
	}
	$wp_scripts->add_data( 'jquery', 'group', 1 );
	$wp_scripts->add_data( 'jquery-core', 'group', 1 );
	$wp_scripts->add_data( 'jquery-migrate', 'group', 1 );
}
