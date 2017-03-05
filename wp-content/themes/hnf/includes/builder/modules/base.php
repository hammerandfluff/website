<?php

namespace HNF\Builder\Modules;

class Base extends \FLBuilderModule {
	public static function load() {
		add_action( 'hnf_bb_init', self::n( 'setup' ) );
	}
	public static function setup( $settings = [] ) {
		\FLBuilder::register_module( self::n(), $settings );
	}
	public static function n( $name = null ) {
		$ns = get_called_class();
		return empty( $name ) ? $ns : $ns . '::' . $name;
	}
	public function __construct( $registration = [] ) {
		parent::__construct( $registration );
	}
}
