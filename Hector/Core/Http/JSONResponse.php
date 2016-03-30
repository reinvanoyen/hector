<?php

namespace Hector\Core\Http;

class JSONResponse extends Response
{
	public function __construct( $json_serializable )
	{
		parent::__construct( json_encode( $json_serializable ) );

		$this->setContentType( 'application/json' );
	}
}
