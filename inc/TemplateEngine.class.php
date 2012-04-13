<?php

class TemplateEngine extends Mustache   { 
      
    public function __construct($template = null, $view = null, $partials = null, array $options = null) {
        if ( is_null($partials) ) {
            $fixtures = Fixtures::getInstance();
            $partials = $fixtures->partials;
        }
        
        if (defined('Settings::BASEDIR'))
            $this->basedir = Settings::BASEDIR;
        
        parent::__construct($template, $view, $partials, $options);
    }
    
    public function addToContext($data = array()) {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
   
}