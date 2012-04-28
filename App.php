<?php

class App
{ 

    public function __construct() 
    {
        ORM::configure('sqlite:./example.db');
        
        $db = ORM::get_db();
        $db->exec("
            CREATE TABLE IF NOT EXISTS signature (
                id INTEGER PRIMARY KEY,
                name varchar(255)
            );"
        );
    }
    
    public function checkSignature($name)
    {
        $c = Model::factory('Signature')
            ->where_equal('name', $name)
            ->count();
            
        return $c;
    }
    
    public function addSignature($name)
    {
        $sig = Model::factory('Signature')->create();
        $sig->name = $name;
        $sig->save();
    }
    
    public function getSignatures()
    {
        $sigs = Model::factory('Signature')->find_many();    
        return $sigs;
    }
    
}