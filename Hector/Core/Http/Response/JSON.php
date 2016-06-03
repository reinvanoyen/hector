<?php

namespace Hector\Core\Http\Response;

class JSON extends AbstractResponse
{
	public function __construct( $json_serializable )
	{
		parent::__construct( json_encode( $json_serializable ) );

		$this->setContentType( 'application/json' );
	}
}