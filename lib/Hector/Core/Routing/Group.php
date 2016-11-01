<?php

namespace Hector\Core\Routing;

class Group
{
    use RouteableTrait;

    public function __construct( String $prefix = '' )
    {
        $this->setPrefix( $prefix );
    }

    public function add( $middleware )
    {
        foreach( $this->routes as $method => $routes ) {

            foreach( $routes as $route ) {

                $route->add( $middleware );
            }
        }

        return $this;
    }
}