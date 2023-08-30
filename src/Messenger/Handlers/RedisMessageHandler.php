<?php

namespace App\Messenger\Handlers;

use App\Entity\Record;
use App\Messenger\Messages\RedisMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(fromTransport: 'async_redis')]
class RedisMessageHandler extends AbstractHandler
{
    public function __invoke(RedisMessage $message): bool
    {
//        throw new \Exception('Retry Test');
        $record = new Record();
        $record->setValue($message->getValue());
        $record->setQueue($message->getQueue());
        $this->em->persist($record);
        $this->em->flush();

        return true;
    }
}