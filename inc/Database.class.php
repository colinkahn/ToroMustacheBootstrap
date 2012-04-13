<?php

require_once 'Xml.class.php';

class Database extends xml 
{ 

    public function __construct() {
        $uri = dirname(__FILE__).'/db.xml';
        parent::xml($uri);
    }

}