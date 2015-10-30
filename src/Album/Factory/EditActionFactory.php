<?php

namespace App\Album\Factory;

use App\Album\Action\EditAction;
use App\Album\Service\AlbumServiceInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class EditActionFactory
{
    /**
     * @param ContainerInterface $container
     * @return EditAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $template = ($container->has(TemplateRendererInterface::class))
            ? $container->get(TemplateRendererInterface::class)
            : null;

        $albumService = $container->get(AlbumServiceInterface::class);

        return new EditAction($template, $albumService);
    }
}
