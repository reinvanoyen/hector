<?php

namespace Hector\Core\Http;

class Request
{
	public $path;
	public $query;
	public $method;
	public $params;

	public $get;
	public $post;

	public function __construct()
	{
		$this->http_host = $_SERVER[ 'HTTP_HOST' ];
		$this->path = urldecode( substr( $_SERVER['REQUEST_URI'], strlen( \app\ROOT ) ) );
		$this->path = ltrim( $this->path, '/' );

		if( ( $d = strpos( $this->path, '?' ) ) !== FALSE )
		{
			$this->query = substr( $this->path, $d );
			$this->path = substr( $this->path, 0, $d );
		}
		else
		{
			$this->query = '';
		}

		$this->method = $_SERVER[ 'REQUEST_METHOD' ];

		$this->get = $_GET;
		$this->post = $_POST;

		$this->params = $this->{ strtolower( $this->method ) };
	}

	public function validate( array $required_parameters = [], array $optional_parameters = [] )
	{
		foreach( $required_parameters as $name => $type )
		{
			if( ! isset( $this->params[ $name ] ) )
			{
				throw new InvalidRequestException( 'Parameter is missing' );
			}

			$t = gettype( $this->params[ $name ] );

			if( $t !== $type )
			{
				throw new InvalidRequestException( 'Parameter has wrong type' );
			}
		}

		foreach( $optional_parameters as $name => $type )
		{
			if( isset( $this->params[ $name ] ) )
			{
				if( $type !== NULL )
				{
					$t = gettype( $this->params[ $name ] );

					if( $t !== $type )
					{
						throw new InvalidRequestException( 'Optional parameter has wrong type' );
					}
				}
			}
		}
	}
}