<?php
/**
 * Opt-ins for the default Post post-type.
 */

 namespace HNF\Post_Types\Post;

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
 * Adds the Post post type to an opt-in array.
 *
 * @param  array $post_types The opted in post types.
 * @return array             The opted in post types with 'post' added to it.
 */
function opt_in( $post_types ) {
	$post_types[] = 'post';
	return $post_types;
}
