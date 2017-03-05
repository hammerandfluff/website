<?php
/**
 * hammer&fluff loader file
 *
 * @package HNF
 * @since 0.1.0
 */

// Useful global constants
define( 'HNF_VERSION',      '0.1.0' );
define( 'HNF_URL',          get_stylesheet_directory_uri() );
define( 'HNF_TEMPLATE_URL', get_template_directory_uri() );
define( 'HNF_PATH',         get_template_directory() . '/' );
define( 'HNF_INC',          HNF_PATH . 'includes/' );

// Include files
require_once HNF_INC . 'core.php';
require_once HNF_INC . 'builder/clean.php';
require_once HNF_INC . 'builder/accordion-row.php';
require_once HNF_INC . 'builder/modules/base.php';
require_once HNF_INC . 'builder/modules/image-grid/image-grid.php';

// Run the setup functions
HNF\Core\load();
HNF\Builder\Clean\load();
HNF\Builder\Accordion_Row\load();
HNF\Builder\Modules\ImageGrid::load();
