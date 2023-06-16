<?php

declare(strict_types=1);

namespace Terricon\Forum\Infrastructure\Templating;

use Terricon\Forum\Application\TemplatingEngineInterface;

class TemplatingEngine implements TemplatingEngineInterface
{
    public function __construct(
        private readonly string $templateDirectory = __DIR__.'/../Resources/templates/'
    ) {
    }

    public function render(string $template, array $parameters = []): void
    {
        extract($parameters);

        require $this->templateDirectory.$template;
    }

    public function renderView(string $template, array $parameters = []): string
    {
        ob_start();

        $this->render($template, $parameters);

        return ob_get_clean();
    }
}
