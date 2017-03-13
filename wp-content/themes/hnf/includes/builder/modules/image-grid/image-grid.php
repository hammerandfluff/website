<?php
namespace HNF\Builder\Modules;

class ImageGrid extends Base {
	public static $polyfill_enqueued = false;
	public static function setup( $settings = [] ) {
		\FLBuilder::register_settings_form( 'hnf_image_grid_form', [
			'title' => __('New Grid Item', 'hnf'),
			'tabs'  => [
				'general' => [
					'title' => __( 'General', 'hnf' ),
					'sections' => [
						'general' => [
							'title' => '',
							'fields' => [
								'title' => [
									'type' => 'text',
									'label' => __( 'Title', 'hnf' ),
									'description' => __( 'Set a title manually or override the post title.', 'hnf' )
								],
								'image' => [
									'type' => 'photo',
									'label' => __( 'Image', 'hnf' ),
									'show_remove' => true,
									'description' => __( 'Set a photo manually or override the post photo.', 'hnf' )
								],
								'link' => [
									'type' => 'link',
									'label' => 'Link',
									'description' => __( 'Set a link manually or override the post photo.', 'hnf' )
								]
							]
						],
					]
				]
			]
		] );
		$settings = [
			'general' => [
				'title' => __( 'Items', 'hnf' ),
				'sections' => [
					'general' => [
						'title' => '',
						'fields' => [
							'items' => [
								'type' => 'form',
								'label' => 'Items',
								'form' => 'hnf_image_grid_form',
								'preview_text' => 'title',
								'multiple' => true
							]
						]
					]
				]
			],
			'grid' => [
				'title' => __( 'Grid', 'hnf' ),
				'sections' => [
					'general' => [
						'title' => '',
						'fields' => [
							'columns' => [
								'type' => 'select',
								'label' => __( 'Large Scren Columns', 'hnf' ),
								'default' => '3',
								'options' => [
									'2' => __( 'Two Columns', 'hnf' ),
									'3' => __( 'Three Columns', 'hnf' ),
									'4' => __( 'Four Columns', 'hnf' ),
									'5' => __( 'Five Columns', 'hnf' )
								]
							],
							'gutters' => [
								'type' => 'unit',
								'label' => __( 'Large Screen Gutters', 'hnf' ),
								'description' => 'px',
								'default' => '20'
							],
							'columns_medium' => [
								'type' => 'select',
								'label' => __( 'Medium Screen Columns', 'hnf' ),
								'default' => '2',
								'options' => [
									'1' => __( 'One Column', 'hnf' ),
									'2' => __( 'Two Columns', 'hnf' ),
									'3' => __( 'Three Columns', 'hnf' )
								]
							],
							'gutters_medium' => [
								'type' => 'unit',
								'label' => __( 'Medium Screen Gutters', 'hnf' ),
								'description' => 'px',
								'default' => '10'
							],
							'columns_responsive' => [
								'type' => 'select',
								'label' => __( 'Small Screen Columns', 'hnf' ),
								'default' => '1',
								'options' => [
									'1' => __( 'One Column', 'hnf' ),
									'2' => __( 'Two Columns', 'hnf' )
								]
							],
							'gutters_responsive' => [
								'type' => 'unit',
								'label' => __( 'Small Screen Gutters', 'hnf' ),
								'description' => 'px',
								'default' => '10'
							]
						]
					],
					'titles' => [
						'title' => __( 'Titles', 'hnf' ),
						'fields' => [
							'titles' => [
								'type' => 'select',
								'label' => __( 'Display' ),
								'default' => 'yes',
								'options' => [
									'yes' => __( 'Display Titles', 'hnf' ),
									'no' => __( 'Hide Titles', 'hnf' )
								]
							],
							'text_color' => [
								'type' => 'color',
								'label' => __( 'Text Color', 'hnf' ),
								'default' => '58595B',
								'show_reset' => true,
								'preview' => [
									'type' => 'css',
									'selector' => '.hnf-image-grid-title',
									'property' => 'color'
								]
							],
							'text_size' => [
								'type' => 'unit',
								'label' => __('Size', 'hnf'),
								'default' => '18',
								'maxlength' => '4',
								'size' => '5',
								'description' => 'px',
								'responsive'  => [
									'default' => [
										'default' => '18',
										'medium' => '16',
										'responsive' => '14'
									]
								],
								'preview' => [
									'type' => 'css',
									'selector' => '.hnf-image-grid-title',
									'property' => 'font-size',
									'unit' => 'px'
								]
							],
							'text_weight' => [
								'type' => 'select',
								'label' => __( 'Font Weight', 'hnf' ),
								'default' => 'bold',
								'options' => [
									'normal' => __( 'Normal', 'hnf' ),
									'bold' => __( 'Bold', 'hnf' )
								],
								'preview' => [
									'type' => 'css',
									'selector' => '.hnf-image-grid-title',
									'property' => 'font-weight'
								]
							],
							'text_align' => [
								'type' => 'select',
								'label' => __('Text Alignment', 'hnf'),
								'default' => 'left',
								'options' => [
									'center' => __('Center', 'hnf'),
									'left' => __('Left', 'hnf'),
									'right' => __('Right', 'hnf')
								],
								'preview' => [
									'type' => 'css',
									'selector' => '.hnf-image-grid-title',
									'property' => 'text-align'
								]
							],
							'title_case' => [
								'type' => 'select',
								'label' => __( 'Title Case', 'hnf' ),
								'default' => '',
								'options' => [
									'' => __( 'As Written', 'hnf' ),
									'lowercase' => __( 'Lower Case', 'hnf' ),
									'uppercase' => __( 'Upper Case', 'hnf' ),
									'capitalize' => __( 'Title Case', 'hnf' )
								],
								'preview' => [
									'type' => 'css',
									'selector' => '.hnf-image-grid-title',
									'property' => 'text-transform'
								]
							],
							'bg_offset' => [
								'type' => 'unit',
								'label' => __('Postion Offset', 'hnf'),
								'maxlength' => '3',
								'size' => '4',
								'description' => 'px',
								'responsive'  => [
									'default' => [
										'default' => '20',
										'medium' => '20',
										'responsive' => '20'
									]
								]
							],
							'bg_anchor' => [
								'type' => 'select',
								'label' => __( 'Anchor To', 'hnf' ),
								'default' => 'bottom',
								'options' => [
									'bottom' => __( 'Bottom', 'hnf' ),
									'top' => __( 'Top', 'hnf' )
								]
							]
						]
					],
					'title_baground' => [
						'title' => __( 'Title Background', 'hnf' ),
						'fields' => [
							'text_bg_color' => [
								'type' => 'color',
								'label' => __('Background Color', 'hnf'),
								'default' => 'FFFFFF',
								'show_reset' => true
							],
							'text_bg_opacity' => [
								'type' => 'select',
								'label' => __( 'Background Opacity', 'hnf' ),
								'default' => '0.7',
								'options' => [
									'0' => __( '0%', 'hnf' ),
									'0.05' => __( '5%', 'hnf' ),
									'0.1' => __( '10%', 'hnf' ),
									'0.15' => __( '15%', 'hnf' ),
									'0.2' => __( '20%', 'hnf' ),
									'0.25' => __( '25%', 'hnf' ),
									'0.3' => __( '30%', 'hnf' ),
									'0.35' => __( '35%', 'hnf' ),
									'0.4' => __( '40%', 'hnf' ),
									'0.45' => __( '45%', 'hnf' ),
									'0.5' => __( '50%', 'hnf' ),
									'0.55' => __( '55%', 'hnf' ),
									'0.6' => __( '60%', 'hnf' ),
									'0.65' => __( '65%', 'hnf' ),
									'0.7' => __( '70%', 'hnf' ),
									'0.75' => __( '75%', 'hnf' ),
									'0.8' => __( '80%', 'hnf' ),
									'0.85' => __( '85%', 'hnf' ),
									'0.9' => __( '90%', 'hnf' ),
									'0.95' => __( '95%', 'hnf' ),
									'1' => __( '100%', 'hnf' )
								]
							],
							'bg_padding_top' => [
								'type' => 'unit',
								'label' => __('Padding Top', 'hnf'),
								'maxlength' => '2',
								'size' => '3',
								'description' => 'px',
								'responsive'  => [
									'default' => [
										'default' => '5',
										'medium' => '5',
										'responsive' => '5'
									]
								],
								'preview' => [
									'type' => 'css',
									'selector' => '.hnf-image-grid-title',
									'property' => 'padding-top',
									'unit' => 'px'
								]
							],
							'bg_padding_right' => [
								'type' => 'unit',
								'label' => __('Padding Right', 'hnf'),
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
									'selector' => '.hnf-image-grid-title',
									'property' => 'padding-right',
									'unit' => 'px'
								]
							],
							'bg_padding_bottom' => [
								'type' => 'unit',
								'label' => __('Padding Bottom', 'hnf'),
								'maxlength' => '2',
								'size' => '3',
								'description' => 'px',
								'responsive'  => [
									'default' => [
										'default' => '5',
										'medium' => '5',
										'responsive' => '5'
									]
								],
								'preview' => [
									'type' => 'css',
									'selector' => '.hnf-image-grid-title',
									'property' => 'padding-bottom',
									'unit' => 'px'
								]
							],
							'bg_padding_left' => [
								'type' => 'unit',
								'label' => __('Padding Left', 'hnf'),
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
									'selector' => '.hnf-image-grid-title',
									'property' => 'padding-left',
									'unit' => 'px'
								]
							]
						]
					]
				]
			]
		];
		parent::setup( $settings );
	}
	public static function scripts() {
		if( self::$polyfill_enqueued ) {
			return;
		}
		wp_enqueue_script(
			'object-fit-polyfill',
			HNF_TEMPLATE_URL . "/assets/js/dist/objectFit.bundle.js",
			array(),
			HNF_VERSION,
			true
		);
		self::$polyfill_enqueued = true;
	}
	public function __construct( $registration = [] ) {
		$registration = [
			'name'            => __( 'Image Grid', 'hnf' ),
			'description'     => __( 'Create grid of images on a page.', 'hnf' ),
			'category'        => __( 'Advanced Modules', 'hnf' ),
			'dir'             => HNF_INC . 'builder/modules/image-grid',
			'url'             => HNF_URL . 'includes/builder/modules/image-grid',
			'partial_refresh' => true
		];
		parent::__construct( $registration );
	}
}
