<?php

namespace App\ExampleApp\Model;

use Hector\Core\Orm\Model;
use Hector\Core\Orm\Type;

class BlogPost extends Model
{
	const TABLE = 'blogpost';

	public static $fields = [
		'title' => [ Model::TYPE_TEXT, [ 'max_length' => 255, ] ],
		'slug' => [ Model::TYPE_TEXT, [ 'max_length' => 255, ] ],
	];
}