<?php

namespace Hector\Core\Http;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

class Request implements RequestInterface
{
	use MessageTrait;

	private $method;
	private $uri;
	private $requestTarget;

	public function __construct( $method, $uri, array $headers = [], $body = NULL, $version = '1.1' ) {

		if( ! ( $uri instanceof UriInterface ) ) {

			$uri = new Uri( $uri );
		}

		$this->method = strtoupper( $method );
		$this->uri = $uri;
		$this->setHeaders( $headers );
		$this->protocol = $version;

		if( ! $this->hasHeader( 'Host' ) ) {

			$this->updateHostFromUri();
		}

		if( $body !== '' && $body !== null ) {

			$this->stream = StreamFactory::create( $body );
		}
	}

	public function getRequestTarget()
	{
		if( $this->requestTarget !== NULL ) {

			return $this->requestTarget;
		}

		$target = $this->uri->getPath();

		if( $target == '' ) {

			$target = '/';
		}

		if( $this->uri->getQuery() != '' ) {

			$target .= '?' . $this->uri->getQuery();
		}

		return $target;
	}

	public function getMethod()
	{
		return $this->method;
	}

	public function getUri()
	{
		return $this->uri;
	}

	public function withRequestTarget( $requestTarget )
	{
		if( preg_match('#\s#', $requestTarget ) ) {

			throw new \InvalidArgumentException( 'Invalid request target provided; cannot contain whitespace' );
		}

		$new = clone $this;
		$new->requestTarget = $requestTarget;
		return $new;
	}

	public function withMethod( $method )
	{
		$new = clone $this;
		$new->method = strtoupper( $method );
		return $new;
	}

	public function withUri( UriInterface $uri, $preserveHost = FALSE )
	{
		if( $uri === $this->uri ) {

			return $this;
		}

		$new = clone $this;
		$new->uri = $uri;

		if( ! $preserveHost ) {

			$new->updateHostFromUri();
		}
		
		return $new;
	}

	private function updateHostFromUri()
	{
		$host = $this->uri->getHost();

		if( $host == '' ) {

			return;
		}

		if( ( $port = $this->uri->getPort() ) !== NULL ) {

			$host .= ':' . $port;
		}

		if( isset( $this->headerNames[ 'host' ] ) ) {

			$header = $this->headerNames[ 'host' ];

		} else {

			$header = 'Host';
			$this->headerNames[ 'host' ] = 'Host';
		}

		// Ensure Host is the first header.
		// See: http://tools.ietf.org/html/rfc7230#section-5.4
		$this->headers = [ $header => [ $host ] ] + $this->headers;
	}
}