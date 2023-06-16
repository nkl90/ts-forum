<?php

declare(strict_types=1);

namespace Terricon\Forum\Infrastructure\SergeiRouting;

use Terricon\Forum\Infrastructure\Routing\RouteInterface;

class Route implements RouteInterface
{
    public function __construct(
        private readonly string $controller,
        private readonly string $action,
        private readonly array $parameters
    ) {
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getParameters(): array
    {
        $result = [];
        foreach ($this->parameters as $key => $value) {
            $result[str_replace('{', '', str_replace('}', '', $key))] = $value;
        }
        return $result;
    }
}
