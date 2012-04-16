<?php

namespace tbcomponents;
use Exception;

class InvalidAlertTypeException extends Exception { }

class Alert extends ComponentBase
{
    public $template = "{{> alert}}";
    
    public $heading = null;
    public $content = null;
    public $type = null;
    public $closeable = false;
    public $block = false;
    
    const WARNING = '';
    const ERROR = 'alert-error';
    const SUCCESS = 'alert-success';
    const INFORMATION = 'alert-info';
    
    public function __construct($heading, $template, $type=null /*WARNING*/, $closeable=false, $block=false)
    {
        if ( is_null($type) )
            $type = self::WARNING;
            
        $this->checkType($type);
        
        $this->heading = $heading;
        $this->content = new ComponentBase($template);
        $this->type = $type;
        $this->closeable = $closeable;
        $this->block = $block;
        
        parent::__construct();
    }
    
    private function checkType($type)
    {
        if ( !in_array($type, array(self::WARNING, self::ERROR, self::SUCCESS, self::INFORMATION)) )
            throw new InvalidAlertTypeException("Invalid Alert type");
    }
}
