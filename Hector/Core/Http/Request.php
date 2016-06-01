<?php

namespace Hector\Core\Http;

use Hector\Helpers\Type;

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

		$this->params = new \Hector\Core\Util\TypeStrictDataWrapper( $this->{ strtolower( $this->method ) } );
	}

	public function validate( array $required_parameters = [] )
	{
		foreach( $required_parameters as $name => $type )
		{
			if( ! $this->params->has( $name ) )
			{
				throw new InvalidRequestException( 'Parameter is missing' );
			}
		}
	}
}