<?php

class Alert
{

    public static function status($status)
    {
        $a = new stdClass();
        $a->{$status} = true;
        return $a;
    }

}
