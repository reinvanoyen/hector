<?php

namespace App\Front\Model;

use Hector\PHPException;

class Page
{
	public static $slugs = [
		'home' => 'Welkom',
		'blog' => 'Blog',
		'over-ons' => 'Over ons',
		'contact' => 'Contacteer ons',
	];

	public function getTitleBySlug( $slug )
	{
		if( ! isset( self::$slugs[ $slug ] ) )
		{
			throw new PHPException();
		}

		return self::$slugs[ $slug ];
	}
}