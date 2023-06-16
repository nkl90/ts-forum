<?php

declare(strict_types=1);

use Terricon\Forum\Application\SecurityDictionary;

return [
    SecurityDictionary::ROLE_GUEST->name => [
        SecurityDictionary::PERMISSION_VIEW_POST->name,
    ],
    SecurityDictionary::ROLE_USER->name => [
        'PERMISSION_CREATE_TOPIC',
        'PERMISSION_EDIT_POSTS',
        SecurityDictionary::ROLE_GUEST->name,
    ],
    SecurityDictionary::ROLE_MODERATOR->name => [
        'PERMISSION_MANAGE_POSTS',
        SecurityDictionary::ROLE_USER->name,
    ],
    SecurityDictionary::ROLE_ADMIN->name => [
        'PERMISSION_MANAGE_SETTINGS',
        'PERMISSION_MANAGE_USER',
        SecurityDictionary::ROLE_MODERATOR->name,
    ],
];
