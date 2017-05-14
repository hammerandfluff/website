<?php
/**
 * The post meta for hiding titles with output.
 */

 namespace HNF\Customizer\Footer;

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
	add_action( 'customize_register', __NAMESPACE__ . '\\setting' );
}

/**
 * The setting
 *
 * @return void
 */
function setting( $wp_customize ) {
	$wp_customize->add_setting(
		'hnf_footer_text',
		[
			'default'    => get_footer_text( true ),
			'type'       => 'option',
			'capability' => 'manage_options',
		]
	);

	$wp_customize->add_control( 'hnf_footer_text', [
		'label'      => __( 'Footer Text', 'hnf' ),
		'section'    => 'title_tagline',
	] );
}

function get_footer_text( $raw = false ) {
	$text = get_option(
		'hnf_footer_text',
		'©[y] hammer&fluff | All Rights Reserved'
	);

	return $raw ? $text : str_replace( '[y]', date( 'Y' ), $text );
}
