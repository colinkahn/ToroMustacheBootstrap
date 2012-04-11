<?php
require_once 'toro.php';
require_once 'TemplateEngine.class.php';
require_once 'inc/NavLists.class.php';
require_once 'inc/Breadcrumbs.class.php';


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

class GalleryHandler extends ToroHandler {
    public $template = "{{> header }}{{> navigation }}{{> gallery }}{{> footer }}";
    
    public function get() {
        $t = new TemplateEngine($this->template);
        $t->extra_foot = "<script>$('.carousel').carousel()</script>";
        $t->subnav = getSubNav();
        $t->subnav->makeActive('Home');
        $t->breadcrumbs = $this->breadcrumbs();
		echo $t->render();
    }
    
    public function breadcrumbs()
    {
        $bc = new Breadcrumbs();
        $bc->add('Home',' ');
        $bc->add('Gallery','gallery');
        return $bc;
    }
}

class FormHandler extends ToroHandler {
    public $template = "{{> header }}{{> navigation }}{{> form }}{{> footer }}";
    public $context = array();
    
    public function get() {
       $t = new TemplateEngine($this->template);
       $t->addToContext($this->context);
       $t->extra_foot = "<script>$('.typeahead').typeahead({source:['Brian Eno', 'Robert Fripp']})</script>";
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
    /*
        Extend ToroHandler with another class 
        Add a 'bin' function to that class
        toss stuff in the bin and then add it to the context of Mustache
        or somehow add the whole class to the context, like just (array)$this
        change template to something private (do private properties become array key=>values?)
        actually use get_object_vars() since it only gets visible variables (but… if we do that within the class we get everything right?)
        actually… use the function i've added to inc/Utilities 
    */
    
    public $context = array();

    public function get() {
        $t = new TemplateEngine($this->template);
        if (!isset($this->context['status']['posted']))
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

function getSubNav() {
    $subnav = new NavLists();
    $subnav->addSection();
    $subnav->addListHeader('List Header');
    $subnav->addListItem('Home', ' ', 'home');
    $subnav->addListItem('Library', 'library', 'book');
        
    $subnav->addSection();
    $subnav->addListHeader('Another list header');
    $subnav->addListItem('Profile', 'profile', 'user');
    $subnav->addListItem('Settings', 'settings', 'cog');
    
    $subnav->addDivider();
    
    $subnav->addSection();
    $subnav->addListItem('Help', 'help', 'flag');
    
    return $subnav;
}

$site = new ToroApplication(array(
    array('/', 'MainHandler'),
    array('test/([a-z]+)', 'TestHandler'),
    array('form', 'FormHandler'),
    array('wysiwyg', 'WysiwygHandler'),
    array('gallery', 'GalleryHandler'),
));    


$site->serve();