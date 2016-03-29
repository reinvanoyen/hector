<?php

namespace Hector\Core\Http;

class Redirect extends Response
{
	private $location;

	public function __construct( $location, $status = 301 )
	{
		$this->setStatus( $status );
		$this->location = $location;
	}

	public function execute()
	{
		parent::execute();
		header( 'Location: ' . $this->location );
	}
}