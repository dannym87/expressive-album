<?php

namespace App\Session\Factory;

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
        return (new SessionFactory())->newInstance($_COOKIE);
    }
}