<?php

declare(strict_types=1);

namespace Terricon\Forum\Application;

use Terricon\Forum\Domain\Model\UserInterface;

interface SecurityInterface
{
    public function isGranted(SecurityDictionary $permission, UserInterface $user): bool;
}
