<?php

use tbcomponents\Alert;

class MainHandler extends ToroMustacheHandler {
    public $pagetitle = "Main Page";
    public $template = "{{> header }}{{> navigation }}{{> content }}{{> footer }}";
    public $content = '<h1>Bootstrap starter template</h1><p>Use this document as a way to quick start any new project.<br> All you get is this message and a barebones HTML document.</p>';

    public function get() {
        $this->navigation->makeActive('Home');
        $this->render();
    }
}

class TestHandler extends ToroMustacheHandler {
    public $pagetitle = "Test Page";
    public $template = "{{> header }}{{> navigation }}{{> test }}{{> footer }}";
    
    public function get( $testing ) {
        $this->navigation->makeActive('Test '. ucfirst($testing));
        $this->content = $testing;
		$this->render();
    }
}



class GalleryHandler extends ToroMustacheHandler {
    public $pagetitle = "Gallery";
    public $template = "{{> header }}{{> navigation }}{{> gallery }}{{> footer }}";
    public $extra_foot = "<script>$('.carousel').carousel()</script>";
    
    public function get() {
        $this->navigation->makeActive('Gallery');
        $this->subnav->makeActive('Home');
        $this->breadcrumbs->add('Gallery','gallery');
		
		$this->render();
    }

}



class FormHandler extends ToroMustacheHandler {
    public $pagetitle = "Form";
    public $template = "{{> header }}{{> navigation }}{{> form }}{{> footer }}";
    public $extra_foot = "<script>$('.typeahead').typeahead({source:['Brian Eno', 'Robert Fripp']})</script>";
    
    public function get() {
        $this->navigation->makeActive('Form');
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
    public $pagetitle = "WYSIWYG";
    public $template = "{{> header }}{{> navigation }}{{> wysiwyg }}{{> footer }}";

    public function get() {
        if (!property_exists($this, 'status') && isset($this->status['posted']))
            $this->extra_foot = '<script type="text/javascript">$("#textarea").wysihtml5();</script>';
        
        $this->navigation->makeActive('WYSIWYG');
        $this->render();
    }
    
    public function post() {
        $this->status = array('posted'=>true);
        $this->results = $_POST['textarea'];
        $this->get();
    }
}



class SignUpHandler extends ToroMustacheHandler {
    public $pagetitle = "Sign Up!";
    public $template = "{{> header }}{{> navigation }}{{> signup }}{{> footer }}";
    
    public function get() {
        $this->render();
    }
    
    public function post() {
        $this->signature = $_POST['signature'];
                
        if (!$this->signature) {
            $this->alert = new Alert('Hold on!', 'Fill out your name dumbass.', Alert::ERROR, true);
        } else if ($this->app->checkSignature($this->signature)) {
            $this->alert = new Alert('Yo yo yo!', "You've already signed up for more pretzels bro!", Alert::ERROR, true);
        } else {
            $this->alert = new Alert('Alright!', 'Hey thanks! We\'re one step closer to getting that awesome pretzel rack! <a href="{{basedir}}signatures">Check out who else has signed.</a>', Alert::SUCCESS, true);
            $this->app->addSignature($this->signature);
        }
        
        $this->get();
    }

}



class SignaturesHandler extends ToroMustacheHandler {
    public $pagetitle = "Signatures";
    public $template = "{{> header }}{{> navigation }}{{> signatures }}{{> footer }}";

    public function get() {
        $this->signatures = $this->app->getSignatures();
        $this->render();
    }

}


class TabbableHandler extends ToroMustacheHandler {
    public $pagetitle = "Tabbable";
    public $template = "{{> header }}{{> navigation }}{{> tabsexample }}{{> footer }}";

    public function get() {
        $this->render();
    }

}