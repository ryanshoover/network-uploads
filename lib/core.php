<?php
namespace netup\core;

class Netup {

	public static function get_instance() {

        static $instance = null;

        if ( null === $instance )
			$instance = new static();

        return $instance;
    }

	private function __clone(){
    }

    private function __wakeup(){
    }

	protected function __construct() {
        if( ! is_multisite() ) {
            return false;
        }
	}
}
