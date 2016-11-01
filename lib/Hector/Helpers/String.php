<?php

namespace Hector\Helpers\String;

/*boolean*/ function startsWith( /*string*/ $string, /*string*/ $part )
{
	return substr( $string, 0, strlen( $part ) ) === $part;
}

/*boolean*/ function endsWith( /*string*/ $string, /*string*/ $part )
{
	return substr( $string, -1 * strlen( $part ) ) === $part;
}

/*string*/ function removeExtension( /*string*/ $filename )
{
	return preg_replace( '/\\.[a-z0-9]+$/i', '', $filename );
}

/*string*/ function clipOnWord( /*string*/ $string, /*integer*/ $length, /*string*/ $terminator = '...' )
{
	if( strlen( $string ) > $length ) {

		return rtrim( preg_replace( '/^(.{0,' . $length . '})\b.*$/s', '\\1', $string ) ) . $terminator;

	} else {

		return $string;
	}
}

/*string*/ function random( /*integer*/ $length )
{
	static $alphabet = NULL;

	if( $alphabet === NULL ) {

		$alphabet = array_merge( range( 'a', 'z' ), range( 'A', 'Z' ), range( '0', '9' ) );
	}

	$str = '';

	for( $i = 0 ; $i < $length ; $i += 1 ) {

		$str .= $alphabet[ rand( 0, count( $alphabet ) - 1 ) ];
	}

	return $str;
}

/*string*/ function slugify( /*string*/ $string )
{
	return trim( preg_replace( '/[^\w.]+/', '-', strtolower( $string ) ), '-' );
}