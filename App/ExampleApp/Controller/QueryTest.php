<?php

namespace App\ExampleApp\Controller;

use Hector\Core\Controller;
use Hector\Core\Http\Response;
use Hector\Core\Db\QueryBuilder\Query;

class QueryTest extends Controller
{
	public function viewIndex()
	{
		$query = Query::insert( 'blogpost' )->values( [
			'title' => 'Dynamically insert with querybuilder!',
			'slug' => 'my-custom-slug',
		] );

		$query->execute();

		return (string) $query;
	}
}