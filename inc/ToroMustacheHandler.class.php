<?php

class ToroMustacheHandler extends ToroHandler
{
    public function __construct() { 
        $meths = get_static_methods('tbcomponents\Components');
        
        foreach ($meths as $meth) {
            $this->{$meth->getName()} = $meth->invoke(null);
        }        
    }

    public function render() {
        if ( property_exists($this, 'template') ) {
            $template = $this->template;
        } else {
            $template = null;
        }
        
        $t = new TemplateEngine($template);
        $t->addToContext( get_public_object_vars($this) );
        echo $t->render();
    }
}