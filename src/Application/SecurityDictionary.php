<?php

declare(strict_types=1);

namespace Terricon\Forum\Application;

enum SecurityDictionary: string
{
    case ROLE_ADMIN = 'ROLE_ADMIN';
    case ROLE_USER = 'ROLE_USER';
    case ROLE_MODERATOR = 'ROLE_MODERATOR';
    case ROLE_GUEST = 'ROLE_GUEST';
    case PERMISSION_VIEW_POST = 'PERMISSION_VIEW_POST';
    case PERMISSION_CREATE_TOPIC = 'PERMISSION_CREATE_TOPIC';

    case PERMISSION_MANAGE_USER = 'PERMISSION_MANAGE_USER';

    public static function getAll(): array
    {
        return [
            self::ROLE_ADMIN,
            self::ROLE_USER,
            self::ROLE_MODERATOR,
            self::ROLE_GUEST,
            self::PERMISSION_VIEW_POST,
            self::PERMISSION_CREATE_TOPIC,
        ];
    }
}
