<?php
require_once 'toro.php';
require_once 'inc/Mustache.php';
require_once 'inc/MustacheLoader.php';

class ToroMustache extends Mustache { 
    public $basedir = "/~temp/toro/";
        
    public function __construct() {
        $this->_template = "{{> header }}{{> navigation }}{{> content}}{{> footer }}";
        $this->_partials = new MustacheLoader(dirname(__FILE__).'/fixtures');
        parent::__construct();
    }
   
}

class MainHandler extends ToroHandler {
    public function get() {
        $m = new ToroMustache();
        $m->content = '<h1>Bootstrap starter template</h1><p>Use this document as a way to quick start any new project.<br> All you get is this message and a barebones HTML document.</p>';
		echo $m->render();
    }
}

class TestHandler extends ToroHandler {
    public function get() {
        $m = new ToroMustache();
        $m->content = "<h1>This is a test</h1>";
		echo $m->render();
    }
}


$site = new ToroApplication(array(
    array('/', 'MainHandler'),
    array('test/something', 'TestHandler'),
));

$site->serve();