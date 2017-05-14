<?php
namespace HNF\Builder\Accordion_Row;

/**
 * Sets up this file with the WordPress API.
 *
 * @return void
 */
function load() {
	add_action( 'hnf_bb_after_setup', __NAMESPACE__ . '\\setup' );
}

/**
 * Register various methods with the WordPress API.
 *
 * @return void
 */
function setup() {
	add_filter( 'fl_builder_register_settings_form', __NAMESPACE__ . '\\settings', 10, 2 );
	add_action( 'fl_builder_before_render_row', __NAMESPACE__ . '\\accordion' );
}

function settings( $form, $id ) {
	if ( $id === 'row' ) {
		$form[ 'tabs' ][ 'advanced' ][ 'sections' ] = [
			'accordion' => [
				'title' => __( 'Accordion', 'hnf' ),
				'fields' => [
					'accordion_title' => [
						'type' => 'text',
						'label' => 'Accordion Title',
						'description' => __( 'Add text to make this row an accordion.', 'hnf' ),
						'help' => __( 'If this field is empty, this row acts as a normal row. If it is filled, this row becomes an accordion.', 'hnf' )
					]
				]
			]
		] + $form[ 'tabs' ][ 'advanced' ][ 'sections' ];
	}
	return $form;
}

function accordion( $row ) {
	if ( ! isset( $row->settings->accordion_title ) ) {
		return;
	}
	if( $row->settings->accordion_title ) {
		add_filter( 'fl_builder_locate_template_order', __NAMESPACE__ . '\\accordion_template' );
		add_filter( 'fl_builder_row_attributes', __NAMESPACE__ . '\\accordion_class' );
	}
}

function accordion_template( $list ) {
	remove_filter( 'fl_builder_locate_template_order', __NAMESPACE__ . '\\accordion_template' );
	array_unshift( $list, 'includes/builder/accordion-template.php' );
	return $list;
}

function accordion_class( $attrs ) {
	remove_filter( 'fl_builder_row_attributes', __NAMESPACE__ . '\\accordion_class' );
	$attrs[ 'class' ][] = 'bbrow-tab';
	return $attrs;
}
