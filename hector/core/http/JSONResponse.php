<?php

namespace hector\core\http;

class JSONResponse extends HTTPResponse
{
	protected $content_type = 'application/json';

	public function __construct( $array )
	{
		parent::__construct( json_encode( $array ) );
	}
}