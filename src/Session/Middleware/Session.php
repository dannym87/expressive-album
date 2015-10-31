<?php

namespace App\Session\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Aura\Session\Session as AuraSession;

class Session
{
    /**
     * @var AuraSession
     */
    private $session;

    /**
     * @param AuraSession $session
     */
    public function __construct(AuraSession $session)
    {
        $this->session = $session;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $request = $request->withAttribute('session', $this->session);

        if ($next) {
            return $next($request, $response);
        }
    }
}