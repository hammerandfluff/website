<?php
/**
 * Opt-ins for the default Page post-type.
 */

 namespace HNF\Post_Types\Page;

/**
 * Sets up this file with the WordPress API.
 *
 * @return void
 */
function load() {
	add_action( 'after_setup_theme', __NAMESPACE__ . '\\setup' );
}

/**
 * Register various methods with the WordPress API.
 *
 * @return void
 */
function setup() {
	add_filter( 'hnf_meta_hide_title',  __NAMESPACE__ . '\\opt_in' );
}

/**
 * Adds the Page post type to an opt-in array.
 *
 * @param  array $post_types The opted in post types.
 * @return array             The opted in post types with 'page' added to it.
 */
function opt_in( $post_types ) {
	$post_types[] = 'page';
	return $post_types;
}
