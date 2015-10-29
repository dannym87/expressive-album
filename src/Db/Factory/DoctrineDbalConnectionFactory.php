<?php

namespace App\Db\Factory;

use Doctrine\DBAL\DriverManager;
use Interop\Container\ContainerInterface;

class DoctrineDbalConnectionFactory
{
    /**
     * @param ContainerInterface $container
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');

        return DriverManager::getConnection($config['doctrine']);
    }
}