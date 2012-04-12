<?php
require_once 'toro.php';
require_once 'inc/ToroMustacheHandler.php';
require_once 'TemplateEngine.class.php';
require_once 'inc/NavLists.class.php';
require_once 'inc/Breadcrumbs.class.php';
require_once 'inc/Utilities.php';
require_once 'Components.php';


class MainHandler extends ToroMustacheHandler {
    public $content = '<h1>Bootstrap starter template</h1><p>Use this document as a way to quick start any new project.<br> All you get is this message and a barebones HTML document.</p>';

    public function get() {
        $this->render();
    }
}


class TestHandler extends ToroMustacheHandler {
    public $template = "{{> header }}{{> navigation }}{{> test }}{{> footer }}";
    
    public function get( $testing ) {
        $this->content = $testing;
		$this->render();
    }
}

class GalleryHandler extends ToroMustacheHandler {
    public $template = "{{> header }}{{> navigation }}{{> gallery }}{{> footer }}";
    public $extra_foot = "<script>$('.carousel').carousel()</script>";
    
    public function get() {
        $this->subnav->makeActive('Home');
        $this->breadcrumbs->add('Gallery','gallery');
		
		$this->render();
    }

}

class FormHandler extends ToroMustacheHandler {
    public $template = "{{> header }}{{> navigation }}{{> form }}{{> footer }}";
    
    public function get() {
       $this->extra_foot = "<script>$('.typeahead').typeahead({source:['Brian Eno', 'Robert Fripp']})</script>";
       $this->render(); 
    }
    
    public function post() {
        $this->something = $_POST['something'];
        $this->lookhere = isset($_POST['lookhere']) ? $_POST['lookhere'] : null;
        $this->alert = ($this->something && $this->lookhere) ? array('success'=>true) : array('fail'=>true);
        
        if ( !isset($this->alert['success']) ) {
            if ( !($this->something || $this->lookhere) ) {
                $this->alert['none'] = true;
            } else {
                $this->alert['partial'] = true;
            }
        }
        
        $this->get();
    }
}

class WysiwygHandler extends ToroMustacheHandler {
    public $template = "{{> header }}{{> navigation }}{{> wysiwyg }}{{> footer }}";

    public function get() {
        if (!property_exists($this, 'status') && isset($this->status['posted']))
            $this->extra_foot = '<script type="text/javascript">$("#textarea").wysihtml5();</script>';
        
        $this->render();
    }
    
    public function post() {
        $this->status = array('posted'=>true);
        $this->results = $_POST['textarea'];
        $this->get();
    }
}

$site = new ToroApplication(array(
    array('/', 'MainHandler'),
    array('test/([a-z]+)', 'TestHandler'),
    array('form', 'FormHandler'),
    array('wysiwyg', 'WysiwygHandler'),
    array('gallery', 'GalleryHandler'),
));    


$site->serve();