<?php

namespace Hector\Core;

class Runtime
{
    private static $data;

    public static function set( String $key, $value )
    {
        self::$data[$key] = $value;
    }

    public static function get( String $key )
    {
        return self::$data[$key];
    }
}