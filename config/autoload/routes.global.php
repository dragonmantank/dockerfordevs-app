<?php
return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\FastRouteRouter::class,
        ],
        'factories' => [
            App\Queue\Application\IndexAction::class => App\Queue\Application\IndexActionFactory::class
        ]
    ],
    'routes' => [
        [
            'name' => 'index',
            'path' => '/api/v0/queue[/{id}]',
            'middleware' => App\Queue\Application\IndexAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ],
    ],
];
