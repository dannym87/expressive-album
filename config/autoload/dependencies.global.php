<?php

return [
    'dependencies' => [
        'invokables' => [
            App\Action\PingAction::class => App\Action\PingAction::class,
        ],
        'factories'  => [
            'db'                               => App\Db\Factory\DoctrineDbalConnectionFactory::class,
            Zend\Expressive\Application::class => Zend\Expressive\Container\ApplicationFactory::class,
            App\Action\HomePageAction::class   => App\Action\HomePageFactory::class,
        ],
    ],
];
