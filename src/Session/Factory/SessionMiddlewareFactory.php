<?php

namespace App\Session\Factory;

use App\Session\Middleware\Session;
use Aura\Session\Session as AuraSession;
use Interop\Container\ContainerInterface;

class SessionMiddlewareFactory
{
    /**
     * @param ContainerInterface $container
     */
    public function __invoke(ContainerInterface $container)
    {
        $session = $container->get(AuraSession::class);

        return new Session($session);
    }
}