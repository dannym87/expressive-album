<?php

namespace App\Album\Factory;

use App\Album\Repository\AlbumRepository;
use App\Album\Repository\AlbumRepositoryInterface;
use App\Album\Service\AlbumService;
use Interop\Container\ContainerInterface;

class AlbumServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $albumRepository = $container->get(AlbumRepositoryInterface::class);

        return new AlbumService($albumRepository);
    }
}