<?php

class TemplateEngine extends Mustache   { 
      
    public function __construct($template = null, $view = null, $partials = null, array $options = null) {
        if ( is_null($partials) ) {
            $fixtures = Fixtures::getInstance();
            $partials = $fixtures->partials;
        }
        
        if (property_exists('Settings', 'basedir'))
            $this->basedir = Settings::$basedir;
        
        parent::__construct($template, $view, $partials, $options);
    }
    
    public function addToContext($data = array()) {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
   
}