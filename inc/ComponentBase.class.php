<?php

namespace tbcomponents;
use TemplateEngine;

class ComponentBase extends TemplateEngine
{

    public function __construct($template=null)
    {
        if ( !is_null($template) )
            $this->template = $template;
    
        // This should throw an error if there's no template property or no template set…
        parent::__construct($this->template);
    }

    public function __toString()
    {
        return $this->render();
    }

}