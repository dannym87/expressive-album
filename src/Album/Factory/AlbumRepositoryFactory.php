<?php

namespace App\Album\Factory;

use App\Album\Repository\AlbumRepository;
use Interop\Container\ContainerInterface;

class AlbumRepositoryFactory
{
    /**
     * @param ContainerInterface $container
     * @return AlbumRepository
     */
    public function __invoke(ContainerInterface $container)
    {
        $db = $container->get('db');

        return new AlbumRepository($db);
    }
}