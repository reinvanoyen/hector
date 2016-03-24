<?php

namespace Hector\Core;

class Runtime
{
	private static $package;

	public static function setPackage( $package )
	{
		self::$package = $package;
	}

	public static function getPackage()
	{
		return self::$package;
	}
}