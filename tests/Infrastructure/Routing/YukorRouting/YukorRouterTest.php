<?php
declare(strict_types=1);


namespace Terricon\Forum\Tests\Infrastructure\Routing\YukorRouting;

use PHPUnit\Framework\TestCase;
use Terricon\Forum\Infrastructure\YukorRouting\Router;
use Terricon\Forum\Infrastructure\Routing\RouterInterface;
use Terricon\Forum\Tests\Infrastructure\Routing\RouterTestTrait;

final class YukorRouterTest extends TestCase
{
    use RouterTestTrait;

    private array $config;
    private RouterInterface $router;

    public function __construct(string $name)
    {
        $this->config = require __DIR__.'/../../../test_routes.php';
        parent::__construct($name);
    }

    public function setUp(): void
    {
        $this->router = new Router(
            $this->getRouterConfig(),
        );
    }

    public function getTestingRouter(): RouterInterface
    {
        return $this->router;
    }

    public function getRouterConfig(): array
    {
        return $this->config;
    }
}