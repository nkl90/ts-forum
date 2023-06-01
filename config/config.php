<?php

declare(strict_types=1);

return [
    [
        'method' => 'GET',
        'path' => '/',
        'handler' => [
            'controller' => DefaultController::class,
            'action' => 'index',
        ],
    ],
    [
        'method' => 'GET',
        'path' => '/topic/',
        'handler' => [
            'controller' => DefaultController::class,
            'action' => 'index',
        ],
    ],
];
