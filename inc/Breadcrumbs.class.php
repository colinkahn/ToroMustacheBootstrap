<?php

class Breadcrumbs extends MustacheBase
{
    public $list_items = array();
    
    public function __construct()
    {
        $fixtures = Fixtures::getInstance();
        parent::__construct($template = "{{> breadcrumbs }}", null, $partials = $fixtures->partials, null);
    }    

    public function add($name, $url=null)
    {
        $this->list_items[] = array('name'=>$name, 'url'=>$url, 'active'=>true, 'divider'=>false);
        if ( count($this->list_items) > 1 ) 
        {
            $c = count($this->list_items) - 2;
            
            // Add a divider to the previous item
            $this->list_items[$c]['divider'] = true;
            
            // Remove active from previous item
            $this->list_items[$c]['active'] = false;
        }
    }
    
    public function remove($name) 
    {
        // No Imp
    }
    
    public function __toString()
    {
        return $this->render();
    }    

}