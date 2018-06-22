<?php

class RouteTest extends PHPUnit_Framework_TestCase
{
    public function testRoutes()
    {
        $path = 'my-custom-slug/5/';

        $request = \Hector\Core\Http\ServerRequest::fromGlobals();
        $uri = $request->getUri()->withPath($path);
        $request = $request->withUri($uri);

        $route = new \Hector\Core\Routing\Route(new \Hector\Core\Application(), '(?<slug>.+)/(?<id>\d+)/', function ($request, $response, $slug, $id) {
            return $slug . '-' . $id;
        });

        $this->assertEquals($request->getUri()->getPath(), $path);

        $this->assertEquals($route->match($request), [
            'slug' => 'my-custom-slug',
            'id' => 5,
        ]);

        $response = $route->execute($request, new \Hector\Core\Http\Response(200));

        $this->assertEquals($response->getBody()->getContents(), 'my-custom-slug-5');
        $this->assertEquals($response->getStatusCode(), 200);
    }
}
