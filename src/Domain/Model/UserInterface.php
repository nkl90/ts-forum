<?php

declare(strict_types=1);

namespace Terricon\Forum\Domain\Model;

use Terricon\Forum\Application\SecurityDictionary;

interface UserInterface
{
    /**
     * @return array<SecurityDictionary>
     */
    public function getPermissions(): array;
}
