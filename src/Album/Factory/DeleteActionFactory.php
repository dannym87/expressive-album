<?php

namespace App\Album\Factory;

use App\Album\Action\DeleteAction;
use App\Album\Service\AlbumServiceInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class DeleteActionFactory
{
    /**
     * @param ContainerInterface $container
     * @return EditAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $router = $container->get(RouterInterface::class);
        $template = ($container->has(TemplateRendererInterface::class))
            ? $container->get(TemplateRendererInterface::class)
            : null;

        $albumService = $container->get(AlbumServiceInterface::class);

        return new DeleteAction($router, $template, $albumService);
    }
}
