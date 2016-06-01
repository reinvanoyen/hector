<?php

namespace App\ExampleApp\Model;

use Hector\Core\Orm\Model;
use Hector\Core\Orm\Type;

class BlogPost extends Model
{
	const TABLE = 'blogpost';

	public static $fields = [
		'id' => Model::TYPE_INT,
		'title' => [ Model::TYPE_TEXT, [
			'max_length' => 10,
			'sync' => 'slug',
		] ],
		'slug' => [ Model::TYPE_TEXT, [
			'max_length' => 10,
			'slugify' => TRUE,
		] ],
		'body' => Model::TYPE_TEXT,
	];
}