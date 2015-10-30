<?php

return [
    'dependencies' => [
        'invokables' => [
            App\Action\PingAction::class         => App\Action\PingAction::class,
            // Album invokables
            App\Album\Action\DeleteAction::class => App\Album\Action\DeleteAction::class,
            App\Album\Form\AlbumForm::class      => App\Album\Form\AlbumForm::class,
        ],
        'factories'  => [
            'db'                                                 => App\Db\Factory\DoctrineDbalConnectionFactory::class,
            Zend\Expressive\Application::class                   => Zend\Expressive\Container\ApplicationFactory::class,
            App\Album\Action\AddAction::class                    => App\Album\Factory\AddActionFactory::class,
            App\Action\HomePageAction::class                     => App\Action\HomePageFactory::class,
            // Album factories
            App\Album\Action\IndexAction::class                  => App\Album\Factory\IndexActionFactory::class,
            App\Album\Action\EditAction::class                   => App\Album\Factory\EditActionFactory::class,
            App\Album\Repository\AlbumRepositoryInterface::class => App\Album\Factory\AlbumRepositoryFactory::class,
            App\Album\Service\AlbumServiceInterface::class       => App\Album\Factory\AlbumServiceFactory::class,
        ],
    ],
];
