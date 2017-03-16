<?php
/**
 * Various helper functions for use on the HNF website.
 */

namespace HNF\Helpers;

/**
 * A filtered get_template_part helper.
 *
 * @param  string      $slug The slug of the template part.
 * @param  string|null $name The name of the template to grab.
 * @return void
 */
function get_template_part( $slug, $name = null ) {
	$filtered = apply_filters( "hnf_partial_{$slug}_$name", [
		'slug' => 'parts/' . $slug,
		'name' => $name
	] );
	$slug = $filtered['slug'];
	$name = $filtered['name'];
	if ( $slug ) {
		\get_template_part( $slug, $name );
	}
}

function heading_level() {
	return is_singular() ? 'h1' : 'h2';
}

function header_class( $classes = '' ) {
	if ( ! is_array( $classes ) ) {
		$classes = preg_split( '#\s+#', $classes );
	}

	$classes = apply_filters( 'hnf_header_class', $classes );
	$classes = array_filter( array_unique( array_map( 'esc_attr', $classes ) ) );

	if ( $classes ) {
		echo 'class="' . implode( ' ', $classes ) . '"';
	}
}
