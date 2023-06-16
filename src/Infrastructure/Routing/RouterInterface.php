<?php

declare(strict_types=1);

namespace Terricon\Forum\Infrastructure\Routing;

use Exception;
use Terricon\Forum\Infrastructure\Routing\Exception\MethodNotAllowedException;
use Terricon\Forum\Infrastructure\Routing\Exception\RouteNotFoundException;

interface RouterInterface
{
    /**
     * @param array $routes - массив маршрутов (@see config/routes.php)
     */
    public function __construct(
        array $routes,
    );

    /**
     * Возвращает объект маршрута.
     *
     * @param string $uri    - URI запроса
     * @param string $method - метод запроса (GET, POST, PUT, DELETE)
     *
     * @return RouteInterface - объект маршрута
     *
     * @throws RouteNotFoundException
     * @throws MethodNotAllowedException
     */
    public function getRoute(string $uri, string $method): RouteInterface;

    /**
     * Генерирует URI по имени маршрута и массиву параметров.
     *
     * @param string $name       - имя маршрута
     * @param array  $parameters - массив параметров
     *
     * @return string - сгенерированный URI (например "/users/show/241")
     *
     * @throws Exception
     */
    public function generateUri(string $name, array $parameters = []): string;
}
