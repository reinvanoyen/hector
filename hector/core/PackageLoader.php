<?php

namespace hector\core;

class PackageLoader
{
	public static function load( $packageName )
	{
		require_once 'app/packages/' . $packageName . '/config/routes.php';
	}
}