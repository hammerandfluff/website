<?php
namespace HNF\Builder\Init;

use HNF\Builder\Modules;

/**
 * Sets up this file with the WordPress API.
 *
 * @return void
 */
function load() {
	add_action( 'hnf_bb_init', __NAMESPACE__ . '\\setup' );
}

/**
 * Register various methods with the WordPress API.
 *
 * @return void
 */
function setup() {
	require_once HNF_INC . 'builder/accordion-row.php';
	require_once HNF_INC . 'builder/modules/base.php';
	require_once HNF_INC . 'builder/modules/image-grid/image-grid.php';

	\HNF\Builder\Accordion_Row\load();
	Modules\ImageGrid::load();
}
