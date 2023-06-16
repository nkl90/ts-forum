<?php

declare(strict_types=1);

namespace Terricon\Forum\Application;

interface TemplatingEngineInterface
{
    public function render(string $template, array $parameters = []): void;

    public function renderView(string $template, array $parameters = []): string;
    
}
