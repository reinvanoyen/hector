<?php

namespace App\ExampleApp\Model;

use Hector\Core\Orm\Model;
use Hector\Core\Orm\Type;

class BlogPost extends Model
{
	const TABLE = 'blogpost';

	public static function getFields()
	{
		return [
			'title' => new Type\Text( [ 'max_length' => 255, ] ),
		];
	}
}