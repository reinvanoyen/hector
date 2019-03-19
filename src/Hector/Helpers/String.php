<?php

namespace Hector\Helpers\String;

function startsWith($string, $part)
{
    return substr($string, 0, strlen($part)) === $part;
}

function endsWith($string, /*string*/ $part)
{
    return substr($string, -1 * strlen($part)) === $part;
}

function removeExtension($filename)
{
    return preg_replace('/\\.[a-z0-9]+$/i', '', $filename);
}

function clipOnWord($string, $length, $terminator = '...')
{
    if (strlen($string) > $length) {
        return rtrim(preg_replace('/^(.{0,' . $length . '})\b.*$/s', '\\1', $string)) . $terminator;
    }

    return $string;
}

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
