<?php

declare(strict_types=1);

namespace Terricon\Forum\Application\Controller;

use Terricon\Forum\Application\SecurityDictionary;
use Terricon\Forum\Application\TemplatingEngineInterface;
use Terricon\Forum\Domain\Model\TopicRepositoryInterface;
use Terricon\Forum\Infrastructure\Security\Security;

class ForumController
{
    public function __construct(
        private readonly TopicRepositoryInterface $topicRepository,
        private readonly TemplatingEngineInterface $templatingEngine,
        private readonly Security $security,
    ) {
    }

    public function index(): void
    {
        $lastTopics = $this->topicRepository->findLastCreatedTopics(10);
        $this->templatingEngine->render('topic_list.html', [
            'lastTopics' => $lastTopics,
        ]);
    }

    public function showTopic(string $UUID, int|string $PageNumber = null): void
    {
        if (!empty($UUID) && !is_null($PageNumber)) {
            $this->topicRepository->getById($UUID);
            $this->templatingEngine->render('show_topic.html', [
                'UUID' => $UUID,
                'PageNumber' => $PageNumber,
            ]);
        } elseif (!empty($UUID) && is_null($PageNumber)) {
            $this->topicRepository->getById($UUID);
            $this->templatingEngine->render('show_topic.html', [
                'UUID' => $UUID,
            ]);
        }
    }

    public function createTopic(): void
    {
        $this->templatingEngine->render('create_topic.html');
        echo __METHOD__;
    }

    public function createTopicMessage(): void
    {
        echo __METHOD__;
    }
}
