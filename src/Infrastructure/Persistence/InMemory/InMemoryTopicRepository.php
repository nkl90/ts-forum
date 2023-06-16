<?php

declare(strict_types=1);

namespace Terricon\Forum\Infrastructure\Persistence\InMemory;

use Faker\Factory;
use Terricon\Forum\Domain\Model\Topic;
use Terricon\Forum\Domain\Model\TopicMessage;
use Terricon\Forum\Domain\Model\TopicRepositoryInterface;
use Terricon\Forum\Domain\Model\User;

class InMemoryTopicRepository implements TopicRepositoryInterface
{
    public function getById(string $UUID): Topic
    {
        $this->connection->prepare('SELECT * FROM topics WHERE id = :id');
        $this->connection->execute(['id' => $UUID]);
        $result = $this->connection->fetch();
        //TODO так делать нельзя, надо использовать рефлексию
        return new Topic(
            $result['name'],
            new TopicMessage(
                new User($result['author']),
                $result['text']
            )
        );
        $faker = Factory::create('ru_RU');

        $topicStarter = new User(
            $faker->email,
            $faker->name
        );

        $user1 = new User(
            $faker->email,
            $faker->name
        );

        $user2 = new User(
            $faker->email,
            $faker->name
        );

        $topic = new Topic(
            name: 'Тестовый топик',
            firstMessage: new TopicMessage(
                author: $user1,
                text: 'Первый ответ на топик',
        ));

        $topic->addMessage(new TopicMessage(
            author: $user1,
            text: 'Первый ответ на топик',
            topic: $topic
        ))->addMessage(new TopicMessage(
            author: $user2,
            text: 'Второй ответ на топик',
            topic: $topic
        ));

        return $topic;
    }

    public function persist(Topic $topic): array
    {
        // TODO: Implement persist() method.
    }

    public function findLastCreatedTopics(int $limit): array
    {
        //TODO Для реализации Жуковым Анатолием
        // Здесь реализовать запрос, который вернет последние $limit объектов топиков
        return [];
    }
}
