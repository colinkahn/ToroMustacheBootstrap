<?php

function get_public_object_vars($obj) 
{
    $ref = new ReflectionObject($obj);
    $pros = $ref->getProperties(ReflectionProperty::IS_PUBLIC);
    $result = array();
    foreach ($pros as $pro) {
        $result[$pro->getName()] = $pro->getValue($obj);
    }
    
    return $result;
}

function get_static_methods($class) 
{
    $ref = new ReflectionClass($class);
    $meths = $ref->getMethods(ReflectionMethod::IS_STATIC);
    return $meths;    
}

function slugify($text)
{
    // replace non letter or digits by -
    $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
 
    // trim
    $text = trim($text, '-');
 
    // transliterate
    if (function_exists('iconv'))
    {
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    }
 
    // lowercase
    $text = strtolower($text);
 
    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);
 
    if (empty($text))
    {
        return 'n-a';
    }
 
    return $text;
}