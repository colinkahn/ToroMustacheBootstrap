<?php

class Database
{ 

    public function __construct($filename) 
    {
        $this->db = sqlite_open($filename);
        @sqlite_query($this->db, 'CREATE TABLE signatures (name varchar(255))');
    }
    
    public function checkSignature($name)
    {
        return count(sqlite_array_query($this->db, "SELECT * FROM signatures WHERE name == '$name'"));
    }
    
    public function addSignature($name)
    {
        sqlite_query($this->db, "INSERT INTO signatures VALUES ('$name')");
    }
    
    public function getSignatures()
    {
        $result = sqlite_array_query($this->db, 'SELECT * FROM signatures');
        return $result;
    }
    
}