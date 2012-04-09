<?php
require_once 'toro.php';
require_once 'TemplateEngine.class.php';


class MainHandler extends ToroHandler {
    public function get() {
        $t = new TemplateEngine();
        $t->content = '<h1>Bootstrap starter template</h1><p>Use this document as a way to quick start any new project.<br> All you get is this message and a barebones HTML document.</p>';
		echo $t->render();
    }
}


class TestHandler extends ToroHandler {
    public $template = "{{> header }}{{> navigation }}{{> test }}{{> footer }}";
    
    public function get( $testing ) {
        $t = new TemplateEngine($this->template);
        $t->content = $testing;
		echo $t->render();
    }
}

class FormHandler extends ToroHandler {
    public $template = "{{> header }}{{> navigation }}{{> form }}{{> footer }}";
    public $context = array();
    
    public function get() {
       $t = new TemplateEngine($this->template);
       $t->addToContext($this->context);
       echo $t->render(); 
    }
    
    public function post() {
        $this->context = array(
            'something' => $_POST['something'],
            'lookhere'  => isset($_POST['lookhere']) ? $_POST['lookhere'] : null,
            'alert'     => ($_POST['something'] && isset($_POST['lookhere'])) ? array('success'=>true) : array('fail'=>true)
        );
        
        if ( !isset($this->context['alert']['success']) ) {
            if ( !($_POST['something'] || isset($_POST['lookhere'])) ) {
                $this->context['alert']['none'] = true;
            } else {
                $this->context['alert']['partial'] = true;
            }
        }
        
        $this->get();
    }
}

class WysiwygHandler extends ToroHandler {
    public $template = "{{> header }}{{> navigation }}{{> wysiwyg }}{{> footer }}";
    public $context = array();

    public function get() {
        $t = new TemplateEngine($this->template);
        $t->extra_foot = '<script type="text/javascript">$("#textarea").wysihtml5();</script>';
        $t->addToContext($this->context);
        echo $t->render();
    }
    
    public function post() {
        $this->context = array(
            'status'=>array('posted'=>true),
            'results'=>$_POST['textarea']
        );
        $this->get();
    }
}

$site = new ToroApplication(array(
    array('/', 'MainHandler'),
    array('test/([a-z]+)', 'TestHandler'),
    array('form', 'FormHandler'),
    array('wysiwyg', 'WysiwygHandler'),
));    


$site->serve();