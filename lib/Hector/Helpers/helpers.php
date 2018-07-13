<?php

use \Hector\Config\Facade\Config;

/*
 * Application essentials
 */

function config(string $name, $default = null)
{
    Config::get($name, $default);
}

/*
 * String helpers
 */

function random($length = 16)
{
    $string = '';

    while (($len = strlen($string)) < $length) {
        $size = $length - $len;
        $bytes = random_bytes($size);
        $string .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
    }

    return $string;
}

function slugify($string)
{
    return trim(preg_replace('/[^\w.]+/', '-', strtolower($string)), '-');
}