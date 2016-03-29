<?php

namespace Hector\Core\Http;

class JSONResponse extends HTTPResponse
{
	public function __construct( $array )
	{
		parent::__construct( json_encode( $array ) );
		$this->setContentType( 'application/json' );
	}
}