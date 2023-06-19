<?php

declare(strict_types=1);

use Terricon\Forum\Application\Controller\ForumController;
use Terricon\Forum\Infrastructure\NklRouting\Router;
use Terricon\Forum\Infrastructure\ServiceContainer;

require_once '../vendor/autoload.php';

$routes = require_once '../config/routes.php';
$services = require_once '../config/services.php';
$router = new Router($routes);
$route = $router->getRoute($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
//$serviceContainer = new ServiceContainer($services);

$roleHierarchy = require_once '../config/permissions.php';
$topicRepository = new \Terricon\Forum\Infrastructure\Persistence\InMemory\InMemoryTopicRepository();
$templating = new \Terricon\Forum\Infrastructure\Templating\TemplatingEngine();
$security = new \Terricon\Forum\Infrastructure\Security\Security($roleHierarchy);
$controller = new ForumController($topicRepository, $templating, $security);

$controller->createTopic();
