<?php

namespace Hector\Core\Http;

class Redirect extends HTTPResponse
{
	private $location;

	public function __construct( $location, $status = 301 )
	{
		parent::__construct( NULL, $status );

		$this->location = $location;
	}

	public function execute()
	{
		http_response_code( $this->status );
		header( 'Location: ' . $this->location );
	}
}