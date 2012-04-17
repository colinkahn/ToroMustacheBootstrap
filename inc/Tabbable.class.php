<?php

namespace tbcomponents;
use Exception;

class InvalidTabbableTypeException extends Exception { }

class Tabbable extends ComponentBase
{
    public $tabs = array();
    public $type = null;
    public $below = false;
    public $template = "{{> tabbable }}";
    
    const NORMAL = '';
    const BELOW = 'tabs-below';
    const LEFT = 'tabs-left';
    const RIGHT = 'tabs-right';    

    public function __construct($type=null)
    {   
        if ( is_null($type) )
            $type = self::NORMAL;
        
        $this->checkType($type);    
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
    
    public function addToTabContext($name, $data=array())
    {
        foreach($this->tabs as &$tab)
        {
            if ($tab['name'] == $name) 
            {
                $tab['content']->addToContext($data);
                return $this;
            } 
        }    
    }
    
    private function checkType($type)
    {
        if ( !in_array($type, array(self::NORMAL, self::BELOW, self::LEFT, self::RIGHT)) )
            throw new InvalidTabbableTypeException('Invalid Tabbable Type');
    }

}