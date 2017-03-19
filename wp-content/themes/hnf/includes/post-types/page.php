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
	add_filter( 'hnf_hide_support', __NAMESPACE__ . '\\hide_support', 10, 2 );
	add_filter( 'get_post_metadata', __NAMESPACE__ . '\\no_byline', 10, 3 );
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

/**
 * Hide support for certain 'hide' items in the admin.
 *
 * @param  array  $support   The array of supported hide items.
 * @param  string $post_type The post type being worked on.
 * @return array             The updated array of supported items.
 */
function hide_support( $support, $post_type ) {
	if ( is_admin() && 'page' === $post_type ) {
		$support = array_diff( $support, [ 'byline' ] );
	}
	return $support;
}
/**
 * Remove byline on page templates.
 * @param  null        $value The value to use for the meta.
 * @param  string      $id    The post ID of the item.
 * @param  string      $key   The key of the meta being requested.
 * @return string|null        Null or 1 if the meta is for byline on pages.
 */
function no_byline( $value, $id, $key ) {
	if( 'hide_byline' === $key && 'page' === get_post_type( $id ) ) {
		$value = '1';
	}
	return $value;
}
