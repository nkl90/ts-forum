<?php

declare(strict_types=1);

namespace Terricon\Forum\Infrastructure\Security;

use Terricon\Forum\Application\SecurityDictionary;
use Terricon\Forum\Application\SecurityInterface;
use Terricon\Forum\Domain\Model\UserInterface;

class Security implements SecurityInterface
{
    private $iteration = 0;

    public function __construct(
        private readonly array $roles
    ) {
    }

    public function isGranted(SecurityDictionary $permission, UserInterface $user): bool
    {
        $userPermissions = $user->getPermissions();
        if(in_array($permission, $userPermissions)) {
            return true;
        }

        foreach($userPermissions as $userPermission) {
            if(str_starts_with($userPermission->name, 'ROLE_')) {
                if(isset($this->roles[$userPermission->name])) {
                    return $this->isGrantedIndirectly($permission, $userPermission->name);
                }
            }
        }

        return false;
    }

    private function isGrantedIndirectly(SecurityDictionary $permission, string $role): bool
    {
        $this->iteration++;
        if(str_starts_with($permission->name, 'ROLE_')) {
            throw new \Exception('Permission can not be a role');
        }

        if(str_starts_with($role, 'PERMISSION_')) {
            throw new \Exception('Role can not be a permission');
        }

        if(in_array($permission->name, $this->roles[$role])) {
            return true;
        }

        foreach($this->roles[$role] as $issetRole) {
            if(str_starts_with($issetRole, 'ROLE_')) {
                return $this->isGrantedIndirectly($permission, $issetRole);
            }
        }

        return false;
    }
}
