<?php

declare(strict_types=1);

namespace Terricon\Forum\Application\Controller;

use Terricon\Forum\Application\TemplatingEngineInterface;
use Terricon\Forum\Domain\Model\TopicRepositoryInterface;

class ForumController
{
    public function __construct(
        private readonly TopicRepositoryInterface $topicRepository,
        private readonly TemplatingEngineInterface $templatingEngine
    ) {
    }

    public function index(): void
    {
        $lastTopics = $this->topicRepository->findLastCreatedTopics(10);

        $resultArray = [];
        foreach ($lastTopics as $topic) {
            $resultArray[] = [
                'topic' => $topic,
                'url' => $this->router->generateUri('app.topic.show', ['UUID' => $topic->getId()])
            ];
      }

      $this->templatingEngine->render('topic_list.html', ['items' => $resultArray]);
    }

    public function showTopic(string $UUID, int|string $PageNumber = 1): void
    {
        echo __METHOD__;
    }

    public function createTopic(): void
    {
        echo __METHOD__;
    }

    public function createTopicMessage(): void
    {
        echo __METHOD__;
    }
}
