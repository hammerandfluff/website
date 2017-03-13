<?php
namespace HNF\Core;

/**
 * This is a very basic test case to get things started. You should probably rename this and make
 * it work for your project. You can use all the tools provided by WP Mock and Mockery to create
 * your tests. Coverage is calculated against your includes/ folder, so try to keep all of your
 * functional code self contained in there.
 *
 * References:
 *   - http://phpunit.de/manual/current/en/index.html
 *   - https://github.com/padraic/mockery
 *   - https://github.com/10up/wp_mock
 */

use HNF\hammerfluff as Base;

class Core_Tests extends Base\TestCase {

	protected $testFiles = [
		'core.php'
	];

	/**
	 * Make sure all theme-specific constants are defined before we get started
	 */
	public function setUp() {
		if ( ! defined( 'HNF_TEMPLATE_URL' ) ) {
			define( 'HNF_TEMPLATE_URL', 'template_url' );
		}
		if ( ! defined( 'HNF_VERSION' ) ) {
			define( 'HNF_VERSION', '0.1.0' );
		}
		if ( ! defined( 'HNF_URL' ) ) {
			define( 'HNF_URL', 'url' );
		}

		parent::setUp();
	}

	/**
	 * Test setup method.
	 */
	public function test_load() {
		// Setup
		\WP_Mock::expectActionAdded( 'after_setup_theme', 'HNF\Core\setup' );
		\WP_Mock::expectActionAdded( 'after_setup_theme', 'HNF\Core\setup_theme', 100 );

		// Act
		$return = load();

		// Verify
		$this->assertNull( $return );
	}

	/**
	 * Test setup method.
	 */
	public function test_setup() {
		// Setup
		\WP_Mock::expectActionAdded( 'hnf_setup_theme', 'HNF\\Core\\i18n' );
		\WP_Mock::expectActionAdded( 'hnf_setup_theme', 'HNF\\Core\\theme_support' );
		\WP_Mock::expectActionAdded( 'hnf_setup_theme', 'HNF\\Core\\menus' );
		\WP_Mock::expectActionAdded( 'wp_enqueue_scripts', 'HNF\\Core\\scripts' );
		\WP_Mock::expectActionAdded( 'wp_enqueue_scripts', 'HNF\\Core\\styles' );
		\WP_Mock::expectActionAdded( 'wp_head', 'HNF\\Core\\header_meta' );

		// Act
		$return = setup();

		// Verify
		$this->assertNull( $return );
	}

	/**
	 * Test internationalization integration.
	 */
	public function test_i18n() {
		// Setup
		\WP_Mock::userFunction( 'load_theme_textdomain', array(
			'times' => 1,
			'args' => array(
				'hnf',
				HNF_PATH . '/languages'
			),
		) );

		// Act
		$return = i18n();

		// Verify
		$this->assertNull( $return );
	}

	/**
	 * Test scripts enqueue.
	 */
	public function test_scripts() {
		// Regular
		\WP_Mock::userFunction( 'wp_enqueue_script', array(
			'times' => 1,
			'args' => array(
				'hnf',
				'template_url/assets/js/dist/main.bundle.js',
				array(),
				'0.1.0',
				true,
			),
		) );

		$return = scripts();
		$this->assertNull( $return );
	}

	/**
	 * Test style enqueue.
	 */
	public function test_styles() {
		\WP_Mock::userFunction( 'wp_enqueue_style', array(
			'times' => 1,
			'args' => array(
				'hnf',
				'url/assets/css/dist/main.css',
				array(),
				'0.1.0',
			),
		) );

		$return = styles();
		$this->assertNull( $return );
	}
	/**
	 * Test header meta injection
	 */
	public function test_header_meta() {
		// Setup
		$url = 'template_url/humans.txt';
		$meta = '<link type="text/plain" rel="author" href="template_url/humans.txt" />';
		\WP_Mock::onFilter( 'hnf_humans' )->with( $url )->reply( $url );

		// Act
		ob_start();
		header_meta();
		$result = ob_get_clean();

		// Verify
		$this->assertEquals( $meta, $result );
	}
}
