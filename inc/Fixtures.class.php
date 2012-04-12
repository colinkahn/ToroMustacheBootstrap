<?php

class Fixtures {

    public static $instance = null;
    public $partials = null;

	static function getInstance() {
		if ( !self::$instance ) {
			$className = __CLASS__;
			self::$instance = new $className;
		}
		return self::$instance;
	}
	
	private function __construct() {
	   $this->partials = new MustacheLoader(dirname(__FILE__).'/../fixtures');
	}

}