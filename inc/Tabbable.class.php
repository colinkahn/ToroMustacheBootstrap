<?php

namespace tbcomponents;

class Tabbable extends ComponentBase
{
    public $tabs = array();
    public $type = null;
    public $below = false;
    public $template = "{{> tabbable }}";
    
    const BELOW = 'tabs-below';
    const LEFT = 'tabs-left';
    const RIGHT = 'tabs-right';    

    public function __construct($type='')
    {            
        $this->type = $type;
        
        if ($this->type == self::BELOW)
            $this->below = true;
            
        parent::__construct();
    }

    public function add($name, $template)
    {
        if ( count($this->tabs) ) 
        {
            $active = false;
        } else {
            $active = true;
        }
            
        $this->tabs[] = array(
            'name'      => $name, 
            'content'   => new ComponentBase($template), 
            'anchor'    => slugify($name), 
            'active'    => $active
        );
        
        return $this;
    }

    public function makeActive($name)
    {
        foreach($this->tabs as &$tab)
        {
            if ($tab['name'] == $name) 
            {
                $tab['active'] = true;
            } 
            else
            {
                $tab['active'] = false;
            } 
        }
        return $this;
    }    

}