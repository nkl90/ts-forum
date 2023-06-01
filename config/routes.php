<?php

declare(strict_types=1);

use Terricon\Forum\Application\Controller\DefaultController;
use Terricon\Forum\Application\Controller\ForumController;

/*$uuidRegExp = '/([A-F 0-9]{8})-([A-F 0-9]{4})-([A-F 0-9]{4})-([A-F 0-9]{4})-([A-F 0-9]{12})/';*/
$uuidRegExp = '/[0-9]/';
$pageCount = '/[0-9]/';

return [
    [
        'name' => 'app.index',
        'method' => ['GET'],
        'path' => '/',
        'parameters' => [],
        'handler' => [
            'controller' => DefaultController::class,
            'action' => 'index',
        ],
    ],
    [
        'name' => 'app.topic.show',
        'method' => ['GET'],
        'path' => '/topic/show/{UUID}',
        'parameters' => [
            'UUID' => $uuidRegExp, // UUID v4
        ],
        'handler' => [
            'controller' => ForumController::class,
            'action' => 'showTopic',
        ],
    ],
    [
        'name' => 'app.topic.show.page',
        'method' => ['GET'],
        'path' => '/topic/show/{UUID}/page/{N}',
        'parameters' => [
            'UUID' => $uuidRegExp, // UUID v4
            'N' => $pageCount,
        ],
        'handler' => [
            'controller' => ForumController::class,
            'action' => 'showTopic',
        ],
    ],
    [
        'name' => 'app.topic.create',
        'method' => ['GET', 'POST'],
        'path' => '/topic/create',
        'parameters' => [],
        'handler' => [
            'controller' => ForumController::class,
            'action' => 'createTopic',
        ],
    ],
    [
        'name' => 'app.topic-message.create.process',
        'method' => ['POST'],
        'path' => '/topic-message/create',
        'parameters' => [],
        'handler' => [
            'controller' => ForumController::class,
            'action' => 'createTopicMessage',
        ],
    ],
];
