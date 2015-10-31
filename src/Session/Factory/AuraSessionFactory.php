<?php

namespace App\Session\Factory;

use App\Session\Middleware\Session;
use Aura\Session\SessionFactory;
use Interop\Container\ContainerInterface;

class AuraSessionFactory
{
    /**
     * @param ContainerInterface $container
     * @return \Aura\Session\Session
     */
    public function __invoke(ContainerInterface $container)
    {
        $session = (new SessionFactory())->newInstance($_COOKIE);

        return new Session($session);
    }
}