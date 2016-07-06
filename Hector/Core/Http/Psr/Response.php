<?php

namespace Hector\Core\Http\Psr;

use Psr\Http\Message\ResponseInterface;

class Response implements ResponseInterface
{
	use MessageTrait;

	private $statusCode = 200;
	private $reasonPhrase = '';

	public function getStatusCode()
	{
		return $this->statusCode;
	}

	public function getReasonPhrase()
	{
		return $this->reasonPhrase;
	}

	public function withStatus( $status, $reasonPhrase = '' )
	{
		if( $this->statusCode === $status && $this->reasonPhrase === $reasonPhrase ) {

			return $this;
		}

		$copy = clone $this;
		$copy->statusCode = $status;
		$copy->reasonPhrase = $reasonPhrase;

		return $copy;
	}
}