<?php

namespace Hector\Core\Http;

class HTTPResponse extends Response
{
	protected $output;

	public function __construct( $output )
	{
		$this->output = $output;
	}

	public function execute()
	{
		parent::execute();

		echo $this->output;
	}
}