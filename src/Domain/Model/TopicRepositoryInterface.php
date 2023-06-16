<?php

declare(strict_types=1);

namespace Terricon\Forum\Domain\Model;

interface TopicRepositoryInterface
{
    public function getById(string $UUID): Topic;

    public function persist(Topic $topic): array;

    public function findLastCreatedTopics(int $limit): array;

}
