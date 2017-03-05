<?php
namespace HNF\Builder\Modules;

class ImageGrid extends Base {
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
								'post' => [
									'type' => 'suggest',
									'label' => __( 'Post', 'hnf' ),
									'action' => 'fl_as_posts',
									'data' => 'page',
									'limit' => 1,
									'description' => __( 'The post to use, or set information manually below.', 'hnf' )
								],
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
								'label' => __( 'Columns', 'hnf' ),
								'default' => '3',
								'options' => [
									'2' => __( 'Two Columns', 'hnf' ),
									'3' => __( 'Three Columns', 'hnf' ),
									'4' => __( 'Four Columns', 'hnf' )
								]
							],
							'titles' => [
								'type' => 'select',
								'label' => __( 'Titles' ),
								'default' => 'yes',
								'options' => [
									'yes' => __( 'Display Titles', 'hnf' ),
									'no' => __( 'Hide Titles', 'hnf' )
								]
							]
						]
					]
				]
			]
		];
		parent::setup( $settings );
	}
	public function __construct( $registration = [] ) {
		$registration = [
			'name'            => __( 'Image Grid', 'hnf' ),
			'description'     => __( 'Create grid of images on a page.', 'hnf' ),
			'category'        => __( 'Advanced Modules', 'hnf' ),
			'dir'             => HNF_INC . 'builder/modules/image-grid',
			'url'             => HNF_URL . 'includes/builder/modules/image-grid',
		];
		parent::__construct( $registration );
	}
}
