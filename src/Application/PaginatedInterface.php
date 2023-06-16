<?php
declare(strict_types=1);


namespace Terricon\Forum\Domain;

interface PaginatedInterface
{
    public function getItems(): array;
    public function getPagesCount(): int;

    public function getCurrentPage(): int;

    public function getPreviousPage(): int;

    public function getNextPage(): int;
}