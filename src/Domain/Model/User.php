<?php

declare(strict_types=1);

namespace Terricon\Forum\Domain\Model;

class User implements UserInterface
{
    public function __construct(
        public readonly string $email,
        public readonly string $nikName,
        public readonly array $roles,
    ) {
    }

    public function getPermissions(): array
    {
        return $this->roles;
    }
}
