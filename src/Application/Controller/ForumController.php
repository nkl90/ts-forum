<?php

declare(strict_types=1);

namespace Terricon\Forum\Application\Controller;

use Terricon\Forum\Application\SecurityDictionary;
use Terricon\Forum\Domain\Model\Topic;
use Terricon\Forum\Application\TemplatingEngineInterface;
use Terricon\Forum\Domain\Model\TopicMessage;
use Terricon\Forum\Domain\Model\TopicRepositoryInterface;
use Terricon\Forum\Infrastructure\Security\Security;

class ForumController
{
    public function __construct(
        private readonly TopicRepositoryInterface $topicRepository,
        private readonly TemplatingEngineInterface $templatingEngine,
        private readonly Security $security,
        private readonly Topic $topic,
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
        $this->security->isGranted(SecurityDictionary::PERMISSION_CREATE_TOPIC, $this->security->getUser());

        $errors = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //TODO: add validation
            $topic = new Topic(
                name: $_POST['title'],
                firstMessage: new TopicMessage(
                    author: $this->security->getUser(),
                    text: $_POST['body']
                )
            );
            $this->topicRepository->persist($topic);
            header("HTTP/1.1 301 Moved Permanently");
            //TODO: сформировать правильную ссылку на новый топик
            header("Location: https://example.com/");
            exit();
        }


        $this->templatingEngine->render('topic_create.html', [
            'form_errors' => $errors
        ]);
    }

    public function createTopicMessage(): void
    {
        echo __METHOD__;
    }
}
