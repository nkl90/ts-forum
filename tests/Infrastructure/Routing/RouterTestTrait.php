<?php

declare(strict_types=1);

namespace Terricon\Forum\Tests\Infrastructure\Routing;

use Ramsey\Uuid\Uuid;
use Terricon\Forum\Infrastructure\Routing\Exception\MethodNotAllowedException;
use Terricon\Forum\Infrastructure\Routing\Exception\RouteNotFoundException;
use Terricon\Forum\Infrastructure\Routing\RouteInterface;
use Terricon\Forum\Infrastructure\Routing\RouterInterface;

trait RouterTestTrait
{
    abstract public function getTestingRouter(): RouterInterface;

    abstract public function getRouterConfig(): array;

    public function testGetRoute(): void
    {
        $router = $this->getTestingRouter();
        foreach ($this->getRouterConfig() as $allowedRoute) {
            $testingUri = $this->getTestingRequestUri($allowedRoute);
            foreach ($allowedRoute['method'] as $method) {
                $actualRoute = $router->getRoute($testingUri, $method);
                self::assertInstanceOf(RouteInterface::class, $actualRoute);
            }
        }
    }

    public function testGenerateUriSuccess(): void
    {
        $router = $this->getTestingRouter();
        $allowedRoutes = $this->getRouterConfig();
        foreach ($allowedRoutes as $allowedRoute) {
            $uriParams = $this->getTestingRequestParams($allowedRoute);
            $testingUri = $this->getTestingRequestUri($allowedRoute, $uriParams);
            self::assertEquals($testingUri, $router->generateUri($allowedRoute['name'], $uriParams));
        }
    }

    private function getTestingRequestUri(array $route, ?array $uriParams = null): string
    {
        if (!$uriParams) {
            $uriParams = $this->getTestingRequestParams($route);
        }
        $testingUri = $route['path'];
        foreach ($uriParams as $key => $value) {
            $testingUri = str_replace('{'.$key.'}', (string) $value, $testingUri);
        }

        return $testingUri;
    }

    private function getTestingRequestParams(array $route): array
    {
        $uriParams = [];
        foreach ($route['parameters'] as $key => $parameter) {
            switch ($key) {
                case 'UUID':
                    $uriParams[$key] = Uuid::uuid4()->toString();
                    break;
                case 'PageNumber':
                    $uriParams[$key] = random_int(1, 100);
                    break;
            }
        }

        return $uriParams;
    }
}
