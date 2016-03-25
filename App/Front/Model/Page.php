<?php

namespace App\Front\Model;

use \Hector\Core\Orm\Model;
use \Hector\Core\Orm\Field;

class Page extends Model
{
	const DATADIR = 'data/pages';
	
	public $fields = [
		'title' => [ 'String', ]
	];
}