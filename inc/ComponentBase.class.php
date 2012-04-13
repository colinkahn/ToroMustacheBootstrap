<?php

namespace tbcomponents;
use TemplateEngine;

class ComponentBase extends TemplateEngine
{

    public function __construct()
    {
        parent::__construct($this->template);
    }

    public function __toString()
    {
        return $this->render();
    }

}