<?php

namespace HNF\hammerfluff;

use PHPUnit_Framework_TestResult;
use Text_Template;
use WP_Mock;
use PHPUnit\Framework\TestCase as Base;

class TestCase extends Base {
	protected $testFiles = array();

	public function run( \PHPUnit\Framework\TestResult $result = NULL ) {
		$this->setPreserveGlobalState( false );
		return parent::run( $result );
	}


	public function setUp() {
		WP_Mock::setUp();
		if ( ! empty( $this->testFiles ) ) {
			foreach ( $this->testFiles as $file ) {
				if ( file_exists( PROJECT . $file ) ) {
					require_once( PROJECT . $file );
				}
			}
		}
	}

	/**
	 * Define constants after requires/includes
	 *
	 * See http://kpayne.me/2012/07/02/phpunit-process-isolation-and-constant-already-defined/
	 * for more details
	 *
	 * @param \Text_Template $template
	 */
	public function prepareTemplate( \Text_Template $template ) {
		$template->setVar( [
			'globals' => '$GLOBALS[\'__PHPUNIT_BOOTSTRAP\'] = \'' . $GLOBALS['__PHPUNIT_BOOTSTRAP'] . '\';',
		] );
		parent::prepareTemplate( $template );
	}
	public function tearDown() {
		WP_Mock::tearDown();
	}
}
