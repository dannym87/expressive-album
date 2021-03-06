<?php

namespace App\Album\Factory;

use App\Album\Action\IndexAction;
use App\Album\Service\AlbumServiceInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class IndexActionFactory
{
    /**
     * @param ContainerInterface $container
     * @return IndexAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $template = ($container->has(TemplateRendererInterface::class))
            ? $container->get(TemplateRendererInterface::class)
            : null;

        $albumService = $container->get(AlbumServiceInterface::class);

        return new IndexAction($template, $albumService);
    }
}
