<?php

namespace App\Messenger\Handlers;

use App\Entity\Record;
use App\Messenger\Messages\RabbitMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(fromTransport: 'async_rabbit')]
class RabbitMessageHandler extends AbstractHandler
{
    public function __invoke(RabbitMessage $message): bool
    {
//        throw new \Exception("Test");
        $record = new Record();
        $record->setValue($message->getValue());
        $record->setQueue($message->getQueue());
        $this->em->persist($record);
        $this->em->flush();

        return true;
    }
}