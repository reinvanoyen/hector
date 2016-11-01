<?php

namespace Hector\Core\Routing;

use Hector\Core\Runtime;
use Hector\Helpers\Http;
use Hector\Helpers\Regex;
use Hector\Helpers\String as Str;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Hector\Core\Http\Middleware\MiddlewareableTrait;

class Route
{
	use MiddlewareableTrait;

    private $pattern;
    private $action;
    private $attributes;
    private $parent;

    public function __construct( String $pattern, $action )
    {
        $this->pattern = $pattern;
        $this->action = $action;
    }

    public function setParent( $parent )
    {
        $this->parent = $parent;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function match( ServerRequestInterface $request )
    {
        $path = Http::getPath( $request );

        if( $this->parent && $this->parent->getPrefix() ) {

            if( Str\startsWith( $path, $this->parent->getPrefix() ) ) {

                $pathWithoutPrefix = substr( $path, strlen( $this->parent->getPrefix() ) );

                if( Regex\namedPregMatch( '@^(' . $this->pattern . ')$@', $pathWithoutPrefix, $matches ) ) {

                    return ( $this->attributes = $matches );
                }
            }

        } else {

            if( Regex\namedPregMatch( '@^(' . $this->pattern . ')$@', $path, $matches ) ) {

                return ( $this->attributes = $matches );
            }
        }

        return FALSE;
    }

    private function call( ServerRequestInterface $request, ResponseInterface $response )
    {
        $attributes = $this->attributes;

        if( is_callable( $this->action ) ) {

            $callable = $this->action;
            array_unshift( $attributes, $request, $response );

        } else {

            $parts = explode( '.', $this->action );
            $controller = Runtime::get('appname') . '\\Controller\\' . $parts[ 0 ];
            $method = $parts[ 1 ];
            $controller = new $controller( $request, $response );

            $callable = [ $controller, $method ];
        }

        return call_user_func_array( $callable, $attributes );
    }

    public function getCoreFunction()
    {
        return function( $request, $response ) {

            $result = $this->call( $request, $response );

            if( ! ( $result instanceof ResponseInterface ) ) {

                return $response->write( $result );
            }

            return $result;
        };
    }

    public function execute( ServerRequestInterface $request, ResponseInterface $response )
    {
        return $this->runMiddlewareStack( $request, $response, $this->getCoreFunction() );
    }
}

require_once __DIR__ . '/../../Helpers/Regex.php';