<?php

namespace Hector\Session\Middleware;

use Closure;
use Hector\Core\Http\Middleware\MiddlewareInterface;
use Hector\Session\Session;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class SessionMiddleware implements MiddlewareInterface
{
    /**
     * @var Session
     */
    private $session;

    /**
     * SessionMiddleware constructor.
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param Closure $next
     * @return mixed|ResponseInterface
     */
    public function handle(ServerRequestInterface $request, ResponseInterface $response, Closure $next)
    {
        // Garbage collection lottery
        if (rand(0, 3) === 1) {
            $this->session->getHandler()->gc(1000);
        }

        $cookieName = 'session_'.$this->session->getName();
        $sessionId =& $request->getCookieParams()[$cookieName];

        if (! isset($sessionId)) {

            // No session id found, so we generate one
            $sessionId = \Hector\Helpers\String\random(40);

            $request = $request->withCookieParams([
                $cookieName => $sessionId,
            ]);

            setcookie($cookieName, $sessionId, 0, '/');
        }

        $this->session->setId($sessionId);

        $response = $next($request, $response);

        $this->session->save();

        return $response;
    }
}