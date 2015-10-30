<?php

namespace App\Album\Factory;

use App\Album\Action\AddAction;
use App\Album\Service\AlbumServiceInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use App\Album\Form\AlbumForm;

class AddActionFactory
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
        $form = $container->get(AlbumForm::class);

        return new AddAction($router, $template, $albumService, $form);
    }
}
