<?php

return [
    'dependencies' => [
        'factories' => [
            App\Album\Action\IndexAction::class                  => App\Album\Factory\IndexActionFactory::class,
            App\Album\Action\AddAction::class                    => App\Album\Factory\AddActionFactory::class,
            App\Album\Action\EditAction::class                   => App\Album\Factory\EditActionFactory::class,
            App\Album\Action\DeleteAction::class                 => App\Album\Factory\DeleteActionFactory::class,
            App\Album\Repository\AlbumRepositoryInterface::class => App\Album\Factory\AlbumRepositoryFactory::class,
            App\Album\Service\AlbumServiceInterface::class       => App\Album\Factory\AlbumServiceFactory::class,
            App\Album\Form\AlbumForm::class                      => App\Album\Factory\AlbumFormFactory::class,
        ],
    ],

    'routes' => [
        [
            'name'            => 'album.index',
            'path'            => '/album',
            'middleware'      => App\Album\Action\IndexAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name'            => 'album.add',
            'path'            => '/album/add',
            'middleware'      => App\Album\Action\AddAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name'            => 'album.edit',
            'path'            => '/album/edit/{id:\d+}',
            'middleware'      => App\Album\Action\EditAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name'            => 'album.delete',
            'path'            => '/album/delete/{id:\d+}',
            'middleware'      => App\Album\Action\DeleteAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ],
    ],

    'templates' => [
        'paths' => [
            'album' => ['templates/album'],
        ],
    ],
];