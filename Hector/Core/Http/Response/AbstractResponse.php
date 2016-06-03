<?php

namespace Hector\Core\Http\Response;

abstract class AbstractResponse
{
	private $status = 200;
	private $content_type = 'text/html';
	private $output;

	public function __construct( $output = '' )
	{
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

	public function execute()
	{
		$this->setHeaders();
		$this->output();
	}

	private function output()
	{
		echo $this->output;
	}
}