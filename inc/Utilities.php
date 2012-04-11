<?php

function my_get_object_vars($obj) {
    $ref = new ReflectionObject($obj);
    $pros = $ref->getProperties(ReflectionProperty::IS_PUBLIC);
    $result = array();
    foreach ($pros as $pro) {
        false && $pro = new ReflectionProperty();
        $result[$pro->getName()] = $pro->getValue($obj);
    }
    
    return $result;
}