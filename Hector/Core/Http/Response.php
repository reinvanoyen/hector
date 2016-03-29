<?php

namespace Hector\Core\Http;

abstract class Response
{
	private $status = 200;
	private $content_type = 'text/html';

	protected function setContentType( $content_type )
	{
		$this->content_type = $content_type;
	}

	protected function setStatus( $status )
	{
		$this->status = $status;
	}

	public function execute()
	{
		http_response_code( $this->status );
		header( 'Content-Type: ' . $this->content_type  );
	}
}