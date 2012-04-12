<?php

function get_public_object_vars($obj) {
    $ref = new ReflectionObject($obj);
    $pros = $ref->getProperties(ReflectionProperty::IS_PUBLIC);
    $result = array();
    foreach ($pros as $pro) {
        $result[$pro->getName()] = $pro->getValue($obj);
    }
    
    return $result;
}

function get_static_methods($class) {
    $ref = new ReflectionClass($class);
    $meths = $ref->getMethods(ReflectionMethod::IS_STATIC);
    return $meths;    
}