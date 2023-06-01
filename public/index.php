<?php

declare(strict_types=1);

use Terricon\Forum\Infrastructure\YukorRouting\Router;
use Terricon\Forum\Infrastructure\ServiceContainer;

require_once '../vendor/autoload.php';

$routes = require_once '../config/routes.php';
$services = require_once '../config/services.php';
$router = new Router($routes);
$route = $router->getRoute($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
$serviceContainer = new ServiceContainer($services);
$controller = $serviceContainer->getInstanceOf($route->getController());
$controller->{$route->getAction()}(...$route->getParameters());
