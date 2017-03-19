<?php
namespace HNF\Builder\Rich_Text_Columns;

/**
 * Sets up this file with the WordPress API.
 *
 * @return void
 */
function load() {
	add_action( 'hnf_bb_init', __NAMESPACE__ . '\\setup' );
	add_filter( 'fl_builder_register_settings_form', __NAMESPACE__ . '\\settings', 10, 2 );
}

/**
 * Register various methods with the WordPress API.
 *
 * @return void
 */
function setup() {
	add_filter( 'fl_builder_render_css', __NAMESPACE__ . '\\styles', 10, 3 );
}

/**
 * Add settings to the default rich text module for columns.
 *
 * @param  array  $form The form settings array.
 * @param  string $id   The form ID of the module being registered.
 * @return array        The update form array.
 */
function settings( $form, $id ) {
	if ( 'rich-text' !== $id ) {
		return $form;
	}
	$form['general']['sections']['columns'] = [
		'title' => __( 'Columns', 'hnf' ),
		'fields' => [
			'columns' => [
				'type' => 'unit',
				'label' => __( 'Column Count', 'hnf' ),
				'maxlength' => '2',
				'size' => '3',
				'responsive'  => [
					'default' => [
						'default' => '1',
						'medium' => '1',
						'responsive' => '1'
					]
				],
				'preview' => [
					'type' => 'css',
					'selector' => '.fl-rich-text',
					'property' => 'column-count',
					'unit' => ''
				]
			],
			'column_gap' => [
				'type' => 'unit',
				'label' => __( 'Column Gap', 'hnf' ),
				'maxlength' => '2',
				'size' => '3',
				'description' => 'px',
				'responsive'  => [
					'default' => [
						'default' => '10',
						'medium' => '10',
						'responsive' => '10'
					]
				],
				'preview' => [
					'type' => 'css',
					'selector' => '.fl-rich-text',
					'property' => 'column-gap',
					'unit' => 'px'
				]
			],
			'column_rule_width' => [
				'type' => 'unit',
				'label' => __( 'Column Rule Width', 'hnf' ),
				'maxlength' => '2',
				'size' => '3',
				'description' => 'px',
				'responsive'  => [
					'default' => [
						'default' => '0',
						'medium' => '0',
						'responsive' => '0'
					]
				],
				'preview' => [
					'type' => 'css',
					'selector' => '.fl-rich-text',
					'property' => 'column-rule-width',
					'unit' => 'px'
				]
			],
			'column_rule_type' => [
				'type' => 'select',
				'label' => __( 'Column Rule Style', 'hnf' ),
				'default' => 'solid',
				'options' => [
					'none' => __( 'None', 'hnf' ),
					'solid' => __( 'Solid', 'hnf' ),
					'dotted' => __( 'Dotted', 'hnf' ),
					'dashed' => __( 'Dashed', 'hnf' ),
					'double' => __( 'Double', 'hnf' ),
					'groove' => __( 'Groove', 'hnf' ),
					'ridge' => __( 'Ridge', 'hnf' ),
					'inset' => __( 'Inset', 'hnf' ),
					'outset' => __( 'Outset', 'hnf' )
				],
				'preview' => [
					'type' => 'css',
					'selector' => '.fl-rich-text',
					'property' => 'column-rule-style',
					'unit' => ''
				]
			],
			'column_rule_color' => [
				'type' => 'color',
				'label' => __( 'Column Rule Color', 'hnf' ),
				'default' => '#58595B',
				'preview' => [
					'type' => 'css',
					'selector' => '.fl-rich-text',
					'property' => 'column-rule-color'
				]
			]
		]
	];
	return $form;
}

/**
 * Outputs the variable column styles for the content area.
 *
 * @param  string   $css             The giant string of styles.
 * @param  array    $nodes           The array of modules in the builder.
 * @param  stdClass $global_settings The global settings as an object.
 * @return string                    The updated string of css styles.
 */
function styles( $css, $nodes, $global_settings ) {
	foreach( $nodes[ 'modules' ] as $module ) {
		if ( 'rich-text' !== $module->slug ) {
			continue;
		}
		if ( $module->settings->columns_responsive > 1 || $module->settings->columns_medium > 1 || $module->settings->columns > 1 ) {
			ob_start();
			?>

			.fl-node-<?php echo $module->node; ?> .fl-rich-text{
				-webkit-column-count: <?php echo esc_attr( $module->settings->columns_responsive ); ?>;
				-moz-column-count: <?php echo esc_attr( $module->settings->columns_responsive ); ?>;
				column-count: <?php echo esc_attr( $module->settings->columns_responsive ); ?>;

				-webkit-column-gap: <?php echo esc_attr( $module->settings->column_gap_responsive ); ?>px;
				-moz-column-gap: <?php echo esc_attr( $module->settings->column_gap_responsive ); ?>px;
				column-gap: <?php echo esc_attr( $module->settings->column_gap_responsive ); ?>px;

				-webkit-column-rule: <?php echo esc_attr( $module->settings->column_rule_width_responsive); ?>px <?php echo esc_attr( $module->settings->column_rule_type ); ?> #<?php echo esc_attr( $module->settings->column_rule_color ); ?>;
				-moz-column-rule: <?php echo esc_attr( $module->settings->column_rule_width_responsive); ?>px <?php echo esc_attr( $module->settings->column_rule_type ); ?> #<?php echo esc_attr( $module->settings->column_rule_color ); ?>;
				column-rule: <?php echo esc_attr( $module->settings->column_rule_width_responsive); ?>px <?php echo esc_attr( $module->settings->column_rule_type ); ?> #<?php echo esc_attr( $module->settings->column_rule_color ); ?>;
			}
			@media (min-width: <?php echo $global_settings->responsive_breakpoint; ?>px) {
				.fl-node-<?php echo $module->node; ?> .fl-rich-text{
					-webkit-column-count: <?php echo esc_attr( $module->settings->columns_medium ); ?>;
					-moz-column-count: <?php echo esc_attr( $module->settings->columns_medium ); ?>;
					column-count: <?php echo esc_attr( $module->settings->columns_medium ); ?>;

					-webkit-column-gap: <?php echo esc_attr( $module->settings->column_gap_medium ); ?>px;
					-moz-column-gap: <?php echo esc_attr( $module->settings->column_gap_medium ); ?>px;
					column-gap: <?php echo esc_attr( $module->settings->column_gap_medium ); ?>px;

					-webkit-column-rule: <?php echo esc_attr( $module->settings->column_rule_width_medium); ?>px <?php echo esc_attr( $module->settings->column_rule_type ); ?> #<?php echo esc_attr( $module->settings->column_rule_color ); ?>;
					-moz-column-rule: <?php echo esc_attr( $module->settings->column_rule_width_medium); ?>px <?php echo esc_attr( $module->settings->column_rule_type ); ?> #<?php echo esc_attr( $module->settings->column_rule_color ); ?>;
					column-rule: <?php echo esc_attr( $module->settings->column_rule_width_medium); ?>px <?php echo esc_attr( $module->settings->column_rule_type ); ?> #<?php echo esc_attr( $module->settings->column_rule_color ); ?>;
				}
			}
			@media (min-width: <?php echo $global_settings->medium_breakpoint ?>px) {
				.fl-node-<?php echo $module->node; ?> .fl-rich-text{
					-webkit-column-count: <?php echo esc_attr( $module->settings->columns ); ?>;
					-moz-column-count: <?php echo esc_attr( $module->settings->columns ); ?>;
					column-count: <?php echo esc_attr( $module->settings->columns ); ?>;

					-webkit-column-gap: <?php echo esc_attr( $module->settings->column_gap ); ?>px;
					-moz-column-gap: <?php echo esc_attr( $module->settings->column_gap ); ?>px;
					column-gap: <?php echo esc_attr( $module->settings->column_gap ); ?>px;

					-webkit-column-rule: <?php echo esc_attr( $module->settings->column_rule_width); ?>px <?php echo esc_attr( $module->settings->column_rule_type ); ?> #<?php echo esc_attr( $module->settings->column_rule_color ); ?>;
					-moz-column-rule: <?php echo esc_attr( $module->settings->column_rule_width); ?>px <?php echo esc_attr( $module->settings->column_rule_type ); ?> #<?php echo esc_attr( $module->settings->column_rule_color ); ?>;
					column-rule: <?php echo esc_attr( $module->settings->column_rule_width); ?>px <?php echo esc_attr( $module->settings->column_rule_type ); ?> #<?php echo esc_attr( $module->settings->column_rule_color ); ?>;
				}
			}
			<?php
			$css .= ob_get_clean();
		}
	}
	return $css;
}
