<?php

namespace Hector\Helpers;

use Hector\Core\Util\SingletonTrait;
use Psr\Http\Message\RequestInterface as Request;

class Http
{
	use SingletonTrait;

	private $basePath;

	public static function getBasePath( Request $request )
	{
		$instance = self::getInstance();

		if( $instance->basePath ) {

			return $instance->basePath;
		}

		$serverParams = $request->getServerParams();

		$filename = basename( $serverParams[ 'SCRIPT_FILENAME' ] );

		if( basename( $serverParams[ 'SCRIPT_NAME' ] ) === $filename ) {

			$baseUrl = $serverParams[ 'SCRIPT_NAME' ];

		} elseif( basename( $serverParams[ 'PHP_SELF' ] ) === $filename) {

			$baseUrl = $serverParams[ 'PHP_SELF' ];

		} elseif( basename( $serverParams[ 'ORIG_SCRIPT_NAME' ] ) === $filename ) {

			$baseUrl = $serverParams[ 'ORIG_SCRIPT_NAME' ];
		}

		$baseDir = substr( $baseUrl, 0, -strlen( $filename ) );
		$basePath = ltrim( $baseDir, '/' );

		$instance->setBasePath( $basePath );

		return $basePath;
	}

	private function setBasePath( $basePath )
	{
		$this->basePath = $basePath;
	}

	public static function getPath( Request $request )
	{
		$path = substr( $request->getUri()->getPath(), strlen( self::getBasePath( $request ) ) );
		return ltrim( $path, '/' );
	}
}