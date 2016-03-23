<?php

namespace hector\core\http;

class HTTPResponse extends Response
{
	protected $output;
	protected $status;
	protected $content_type = 'text/html';

	public function __construct( $output, $status = 200 )
	{
		$this->output = $output;
		$this->status = $status;
	}

	public function execute()
	{
		header( 'Content-Type: ' . $this->content_type  );

		echo $this->output;
	}
}