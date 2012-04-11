<?php
require_once 'inc/Mustache.php';
require_once 'inc/MustacheLoader.php';

class TemplateEngine extends Mustache { 
    public $basedir = "/~temp/toro/";
 
    public $navigation = array(
        array('name'=>'Home', 'url'=>''),
        array('name'=>'Test Something', 'url'=>'test/something'),
        array('name'=>'Test Nothing', 'url'=>'test/nothing'),
        array('name'=>'Form', 'url'=>'form'),
        array('name'=>'WYSIWYG', 'url'=>'wysiwyg'),
        array('name'=>'Gallery', 'url'=>'gallery'),
    );
     
    public function __construct($template = null, $view = null, $partials = null, array $options = null) {
        if ( is_null($template) )
            $template = "{{> header }}{{> navigation }}{{> content }}{{> footer }}";
            
        if ( is_null($partials) )
            $partials = new MustacheLoader(dirname(__FILE__).'/fixtures');
        
        parent::__construct($template, $view, $partials, $options);
    }
    
    public function addToContext($data = array()) {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
   
}