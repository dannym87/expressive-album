<?php

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\FastRouteRouter::class,
        ],
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => App\Action\HomePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.ping',
            'path' => '/api/ping',
            'middleware' => App\Action\PingAction::class,
            'allowed_methods' => ['GET'],
        ],
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
            'allowed_methods' => ['GET'],
        ],
        [
            'name'            => 'album.delete',
            'path'            => '/album/delete/{id:\d+}',
            'middleware'      => App\Album\Action\DeleteAction::class,
            'allowed_methods' => ['GET'],
        ],
    ],
];
