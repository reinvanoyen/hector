<?php

namespace App\ExampleApp\Model;

use Hector\Core\Orm\Model;
use Hector\Core\Orm\Type;

class BlogPost extends Model
{
	const TABLE = 'blogpost';
	
	public static $fields = [
		'title' => [ Model::TYPE_TEXT, [] ],
		'slug' => [ Model::TYPE_TEXT, [] ],
	];
}