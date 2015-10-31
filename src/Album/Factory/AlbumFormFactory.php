<?php

namespace App\Album\Factory;

use App\Album\Form\AlbumForm;
use Aura\Session\Session;
use Interop\Container\ContainerInterface;

class AlbumFormFactory
{
    /**
     * @param ContainerInterface $container
     */
    public function __invoke(ContainerInterface $container)
    {
        /**
         * @var Session $session
         */
        $session = $container->get(Session::class);

        return new AlbumForm('album', ['csrf' => $session->getCsrfToken()]);
    }
}