<?php

namespace hector\core\http;

class HttpResponse extends Response
{
	private $data;

	public function __construct( $data )
	{
		$this->data = $data;
	}

	public function execute()
	{
		echo $this->data;
	}
}