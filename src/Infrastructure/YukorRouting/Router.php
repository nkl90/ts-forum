<?php

declare(strict_types=1);

namespace Terricon\Forum\Infrastructure\YukorRouting;

use Terricon\Forum\Infrastructure\Routing\RouterInterface;

class Router implements RouterInterface
{
    public function __construct(
        private readonly array $routes,
    ) {
    }

    public function getRoute(string $uri, string $method): Route
    {
        /**
         * /topic/show/0182f46f-552f-4fb3-864c-691a3edabb28*/

        $requestParts = explode('/', $uri);

        dump($requestParts);

        foreach ($this->routes as $route) {
            $requestUriParam = [];
            $matchCount = 0;
            $patternParts = explode('/', $route['path']);

            if (in_array($method, $route['method'], true)) {

                if (count($patternParts) == count($requestParts)) {

                    for ($i = 0; $i < count($patternParts); ++$i) {
                        if ($patternParts[$i] == $requestParts[$i]) {
                            $matchCount++;
                        } else {
                            foreach ($route['parameters'] as $parameter => $value) {
                                if (preg_match($value, $requestParts[$i])) {
                                    $matchCount++;
                                    array_push($requestUriParam, $parameter.'='.$requestParts[$i]);
                                    break;
                                }
                            }
                        }
                    }
                    dump($route);
                    break;
                }
            }
        }
        if ($matchCount == count($patternParts)) {

            return new Route(
                controller: $route['handler']['controller'],
                action: $route['handler']['action'],
                parameters: $requestUriParam
            );
        } else {
            throw new \Exception('Route not found');
        }
    }

    public function generateUri(string $name, array $parameters = []): string
    {
        throw new \Exception('Not implemented');
        // TODO: Implement generateUri() method.
    }

}
