<?php

namespace Hector\Core\Http;

class Response
{
	private $status = 200;
	private $content_type;
	private $output;

	public function __construct( $output = '' )
	{
		$this->setContentType( 'text/html' );
		$this->setOutput( $output );
	}

	protected function setOutput( $output )
	{
		$this->output = $output;
	}

	protected function setContentType( $content_type )
	{
		$this->content_type = $content_type;
	}

	protected function setStatus( $status )
	{
		$this->status = $status;
	}

	protected function setHeaders()
	{
		http_response_code( $this->status );
		header( 'Content-Type: ' . $this->content_type  );
	}

	protected function output()
	{
		echo $this->output;
	}

	public function execute()
	{
		$this->setHeaders();
		$this->output();
	}
}
