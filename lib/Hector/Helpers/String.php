<?php

namespace Hector\Helpers\String;

/*boolean*/ function startsWith(/*string*/ $string, /*string*/ $part)
{
    return substr($string, 0, strlen($part)) === $part;
}

/*boolean*/ function endsWith(/*string*/ $string, /*string*/ $part)
{
    return substr($string, -1 * strlen($part)) === $part;
}

/*string*/ function removeExtension(/*string*/ $filename)
{
    return preg_replace('/\\.[a-z0-9]+$/i', '', $filename);
}

/*string*/ function clipOnWord(/*string*/ $string, /*integer*/ $length, /*string*/ $terminator = '...')
{
    if (strlen($string) > $length) {
        return rtrim(preg_replace('/^(.{0,' . $length . '})\b.*$/s', '\\1', $string)) . $terminator;
    } else {
        return $string;
    }
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

function slugify(/*string*/ $string)
{
    return trim(preg_replace('/[^\w.]+/', '-', strtolower($string)), '-');
}