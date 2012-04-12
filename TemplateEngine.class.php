<?php
require_once 'inc/Mustache.php';
require_once 'inc/MustacheLoader.php';

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
	   $this->partials = new MustacheLoader(dirname(__FILE__).'/fixtures');
	}

}

class MustacheBase extends Mustache {
    public $basedir = "/~temp/toro/";
}

class TemplateEngine extends MustacheBase { 
      
    public function __construct($template = null, $view = null, $partials = null, array $options = null) {
        if ( is_null($template) )
            $template = "{{> header }}{{> navigation }}{{> content }}{{> footer }}";
            
        if ( is_null($partials) ) {
            $fixtures = Fixtures::getInstance();
            $partials = $fixtures->partials;
        }
        
        parent::__construct($template, $view, $partials, $options);
    }
    
    public function addToContext($data = array()) {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
   
}