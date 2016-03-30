<?php

namespace Hector\Core\Db\Query;

class Query
{
	public static function select( $columns = '*' )
	{
		return new Select( $columns );
	}
}