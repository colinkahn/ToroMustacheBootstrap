<?php

namespace tbcomponents;

class Breadcrumbs extends ComponentBase
{
    public $list_items = array();
    public $template = "{{> breadcrumbs }}";    

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
        
        return $this;
    }
    
    public function remove($name) 
    {
        // No Imp
    }  

}